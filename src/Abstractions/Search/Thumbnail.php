<?php

namespace Yt\Dlp\Abstractions\Search;

class Thumbnail
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

    public string $url;
    public int $preference;
    public string $id;
    public int $height;
    public int $width;
    public string $resolution;
}
