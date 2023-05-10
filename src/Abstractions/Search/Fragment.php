<?php

namespace Yt\Dlp\Abstractions\Search;

class Fragment
{
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (!property_exists(self::class, $key)) {
                continue;
            }

            $this->{$key} = $value;
        }
    }

    public ?string $url;
    public ?int $duration;
}
