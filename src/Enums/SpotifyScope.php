<?php

namespace Modelesque\Api\Spotify\Enums;

enum SpotifyScope: string
{
    case UPLOAD_IMAGES = 'ugc-image-upload';
    case PLAYBACK_STATE_READ = 'user-read-playback-state';
    case PLAYBACK_STATE_WRITE = 'user-modify-playback-state';
    case CURRENTLY_PLAYING_READ = 'user-read-currently-playing';
    case REMOTE_CONTROL = 'app-remote-control';
    case STREAMING = 'streaming';
    case PLAYLIST_PRIVATE_READ = 'playlist-read-private';
    case PLAYLIST_PRIVATE_WRITE = 'playlist-modify-private';
    case PLAYLIST_PUBLIC_WRITE = 'playlist-modify-public';
    case PLAYLIST_COLLABORATIVE_READ = 'playlist-read-collaborative';
    case FOLLOWING_READ = 'user-follow-read';
    case FOLLOWING_WRITE = 'user-follow-modify';
    case PLAYBACK_POSITION_READ = 'user-read-playback-position';
    case TOP_ARTISTS_READ = 'user-top-read';
    case RECENTLY_PLAYED_READ = 'user-read-recently-played';
    case MY_LIBRARY_WRITE = 'user-library-modify';
    case MY_LIBRARY_READ = 'user-library-read';
    case MY_EMAIL_READ = 'user-read-email';
    case MY_SUBSCRIPTION_READ = 'user-read-private';
    case PERSONALIZED_CONTENT = 'user-personalized';
    case SOA_LINK = 'user-soa-link';
    case SOA_UNLINK = 'user-soa-unlink';
    case SOA_MANAGE_ENTITLEMENTS = 'soa-manage-entitlements';
    case SOA_MANAGE_PARTNER = 'soa-manage-partner';
    case SOA_CREATE_PARTNER = 'soa-create-partner';
}