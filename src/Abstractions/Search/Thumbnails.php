<?php

namespace Yt\Dlp\Abstractions\Search;

use Yt\Dlp\Abstractions\AbstractCollection;

class Thumbnails extends AbstractCollection
{
    protected static string $itemClass = Thumbnail::class;

    /**
     * @var Thumbnail[] $items
     */
    protected array $items = [];
}
