<?php

namespace Yt\Dlp\Exceptions;

use Yt\Dlp\CommandResult;

class CommandExecutionFailed extends \Exception {
    public function __construct(private string $command, private CommandResult $result)
    {
        parent::__construct("Command $command failed to execute", $result->exit_code);
    }

    public function __toString(): string
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    public function getCommand(): string
    {
        return $this->command;
    }

    public function getCommandResult(): CommandResult
    {
        return $this->result;
    }
}