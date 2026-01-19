<?php

namespace Modelesque\Api\Spotify\Helpers;

class SpotifyTest
{
    /** Returns a Spotify artist ID (or name). */
    public static function artist(bool $name = false, int $index = 0): string
    {
        $data = match ($index) {
            1 => ['name' => 'David Lynch', 'value' => '2Gu6Q05ExIGwHTF43kqLBI'],
            default => ['name' => 'Angelo Badalamenti', 'value' => '3Eeb1U0VJTDaFpBHV4DmHl']
        };

        return $data[$name ? 'name': 'value'];
    }

    /** Returns a Spotify album ID (or title). */
    public static function album(bool $title = false, int $index = 0): string
    {
        $data = match ($index) {
            1 => ['name' => 'Crazy Clown Time', 'value' => '7KlUsFplaGzg4B0gnqkRxS'],
            default => ['name' => 'Twin Peaks: Season Two Music And More', 'value' => '0TDR91zfgRBdMV6iX1whhj']
        };

        return $data[$title ? 'name': 'value'];
    }

    /** Returns a Spotify track ID (or title). */
    public static function track(bool $title = false, int $index = 0): string
    {
        $data = match ($index) {
            1 => ['name' => "Pinky's Dream", 'value' => '5kzGxs6isTLj5lW9Ptwar5'],
            default => ['name' => 'Blue Frank', 'value' => '2cqRMfCvT9WIdUiaIVB6EJ']
        };

        return $data[$title ? 'name': 'value'];
    }

    /** Returns a Spotify playlist ID (or title). */
    public static function playlist(bool $title = false, int $index = 0): string
    {
        $data = match ($index) {
            1 => ['name' => 'How To Saw A Woman In Half', 'value' => '6sgvKY8rQiQoCtMJCF6GzJ'],
            default => ['name' => 'Disappears In The Pattern', 'value' => '0nwk5PhCiXSuotiH1CCigu']
        };

        return $data[$title ? 'name': 'value'];
    }
}