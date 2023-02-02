<?php

namespace Yt\Dlp;

use React\EventLoop\Loop;
use React\EventLoop\Timer\Timer;
use React\Promise\Deferred;
use React\Promise\PromiseInterface;
use Yt\Dlp\Exceptions\CommandExecutionFailed;
use Yt\Dlp\Exceptions\YtDlpNotInstalled;

class YtDlp {
    private string $prefix = "yt-dlp";

    /**
     * @param string|null $ytDlpPath
     * @throws YtDlpNotInstalled
     */
    public function __construct(?string $ytDlpPath = null)
    {
        if (!is_null($ytDlpPath)) {
            $this->prefix = realpath($ytDlpPath);
        }

        try {
            $this->newCommand()->addOption(Options::VERSION)->execute();
        } catch (CommandExecutionFailed $e) {
            throw new YtDlpNotInstalled($e);
        }
    }

    /**
     * @param string $url
     * @return CommandBuilder
     */
    public function newCommand(string $url = ""): CommandBuilder
    {
        return new CommandBuilder($url, $this);
    }

    /**
     * @param string $command
     * @return array
     */
    private function proc_execute(string $command): array
    {
        $stdout = tempnam(__DIR__, "yt");
        $stderr = tempnam(__DIR__, "yt");
        $process = proc_open("$this->prefix $command", [1 => ["file", $stdout, "w"], 2 => ["file", $stderr, "w"]], $pipes);

        return [
            "files" => [$stdout, $stderr],
            "command" => $command,
            "process" => &$process
        ];
    }

    /**
     * @param string $command
     * @return PromiseInterface
     */
    public function execute(string $command): PromiseInterface
    {
        $promise = new Deferred();

        $proc = $this->proc_execute($command);

        Loop::addPeriodicTimer(Timer::MIN_INTERVAL, function (Timer $timer) use (&$proc, $command, $promise, &$stderr, &$stdout) {
            $status = proc_get_status($proc["process"]);
            
            if ($status["running"]) {
                return;
            }

            $stdout = @file_get_contents($proc["files"][0]);
            $stderr = @file_get_contents($proc["files"][1]);
            @unlink($proc["files"][0]);
            @unlink($proc["files"][1]);

            if ($status["exitcode"] !== 0) {
                $promise->reject(new CommandExecutionFailed($command, $stderr));
            } else {
                $promise->resolve($stdout);
            }

            Loop::cancelTimer($timer);
        });

        return $promise->promise();
    }

    /**
     * @param string $url
     * @param string $outputPath
     * @param string $customName
     * @param string $format
     * @throws \InvalidArgumentException
     * @return PromiseInterface
     */
    public function downloadAudio(string $url, string $outputPath, string $customName, string $format = "mp3"): PromiseInterface
    {
        $promise = new Deferred();

        $path = realpath($outputPath);

        if (!$path) {
            throw new \InvalidArgumentException("$outputPath does not exist!");
        }

        $output = "$path";

        $output .= "/$customName.$format";

        $this->newCommand('"'.$url.'"')->addOption(Options::OUTPUT, '"'.$output.'"')->addOption(Options::EXTRACT_AUDIO)->addOption(Options::AUDIO_FORMAT, $format)->execute()->then(function () use ($promise, $output) {
            $promise->resolve(realpath($output));
        }, function ($err) use ($promise) {
            $promise->reject($err);
        });

        return $promise->promise();
    }

    /**
     * @param string $url
     * @param string $outputPath
     * @param string $customName
     * @param string $format
     * @throws \InvalidArgumentException
     * @return PromiseInterface
     */
    public function downloadVideo(string $url, string $outputPath, string $customName, string $format = "mp4"): PromiseInterface
    {
        $promise = new Deferred();

        $path = realpath($outputPath);

        if (!$path) {
            throw new \InvalidArgumentException("$outputPath does not exist!");
        }

        $output = "$path";

        $output .= "/$customName.$format";

        $this->newCommand('"'.$url.'"')->addOption(Options::OUTPUT, '"'.$output.'"')->addOption(Options::REMUX_VIDEO, $format)->execute()->then(function () use ($promise, $output) {
            $promise->resolve(realpath($output));
        }, function ($err) use ($promise) {
            $promise->reject($err);
        });

        return $promise->promise();
    }

    /**
     * @param string $url
     * @return PromiseInterface
     * @see https://github.com/yt-dlp/yt-dlp#output-template
     */
    public function getInfo(string $url): PromiseInterface
    {
        $promise = new Deferred;

        $command = $this->newCommand('"'.$url.'"')->addOption(Options::SKIP_DOWNLOAD)->addOption(Options::DUMP_JSON);

        $this->execute($command)->then(function ($json_string) use ($promise) {
            $promise->resolve(json_decode($json_string));
        }, function ($err) use ($promise) {
            $promise->reject($err);
        });

        return $promise->promise();
    }

    /**
     * @param string $query
     * @param int $results
     * @throws \InvalidArgumentException
     * @return PromiseInterface
     */
    public function search(string $query, int $results = 1): PromiseInterface
    {
        $promise = new Deferred;

        if ($results < 1) {
            throw new \InvalidArgumentException("Results must be at least 1");
        }

        $command = $this->newCommand('"'.$query.'"')->addOption(Options::SKIP_DOWNLOAD)->addOption(Options::DUMP_JSON)->addOption(Options::DEFAULT_SEARCH, "ytsearch$results");

        $this->execute($command)->then(function ($out) use ($promise) {
            $promise->resolve(json_decode("[".substr(implode(",", explode("\n", $out)), 0, -1)."]"));
        }, function ($err) use ($promise) {
            $promise->reject($err);
        });

        return $promise->promise();
    }
}