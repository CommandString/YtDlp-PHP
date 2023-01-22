<?php

namespace Yt\Dlp\Exceptions;

use Exception;
use Throwable;

class YtDlpNotInstalled extends Exception {
    public function __construct(?Throwable $previous = null)
    {
        parent::__construct("YtDlp is not installed on this system.", 0, $previous);
    }

    public function __toString(): string
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}