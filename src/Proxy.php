<?php

interface VideoDownloader {
    public function download(string $id): string;
}

class GoogleVideoDownloader implements VideoDownloader {

    public function download(string $id): string
    {
        set_time_limit(5);

        return 'somedata';
    }
}

class ProxyVideoDownloader implements VideoDownloader {
    static array $CACHED_VIDEOS = [];

    private GoogleVideoDownloader $downloader;

    public function __construct(GoogleVideoDownloader $downloader)
    {
        $this->downloader = $downloader;
    }

    public function download(string $id): string {
        if (array_key_exists($id, self::$CACHED_VIDEOS)) {
            return self::$CACHED_VIDEOS[$id];
        }
        $this->logInfo('Downloading Video');
        $video = $this->downloader->download($id);
        $this->logInfo('Downloaded Video');
        $this->cacheVideo($id, $video);
        $this->logInfo('Cached Downloaded Video');

        return $video;
    }

    public function logInfo(string $message) {
        echo $message.PHP_EOL;
    }

    public function cacheVideo(string $id, string $video) {
        self::$CACHED_VIDEOS[][$id] = $video;
    }
}

function downloadVideo(VideoDownloader $downloader, string $id): void
{
    echo $downloader->download($id).PHP_EOL;
}

$googleVideoDownloader = new GoogleVideoDownloader();
downloadVideo($googleVideoDownloader, 'gela');

$proxyVideoDownloader = new ProxyVideoDownloader($googleVideoDownloader);
downloadVideo($proxyVideoDownloader, 'gela');