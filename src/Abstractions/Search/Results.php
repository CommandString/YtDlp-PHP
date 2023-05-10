<?php

namespace Yt\Dlp\Abstractions\Search;

use Yt\Dlp\Abstractions\AbstractIterable;

class Results extends AbstractIterable
{
    protected static string $itemClass = Result::class;

    /**
     * @var Result[] $items
     */
    protected array $items = [];
}
