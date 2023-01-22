<?php

namespace Yt\Dlp\Exceptions;

use Yt\Dlp\CommandResult;

class CommandExecutionFailed extends \Exception {
    public function __construct(private string $command, private string $result, private int $exit_code)
    {
        parent::__construct("Command $command failed to execute", $exit_code);
    }

    public function __toString(): string
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    public function getCommand(): string
    {
        return $this->command;
    }

    public function getCommandResult(): string
    {
        return $this->result;
    }
}