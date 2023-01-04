<?php

namespace Yt\Dlp;
use stdClass;
use Yt\Dlp\Exceptions\CommandExecutionFailed;
use Yt\Dlp\Exceptions\YtDlNotInstalled;
use Yt\Dlp\Parts\Video;

class YtDlp {
    private string $prefix = "yt-dlp";

    public function __construct(?string $ytDlpPath = null)
    {
        if (!is_null($ytDlpPath)) {
            $this->prefix = realpath($ytDlpPath);
        }

        try {
            $this->newCommand()->addOption(Options::VERSION)->execute();
        } catch (CommandExecutionFailed $e) {
            throw new YtDlNotInstalled($e);
        }
    }

    public function newCommand(string $url = ""): CommandBuilder
    {
        return new CommandBuilder($url, $this->prefix, $this);
    }

    public function execute(string $command): CommandResult
    {
        $output = [];
        $exit_code = 0;
        $success = exec($command, $output, $exit_code);

        $result = new CommandResult($command, $output, $exit_code);

        if (!$success) {
            throw new CommandExecutionFailed($command, $result);
        }

        return $result;
    }

    public function proc_execute(string $command): array
    {
        $pipes = [];
        $process = proc_open($command, [["pipe", "r"], ["pipe", "w"], ["pipe", "w"]], $pipes);

        return [
            "pipes" => &$pipes,
            "command" => $command,
            "process" => &$process
        ];
    }

    public function getVideo(string $url): Video
    {
        return new Video($url, $this);
    }
}