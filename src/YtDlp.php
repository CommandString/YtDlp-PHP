<?php

namespace Yt\Dlp;

use React\EventLoop\Loop;
use React\EventLoop\Timer\Timer;
use React\EventLoop\TimerInterface;
use React\Promise\Deferred;
use React\Promise\Promise;
use React\Promise\PromiseInterface;
use Yt\Dlp\Abstractions\Search\Result;
use Yt\Dlp\Abstractions\Search\Results;
use Yt\Dlp\Exceptions\CommandExecutionFailed;
use Yt\Dlp\Exceptions\YtDlpNotInstalled;
use InvalidArgumentException;
use Throwable;

use function React\Async\await;

class YtDlp
{
    /**
     * @var string
     */
    private string $prefix = "yt-dlp";

    private const TEMP = __DIR__ . '/temp';

    /**
     * @param string|null $ytDlpPath
     * @throws YtDlpNotInstalled|Throwable
     */
    public function __construct(?string $ytDlpPath = null)
    {
        if ($ytDlpPath !== null) {
            $this->prefix = realpath($ytDlpPath);
        }

        try {
            await($this->newCommand()->addOption(Options::VERSION)->execute());
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
        return new CommandBuilder($this, $url);
    }

    /**
     * @param string $command
     * @return array
     */
    private function procExecute(string $command): array
    {
        $randomName = static fn () => __DIR__ . '/yt-' . substr(md5(rand()), 0, 5) . '.txt';

        $stdout = $randomName();
        $stderr = $randomName();
        $process = proc_open(
            "$this->prefix {$command}",
            [
                1 => ["file", $stdout, "w"],
                2 => ["file", $stderr, "w"]
            ],
            $pipes
        );

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
        return new Promise(function ($resolve, $reject) use ($command) {
            $proc = $this->procExecute($command);
            Loop::addPeriodicTimer(
                Timer::MIN_INTERVAL,
                static function (TimerInterface $timer) use (&$proc, &$stdout, &$stderr, $reject, $command, $resolve) {
                    $status = proc_get_status($proc["process"]);

                    if ($status["running"]) {
                        return;
                    }

                    $stdout = @file_get_contents($proc["files"][0]);
                    $stderr = @file_get_contents($proc["files"][1]);
                    @unlink($proc["files"][0]);
                    @unlink($proc["files"][1]);

                    if ($status["exitcode"] !== 0) {
                        $reject(new CommandExecutionFailed($command, $stderr));
                    } else {
                        $resolve($stdout);
                    }

                    Loop::cancelTimer($timer);
                }
            );
        });
    }

    /**
     * @param string $url
     * @param string $outputPath
     * @param string $customName
     * @param string $format
     * @return PromiseInterface
     */
    public function downloadAudio(
        string $url,
        string $outputPath,
        string $customName,
        string $format = "mp3"
    ): PromiseInterface {
        return new Promise(function ($resolve, $reject) use ($outputPath, $customName, $format, $url) {
            $path = realpath($outputPath);

            if ($path === false) {
                throw new InvalidArgumentException("{$outputPath} does not exist!");
            }

            $output = $path;

            $output .= "/{$customName}.{$format}";

            $this
                ->newCommand('"' . $url . '"')
                ->addOption(Options::OUTPUT, '"' . $output . '"')
                ->addOption(Options::EXTRACT_AUDIO)
                ->addOption(Options::AUDIO_FORMAT, $format)
                ->execute()
                ->then(static function () use ($resolve, $output) {
                    $resolve(realpath($output));
                }, static function ($err) use ($reject) {
                    $reject($err);
                });
        });
    }

    /**
     * @param string $url
     * @param string $outputPath
     * @param string $customName
     * @param string $format
     * @return PromiseInterface
     */
    public function downloadVideo(
        string $url,
        string $outputPath,
        string $customName,
        string $format = "mp4"
    ): PromiseInterface {
        $promise = new Deferred();

        $path = realpath($outputPath);

        if (!$path) {
            throw new \InvalidArgumentException("{$outputPath} does not exist!");
        }

        $output = $path;

        $output .= "/{$customName}.{$format}";

        $this->newCommand('"' . $url . '"')
            ->addOption(Options::OUTPUT, '"' . $output . '"')
            ->addOption(Options::REMUX_VIDEO, $format)
            ->execute()
            ->then(static function () use ($promise, $output) {
                $promise->resolve(realpath($output));
            }, static function ($err) use ($promise) {
                $promise->reject($err);
            });

        return $promise->promise();
    }

    /**
     * @param string $url
     * @return PromiseInterface
     */
    public function getInfo(string $url): PromiseInterface
    {
        $promise = new Deferred();

        $command = $this
            ->newCommand('"' . $url . '"')
            ->addOption(Options::SKIP_DOWNLOAD)
            ->addOption(Options::DUMP_JSON);

        $this->execute($command)->then(static function ($json_string) use ($promise) {
            $promise->resolve(json_decode($json_string));
        }, static function ($err) use ($promise) {
            $promise->reject($err);
        });

        return $promise->promise();
    }

    /**
     * @param string $query
     * @param int $results
     * @return PromiseInterface
     */
    public function search(string $query, int $results = 1): PromiseInterface
    {
        if ($results < 1) {
            throw new InvalidArgumentException("Results must be at least 1");
        }

        return new Promise(function ($resolve, $reject) use ($query, $results) {
            $command = $this->newCommand('"' . $query . '"')
                ->addOption(Options::SKIP_DOWNLOAD)
                ->addOption(Options::DUMP_JSON)
                ->addOption(Options::DEFAULT_SEARCH, "ytsearch{$results}");

            $this->execute($command)->then(static function ($out) use ($resolve, $reject) {
                $lines = array_filter(explode("\n", $out), static fn($line) => !empty($line));

                $results = new Results(
                    array_map(static fn($result) => new Result(json_decode($result, true)), $lines)
                );

                $resolve($results);
            }, static function ($err) use ($reject) {
                $reject($err);
            });
        });
    }
}
