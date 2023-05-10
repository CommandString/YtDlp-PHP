<?php

namespace Yt\Dlp\Abstractions\Search;

class RequestedFormat
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

    public ?string $asr;
    public ?int $filesize;
    public ?string $format_id;
    public ?string $format_note;
    public ?int $source_preference;
    public ?int $fps;
    public ?string $audio_channels;
    public ?int $height;
    public ?int $quality;
    public ?bool $has_drm;
    public ?float $tbr;
    public ?string $url;
    public ?int $width;
    public ?string $language;
    public ?int $language_preference;
    public ?string $preference;
    public ?string $ext;
    public ?string $vcodec;
    public ?string $acodec;
    public ?string $dynamic_range;
    public ?float $vbr;
    public ?array $downloader_options;
    public ?string $container;
    public ?string $protocol;
    public ?string $resolution;
    public ?float $aspect_ratio;
    public ?array $http_headers;
    public ?string $video_ext;
    public ?string $audio_ext;
    public ?string $format;
    public ?float $abr;
}
