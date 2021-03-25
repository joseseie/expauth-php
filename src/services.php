<?php
return [
'google' => [
    'client_id' => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect' => env('GOOGLE_CLIENT_REDIRECT'),
],
'linkedin' => [
    'client_id' => env('LINKEDIN_CLIENT_ID'),
    'client_secret' => env('LINKEDIN_CLIENT_SECRET'),
    'redirect' => env('LINKEDIN_CALLBACK_URL'),
],
'facebook' => [
    'client_id' => env('FACEBOOK_APP_ID'),
    'client_secret' => env('FACEBOOK_APP_SECRET'),
    'redirect' => env('FACEBOOK_REDIRECT'),
  ],
  'github' => [
    'client_id' => env('GITHUB_CLIENT_ID'),
    'client_secret' => env('GITHUB_APP_SECRET'),
    'redirect' => env('GITHUB_REDIRECT'),
],
];
