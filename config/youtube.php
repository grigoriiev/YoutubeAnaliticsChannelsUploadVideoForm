<?php

/*
|--------------------------------------------------------------------------
| Laravel PHP Facade/Wrapper for the YoutubeApi Data API v3
|--------------------------------------------------------------------------
|
| Here is where you can set your key for YoutubeApi API. In case you do not
| have it, it can be acquired from: https://console.developers.google.com
*/

return [
    'key' => env('YOUTUBE_API_KEY', 'YOUR_API_KEY'),



        /**
         * Client ID.
         */
    'client_id' => env('GOOGLE_CLIENT_ID', null),

    /**
     * Client Secret.
     */
    'client_secret' => env('GOOGLE_CLIENT_SECRET', null),

    /**
     * Scopes.
     */
    'scopes' => [
    'https://www.googleapis.com/auth/youtube',
    'https://www.googleapis.com/auth/youtube.upload',
    'https://www.googleapis.com/auth/youtube.readonly'
],

    /**
     * Route URI's
     */
    'routes' => [

    /**
     * Determine if the Routes should be disabled.
     * Note: We recommend this to be set to "false" immediately after authentication.
     */
    'enabled' => true,

    /**
     * The prefix for the below URI's
     */
    'prefix' => 'youtube',

    /**
     * Redirect URI
     */
    'redirect_uri' => 'callback',

    /**
     * The autentication URI
     */
    'authentication_uri' => 'auth',

    /**
     * The redirect back URI
     */
    'redirect_back_uri' => '/',

]
];
