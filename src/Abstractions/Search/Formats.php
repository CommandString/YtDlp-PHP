<?php

namespace Yt\Dlp\Abstractions\Search;

use Yt\Dlp\Abstractions\AbstractIterable;

class Formats extends AbstractIterable
{
    protected static string $itemClass = Format::class;

    /**
     * @var Format[] $items
     */
    protected array $items = [];
}
