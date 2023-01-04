<?php

namespace Yt\Dlp;

use Exception;

class CommandBuilder {
    private array $options = [];

    public function __construct(private string $url = "", private string $prefix, private ?YtDlp $ytDlp = null)
    {
        
    }

    public function addOption(Options|string $option, string ...$arguments): self
    {
        $option_string = (is_string($option)) ? $option : $option->value;

        if (str_contains($option_string, "%s")) {
            $option_string = sprintf($option_string, implode(" ", $arguments));
        }

        $this->options[] = $option_string;

        return $this;
    }
    
    public function buildCommand(): string
    {
        $command = $this->prefix." {$this->url}";

        foreach ($this->options as $option) {
            $command .= " $option";
        }

        return $command;
    }
    
    public function __toString()
    {
        return $this->buildCommand();
    }

    /**
     * @throws Exception If \Yt\Dlp\YtDlp is not supplied
     * @throws \Yt\Dlp\Exceptions\CommandExecutionFailed If the command fails to execute
     * @return CommandResult
     */
    public function execute(): CommandResult
    {
        if (!isset($this->ytDlp)) {
            throw new Exception("\\Yt\\Dlp\\YtDlp must be supplied in the constructor to execute commands.");
        }

        return $this->ytDlp->execute((string)$this);
    }

    public function proc_execute(): array
    {
        if (!isset($this->ytDlp)) {
            throw new Exception("\\Yt\\Dlp\\YtDlp must be supplied in the constructor to execute commands.");
        }

        return $this->ytDlp->proc_execute((string)$this);
    }
}