<?php

namespace Yt\Dlp\Exceptions;

class InvalidVideoUrl extends \Exception {
    public function __construct(string $url, ?\Throwable $previous)
    {
        parent::__construct("$url is not a valid Youtube URL", 0, $previous);
    }

    public function __toString(): string
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}