<?php

namespace Yt\Dlp\Abstractions\Search;

class Result
{
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $key = trim($key, '_');

            if (!property_exists(self::class, $key)) {
                continue;
            }

            if (in_array($key, ['formats', 'thumbnails', 'requested_formats'])) {
                $class = match ($key) {
                    'formats' => Format::class,
                    'thumbnails' => Thumbnail::class,
                    'requested_formats' => RequestedFormat::class
                };

                $groupedClass = match ($key) {
                    'formats' => Formats::class,
                    'thumbnails' => Thumbnails::class,
                    'requested_formats' => RequestedFormats::class
                };

                foreach ($value as &$v) {
                    $v = new $class($v);
                }

                $value = new $groupedClass($value);
            }

            $this->{$key} = $value;
        }
    }

    public ?string $id;
    public ?string $title;
    public ?Formats $formats;
    public ?Thumbnails $thumbnails;
    public ?string $thumbnail;
    public ?string $description;
    public ?string $uploader;
    public ?string $uploader_id;
    public ?string $uploader_url;
    public ?string $channel_id;
    public ?string $channel_url;
    public ?int $duration;
    public ?int $view_count;
    public ?string $average_rating;
    public ?int $age_limit;
    public ?string $webpage_url;
    public ?array $categories;
    public ?array $tags;
    public ?bool $playable_in_embed;
    public ?string $live_status;
    public ?string $release_timestamp;
    public ?array $format_sort_fields;
    public ?array $automatic_captions;
    public ?array $subtitles;
    public ?string $comment_count;
    public ?string $chapters;
    public ?int $like_count;
    public ?string $channel;
    public ?int $channel_follower_count;
    public ?string $upload_date;
    public ?string $availability;
    public ?string $original_url;
    public ?string $webpage_url_basename;
    public ?string $webpage_url_domain;
    public ?string $extractor;
    public ?string $extractor_key;
    public ?int $playlist_count;
    public ?string $playlist;
    public ?string $playlist_id;
    public ?string $playlist_title;
    public ?string $playlist_uploader;
    public ?string $playlist_uploader_id;
    public ?int $n_entries;
    public ?int $playlist_index;
    public ?int $last_playlist_index;
    public ?int $playlist_autonumber;
    public ?string $display_id;
    public ?string $fulltitle;
    public ?string $duration_string;
    public ?bool $is_live;
    public ?bool $was_live;
    public ?array $requested_subtitles;
    public ?string $has_drm;
    public ?RequestedFormats $requested_formats;
    public ?string $format;
    public ?string $format_id;
    public ?string $ext;
    public ?string $protocol;
    public ?string $language;
    public ?string $format_note;
    public ?int $filesize_approx;
    public ?float $tbr;
    public ?int $width;
    public ?int $height;
    public ?string $resolution;
    public ?int $fps;
    public ?string $dynamic_range;
    public ?string $vcodec;
    public ?float $vbr;
    public ?string $stretched_ratio;
    public ?float $aspect_ratio;
    public ?string $acodec;
    public ?float $abr;
    public ?int $asr;
    public ?int $audio_channels;
    public ?int $epoch;
    public ?string $filename;
    public ?string $urls;
    public ?string $type;
    public ?array $version;
}
