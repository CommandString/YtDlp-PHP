<?php

namespace Yt\Dlp\Parts;

use CommandString\Utils\ArrayUtils;
use Yt\Dlp\Options;
use Yt\Dlp\YtDlp;

class Video {
    private array $props;

    public function __construct(private string $url, private YtDlp $ytDlp, bool $fill = true) {
        if ($fill) {
            $this->fill();
        }
    }

    public function fill() {
        $this->props = [];

        $result = $this->ytDlp->newCommand($this->url)
            ->addOption(Options::SKIP_DOWNLOAD)
            ->addOption(Options::DUMP_JSON)
            ->execute()
        ;

        $json = json_decode($result->output, true);

        foreach ($json as $key => $value) {
            $this->props[$key] = is_array($value) ? ArrayUtils::toStdClass($value) : $value;
        }
    }

    public function __get($name): mixed
    {
        return $this->props[$name] ?? null;
    }

    public function getAudioOnlyFormats(): array
    {
        $formats = [];
        
        foreach ($this->props["formats"] as $format) {
            if ($format->audio_ext !== "none" && $format->video_ext === "none") {
                $formats[] = $format;
            }
        }

        return $formats;
    }

    public function isFilled() {
        return isset($this->props);
    }

    public function fillIfNotFilled() {
        if (!$this->isFilled()) {
            $this->fill();
        }
    }

    public function getVideoOnlyFormats(): array
    {
        $this->fillIfNotFilled();

        $formats = [];
        
        foreach ($this->props["formats"] as $format) {
            if ($format->audio_ext === "none" && $format->video_ext !== "none") {
                $formats[] = $format;
            }
        }

        return $formats;
    }

    public function getAudioAndVideoFormats(): array
    {
        $this->fillIfNotFilled();
        
        $formats = [];
        
        foreach ($this->props["formats"] as $format) {
            if ($format->audio_ext !== "none" && $format->video_ext !== "none") {
                $formats[] = $format;
            }
        }

        return $formats;
    }
}