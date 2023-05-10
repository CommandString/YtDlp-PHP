<?php

namespace Yt\Dlp\Abstractions\Search;

class RequestedFormats extends \Yt\Dlp\Abstractions\AbstractIterable
{
    protected static string $itemClass = RequestedFormat::class;

    /**
     * @var RequestedFormat[] $items
     */
    protected array $items = [];
}
