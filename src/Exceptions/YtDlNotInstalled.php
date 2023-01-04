<?php

namespace Yt\Dlp\Exceptions;

class YtDlNotInstalled extends \Exception {
    public function __construct(?\Throwable $previous = null)
    {
        parent::__construct("Youtube-dl is not installed on this system.", 0, $previous);
    }

    public function __toString(): string
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}