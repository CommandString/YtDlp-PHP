<?php

namespace Yt\Dlp\Exceptions;

class CommandExecutionFailed extends \Exception
{
    public function __construct(private string $command, private string $result)
    {
        parent::__construct("Command $command failed to execute");
    }

    public function __toString(): string
    {
        return "{$this->getMessage()}\n\n{$this->getCommandResult()}";
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
