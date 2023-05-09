<?php

namespace Yt\Dlp\Exceptions;

use Exception;
use Throwable;

class YtDlpNotInstalled extends Exception
{
    /**
     * @param CommandExecutionFailed|null $previous
     */
    public function __construct(?CommandExecutionFailed $previous = null)
    {
        parent::__construct("YtDlp is not installed on this system.", 0, $previous);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
