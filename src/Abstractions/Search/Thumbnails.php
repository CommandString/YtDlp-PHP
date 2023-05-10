<?php

namespace Yt\Dlp\Abstractions\Search;

use Yt\Dlp\Abstractions\AbstractIterable;

class Thumbnails extends AbstractIterable
{
    protected static string $itemClass = Thumbnail::class;

    /**
     * @var Thumbnail[] $items
     */
    protected array $items = [];
}
