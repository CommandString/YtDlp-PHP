<?php

namespace Yt\Dlp;

class CommandResult {
    public readonly string $output;

    public function __construct(
        public readonly string $command,
        public readonly array $output_lines,
        public readonly int $exit_code
    )
    {
        $this->output = implode("\n", $output_lines);
    }

    public function __toString()
    {
        return $this->output;
    }
}