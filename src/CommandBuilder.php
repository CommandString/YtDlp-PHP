<?php

namespace Yt\Dlp;

use React\Promise\PromiseInterface;

class CommandBuilder
{
    private array $options = [];

    public function __construct(private YtDlp $ytDlp, private readonly string $url = "")
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
        $options = implode(" ", $this->options);
        return trim("{$this->url} {$options}");
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
