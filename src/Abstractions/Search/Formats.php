<?php

namespace Yt\Dlp\Abstractions\Search;

use Yt\Dlp\Abstractions\AbstractCollection;

class Formats extends AbstractCollection
{
    protected static string $itemClass = Format::class;

    /**
     * @var Format[] $items
     */
    protected array $items = [];
}
