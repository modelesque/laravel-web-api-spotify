<?php

namespace Modelesque\App\Requests;

use Illuminate\Http\Client\ConnectionException;
use Modelesque\Api\Helpers\SpotifyConfig;
use Modelesque\Api\Helpers\SpotifyError;
use Modelesque\ApiTokenManager\Exceptions\InvalidConfigException;
use Modelesque\App\Abstracts\Request;

/**
 * REST requests from Spotify's Web API regarding playlists.
 */
class PlaylistRequests extends Request
{
    /**
     * Get a single playlist by its ID.
     *
     * @param string $id
     * @param int $limit
     * @param int $offset
     * @param string|null $fields A comma-separated list of the fields to return.
     * @param string|null $market
     * @return mixed
     * @throws ConnectionException
     * @see https://developer.spotify.com/documentation/web-api/reference/get-playlist
     * @see SpotifyError::getPlaylist()
     */
    public function get(
        string $id,
        int $limit = 50,
        int $offset = 0,
        ?string $fields = null,
        ?string $market = null
    ): mixed
    {
        return $this->client->get(
            'playlists/' . $id,
            $this->requests->formatParams([
                'market' => $market,
                'fields' => $fields,
                'limit' => $limit > 50 ? 50 : $limit,
                'offset' => $offset,
            ])
        );
    }

    /**
     * Get a playlist's items (tracks or episodes).
     *
     * Note: If you first called `get()` to fetch the playlist's details,
     * it automatically returns the first batch of tracks based on the limit.
     *
     * Note: The request must be made with the "authorization" access token and requires
     * this scope:
     *  1) SCOPE_PLAYLIST_PRIVATE_WRITE
     *
     * @param string $id
     * @param int $limit
     * @param int $offset
     * @param string|null $fields
     * @param string|null $market
     * @return mixed
     * @throws ConnectionException
     * @see https://developer.spotify.com/documentation/web-api/reference/get-playlists-tracks
     * @see SpotifyError::getPlaylistTracks()
     */
    public function getItems(
        string $id,
        int $limit = 50,
        int $offset = 0,
        ?string $fields = null,
        ?string $market = null
    ): mixed
    {
        $id = $this->requests->formatIds($id);

        return $this->client->get(
            "playlists/$id/tracks",
            $this->requests->formatParams([
                'market' => $market,
                'fields' => $fields,
                'limit' => $limit > 50 ? 50 : $limit,
                'offset' => $offset,
            ])
        );
    }

    /**
     * Create a new playlist.
     *
     * Note: The request must be made with the "authorization" access token and requires
     * these scopes:
     *  1) SCOPE_PLAYLIST_PUBLIC_WRITE
     *  2) SCOPE_PLAYLIST_PRIVATE_WRITE
     *
     * @param string $name
     * @param string $description
     * @param string $account
     * @param bool $public
     * @param bool $collaborative
     * @return mixed
     * @throws ConnectionException
     * @throws InvalidConfigException
     * @see https://developer.spotify.com/documentation/web-api/reference/create-playlist
     * @see SpotifyError::createPlaylist()
     */
    public function create(
        string $name,
        string $description = '',
        string $account = '',
        bool $public = true,
        bool $collaborative = false
    ): mixed
    {
        $userId = SpotifyConfig::getRequired('user_id', $account);

        return $this->client->post(
            "users/$userId/playlists",
            array_filter([
                'name' => $name,
                'description' => $description,
                'public' => $public,
                'collaborative' => $collaborative,
            ], static fn($v) => $v !== '')
        );
    }

    /**
     * Edit a playlist's details.
     *
     * Note: The request must be made with the "authorization" access token and requires
     * these scopes:
     *  1) SCOPE_PLAYLIST_PUBLIC_WRITE
     *  2) SCOPE_PLAYLIST_PRIVATE_WRITE
     *
     * @param string $id
     * @param string $name
     * @param string $description
     * @param bool $public
     * @param bool $collaborative
     * @return mixed
     * @throws ConnectionException
     * @see https://developer.spotify.com/documentation/web-api/reference/change-playlist-details
     * @see SpotifyError::
     */
    public function changeDetails(
        string $id,
        string $name = '',
        string $description = '',
        bool $public = true,
        bool $collaborative = false
    ): mixed
    {
        return $this->client->put(
            'playlists/' . $this->requests->formatIds($id),
            array_filter([
                'name' => $name,
                'description' => $description,
                'public' => $public,
                'collaborative' => $collaborative,
            ], static fn($v) => $v !== '')
        );
    }

