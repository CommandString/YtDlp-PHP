<?php

namespace Yt\Dlp;

use React\Promise\PromiseInterface;

class CommandBuilder {
    private array $options = [];

    public function __construct(private string $url = "", private YtDlp $ytDlp) {}

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
        $command = $this->url;

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
     * @return PromiseInterface
     */
    public function execute(): PromiseInterface
    {
        return $this->ytDlp->execute((string)$this);
    }
}