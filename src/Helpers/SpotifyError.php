<?php /** @noinspection ALL */

namespace Modelesque\Api\Helpers;

use JetBrains\PhpStorm\Pure;
use Modelesque\ApiTokenManager\Helpers\ErrorMessage;
use Modelesque\App\Requests\AlbumRequests;

class SpotifyError
{
    public const PLATFORM = 'Spotify';


    // ALBUMS
    // ===================================================================================

    #[Pure]
    /** @see AlbumRequests::get() */
    public static function getAlbums(string $title = '', string $loop = ''): string
    {
        return ErrorMessage::forGetRequest('albums', $title, self::PLATFORM, $loop);
    }

    #[Pure]
    /** @see AlbumRequests::getUsersSavedAlbums() */
    public static function getUsersSavedAlbums(string $title = '', string $loop = ''): string
    {
        return ErrorMessage::forGetRequest('my saved albums', $title, self::PLATFORM, $loop);
    }
    

    // ARTISTS
    // ===================================================================================
    
    #[Pure]
    public static function getArtists(string $title = '', string $loop = ''): string
    {
        return ErrorMessage::forGetRequest('artists', $title, self::PLATFORM, $loop);
    }


    // PLAYLISTS
    // ===================================================================================
    
    #[Pure]
    public static function getPlaylist(string $title = '', string $loop = ''): string
    {
        return ErrorMessage::forGetRequest('playlist', $title, self::PLATFORM, $loop);
    }

    #[Pure]
    public static function createPlaylist(string $title = '', string $loop = ''): string
    {
        return ErrorMessage::forPostRequest('playlist', $title, self::PLATFORM, $loop);
    }

    #[Pure]
    public static function changePlaylistDetails(string $title = '', string $loop = ''): string
    {
        return ErrorMessage::forPutRequest("playlist's details", $title, self::PLATFORM, $loop);
    }

    #[Pure]
    public static function reorderPlaylistItems(string $title = '', string $loop = ''): string
    {
        return ErrorMessage::forPutRequest('playlist items', $title, self::PLATFORM, $loop);
    }

    #[Pure]
    public static function replacePlaylistItems(string $title = '', string $loop = ''): string
    {
        return ErrorMessage::forPutRequest('playlist items', $title, self::PLATFORM, $loop);
    }

    #[Pure]
    public static function addPlaylistItems(string $title = '', string $loop = ''): string
    {
        return ErrorMessage::forPostRequest('playlist items', $title, self::PLATFORM, $loop);
    }

    #[Pure]
    public static function getPlaylistTracks(string $title = '', string $loop = ''): string
    {
        return ErrorMessage::forPostRequest('tracks for playlist', $title, self::PLATFORM, $loop);
    }


    // TRACKS
    // ===================================================================================
    
    #[Pure]
    public static function getTracks(string $title, string $loop = ''): string
    {
        return ErrorMessage::forGetRequest('tracks', $title, self::PLATFORM, $loop);
    }
}