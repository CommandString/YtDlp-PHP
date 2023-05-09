<?php

namespace Yt\Dlp\Abstractions\Search;

class Format
{
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (!property_exists(self::class, $key)) {
                continue;
            }

            if ($key === 'fragments') {
                $class = match ($key) {
                    'fragments' => Fragment::class,
                };
                $value = new $class($value);
            }

            $this->{$key} = $value;
        }
    }

    public string $format_id;
    public string $format_note;
    public string $ext;
    public string $protocol;
    public string $acodec;
    public string $vcodec;
    public string $url;
    public int $width;
    public int $height;
    public float $fps;
    public int $rows;
    public int $columns;

    /**
     * @var Fragment[]
     */
    public array $fragments;
    public string $resolution;
    public float $aspect_ratio;
    public array $http_headers;
    public string $audio_ext;
    public string $video_ext;
    public string $format;
    public int $asr;
    public int $filesize;
    public int $source_preference;
    public int $audio_channels;
    public int $quality;
    public bool $has_drm;
    public float $tbr;
    public string $language;
    public int $language_preference;
    public string $preference;
    public string $dynamic_range;
    public float $abr;
    public array $downloader_options;
    public string $container;
    public float $vbr;
    public int $filesize_approx;
}
