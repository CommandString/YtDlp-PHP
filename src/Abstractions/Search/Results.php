<?php

namespace Yt\Dlp\Abstractions\Search;

use Yt\Dlp\Abstractions\AbstractCollection;

class Results extends AbstractCollection
{
    protected static string $itemClass = Result::class;

    /**
     * @var Result[] $items
     */
    protected array $items = [];
}
