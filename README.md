# commandstring/yt-dlp

A PHP wrapper for yt-dlp

# Basic Usage

```php
<?php

use Yt\Dlp\Options;
use Yt\Dlp\YtDlp;

require_once "vendor/autoload.php";

$yt = new YtDlp();

$url = "https://www.youtube.com/watch?v=gsCda7_I2fU";

$proc = $yt->newCommand($url)->addOption(Options::REMUX_VIDEO, "mp4", Options::NEWLINE->value)->proc_execute();

$pipes = &$proc["pipes"];

stream_set_blocking($pipes[1], false);

while (proc_get_status($proc["process"])["running"]) {
    echo fgets($pipes[1]);
}

echo "Finished downloading $url...";
```