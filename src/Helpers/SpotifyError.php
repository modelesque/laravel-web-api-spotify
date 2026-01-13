<?php

use JetBrains\PhpStorm\Pure;
use Modelesque\ApiTokenManager\Helpers\ErrorMessage;

class SpotifyError
{
    /**
     * @param string $title
     * @param string $platform
     * @param string $loop
     * @return string
     */
    #[Pure]
    public static function getAlbum(string $title, string $platform, string $loop = ''): string
    {
        return ErrorMessage::forGetRequest('album', $title, $platform, $loop);
    }

    /**
     * @param string $title
     * @param string $platform
     * @param string $loop
     * @return string
     */
    #[Pure]
    public static function getArtist(string $title, string $platform, string $loop = ''): string
    {
        return ErrorMessage::forGetRequest('artist', $title, $platform, $loop);
    }

    /**
     * @param string $title
     * @param string $platform
     * @param string $loop
     * @return string
     */
    #[Pure]
    public static function getPlaylist(string $title, string $platform, string $loop = ''): string
    {
        return ErrorMessage::forGetRequest('playlist', $title, $platform, $loop);
    }

    /**
     * @param string $title
     * @param string $platform
     * @param string $loop
     * @return string
     */
    #[Pure]
    public static function getTrack(string $title, string $platform, string $loop = ''): string
    {
        return ErrorMessage::forGetRequest('track', $title, $platform, $loop);
    }
}