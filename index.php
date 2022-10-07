<?php
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$instaAccessToken = $_ENV['INSTA_ACCES_TOKEN'];
$instaId = $_ENV['INSTA_USER_ID'];
$allowOrigin = $_ENV['ALLOW_ORIGIN'];
$limit = 8;
// See the list of possible fields here: https://developers.facebook.com/docs/instagram-basic-display-api/reference/media#fields
$fields = 'id,caption,media_url,permalink';
$url = "https://graph.instagram.com/v6.0/{$instaId}/media?fields={$fields}&limit={$limit}&access_token={$instaAccessToken}";

$cacheKey = 'instaProxy';

// Checks if there is data in the cache by key
$cachedData = apcu_fetch($cacheKey);
if(!$cachedData) {
  $cachedData = file_get_contents($url);
  $ttl = 60 * 15; // 15 minutes.
  $isStored = apcu_store($cacheKey, $cachedData, $ttl);
}

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: {$allowOrigin}");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Vary: Origin");
echo ($cachedData);
exit();