    /**
     * Reorder items (tracks or episodes) in a playlist.
     *
     * Note: The request must be made with the "authorization" access token and requires
     * these scopes:
     *  1) SCOPE_PLAYLIST_PUBLIC_WRITE
     *  2) SCOPE_PLAYLIST_PRIVATE_WRITE
     *
     * Note: this uses the same endpoint as replaceItems(), but they're separated for
     * simplicity.
     *
     * @param string $id
     * @param int $rangeStart
     * @param int $insertBefore
     * @param int $rangeLength
     * @param string|null $snapshotId
     * @return mixed
     * @throws ConnectionException
     * @see https://developer.spotify.com/documentation/web-api/reference/reorder-or-replace-playlists-tracks
     * @see SpotifyError::reorderPlaylistItems()
     * @see replaceItems
     */
    public function reorderItems(
        string $id,
        int $rangeStart,
        int $insertBefore,
        int $rangeLength = 1,
        ?string $snapshotId = null
    ): mixed
    {
        $id = $this->requests->formatIds($id);

        return $this->client->put(
            "playlists/$id/tracks",
            array_filter([
                'range_start' => $rangeStart,
                'insert_before' => $insertBefore,
                'range_length' => $rangeLength,
                'snapshot_id' => $snapshotId,
            ], static fn($v) => $v !== null)
        );
    }

    /**
     * Replace a Spotify playlist's items (tracks or episodes) with an array of Spotify
     * URIs. A maximum of 100 URIs are allowed, and an empty array will clear out the
     * playlist's tracks entirely.
     *
     * Note: The request must be made with the "authorization" access token and requires
     * these scopes:
     *  1) SCOPE_PLAYLIST_PUBLIC_WRITE
     *  2) SCOPE_PLAYLIST_PRIVATE_WRITE
     *
     * Note: this uses the same endpoint as reorderItems(), but they're separated for
     * simplicity.
     *
     * @param string $id
     * @param array $uris
     * @return mixed
     * @throws ConnectionException
     * @see https://developer.spotify.com/documentation/web-api/reference/reorder-or-replace-playlists-tracks
     * @see https://developer.spotify.com/documentation/web-api/concepts/spotify-uris-ids
     * @see SpotifyError::replacePlaylistItems()
     * @see reorderItems
     */
    public function replaceItems(
        string $id,
        array $uris,
    ): mixed
    {
        $id = $this->requests->formatIds($id);

        return $this->client->put(
            "playlists/$id/tracks",
            $this->requests->formatParams(['uris' => $uris])
        );
    }

    /**
     * Add tracks to a Spotify playlist via the tracks' URIs. A maximum of 100 is
     * allowed. If the position is null, the songs will be appended to the list of tracks
     * already in the playlist.
     *
     * Note: The request must be made with the "authorization" access token and requires
     * these scopes:
     *  1) SCOPE_PLAYLIST_PUBLIC_WRITE
     *  2) SCOPE_PLAYLIST_PRIVATE_WRITE
     *
     * @param string $id
     * @param array $uris
     * @param int|null $position
     * @return mixed
     * @throws ConnectionException
     * @see https://developer.spotify.com/documentation/web-api/reference/add-tracks-to-playlist
     * @see https://developer.spotify.com/documentation/web-api/concepts/spotify-uris-ids
     * @see SpotifyError::addPlaylistItems()
     */
    public function addItems(
        string $id,
        array $uris,
        ?int $position = null
    ): mixed
    {
        $id = $this->requests->formatIds($id);

        return $this->client->post(
            "playlists/$id/tracks",
            $this->requests->formatParams([
                'uris' => $uris,
                'position' => $position,
            ])
        );
    }
}