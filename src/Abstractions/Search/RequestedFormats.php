<?php

namespace Yt\Dlp\Abstractions\Search;

use Yt\Dlp\Abstractions\AbstractCollection;

class RequestedFormats extends AbstractCollection
{
    protected static string $itemClass = RequestedFormat::class;

    /**
     * @var RequestedFormat[] $items
     */
    protected array $items = [];
}
