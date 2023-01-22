# commandstring/yt-dlp

A promised-based PHP wrapper for [YtDlp](https://github.com/yt-dlp/yt-dlp) built off ReactPHP

**NOTE BEFORE USING YOU WILL NEED TO START A REACT/PROMISE LOOP OR THE SCRIPT WILL DIE BEFORE THE COMMAND FINISHES EXECUTING!!!**

# Creating YtDlp

```php
$yt = new YtDlp();
```

You can supply a path to your Yt-Dlp as well if it's not in your path.

# CommandBuilder

You can use the command builder to create commands programmatically, all options for YtDlp exist inside `\Yt\Dlp\Options` (if I'm missing anything please open an issue)

You can create a new CommandBuilder with your YtDlp instance

```php
$command = $yt->newCommand($url)->addOption(Options::SKIP_DOWNLOAD)->addOption(Options::DUMP_JSON);
```

You can then use the execute method to execute. With the then method following that you can check the handle a success/failed command execution

```php
$command->execute()->then(function (string $result) {
    echo $result;
}, function (CommandExecutionFailed $e) {
    echo (string)$e;
});
```

# Already implemented commands

```php
public function downloadVideo(string $url, string $outputPath, string $customName, string $format = "mp4"): PromiseInterface
public function downloadAudio(string $url, string $outputPath, string $customName, string $format = "mp3"): PromiseInterface
```
returns the full path of where the audio/video was downloaded

```php
public function getInfo(string $url): PromiseInterface
```
returns an stdClass with the video info [Available Fields](https://github.com/yt-dlp/yt-dlp#output-template)

```php
public function search(string $query, int $results = 1): PromiseInterface
```
Returns an array of all the results, each item has a structure similar to the getInfo method


# Basic Usage

This code will download the first videos from the query

```php
<?php

use React\EventLoop\Loop;
use Yt\Dlp\Exceptions\CommandExecutionFailed;
use Yt\Dlp\YtDlp;

require_once "vendor/autoload.php";

$yt = new YtDlp();

$errHandler = function (CommandExecutionFailed $e) {
    echo (string)$e;
};

$query = "amalee the worlds continuation";

$yt->search($query, 5)->then(function ($results) use ($yt, $errHandler) {
    foreach ($results as $video) {
        $id = $video->id;

        $yt->downloadVideo($id, __DIR__, $id)->then(null, $errHandler);
    }
});

Loop::get()->run();
```