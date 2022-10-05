<?php
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$instaAccessToken = $_ENV['INSTA_ACCES_TOKEN'];
$baseUrl = 'https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token=';


// Use a free Cron Job service (e.g.: https://cron-job.org), and call this endpoint weekly, as Long-Lived Tokens are valid for only 60 days
// With calling this endpoint, your token will be refreshed to 60 days
// More info: https://developers.facebook.com/docs/instagram-basic-display-api/guides/long-lived-access-tokens#get-a-long-lived-token

$data = file_get_contents($baseUrl . $instaAccessToken);
echo("Trying to refresh instaToken DONE.");
