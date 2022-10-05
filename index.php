<?php
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$instaAccessToken = $_ENV['INSTA_ACCES_TOKEN'];
$instaId = $_ENV['INSTA_USER_ID'];
$limit = 8;
// See the list of possible fields here: https://developers.facebook.com/docs/instagram-basic-display-api/reference/media#fields
$fields = 'id,caption,media_url,permalink';
$baseUrl = "https://graph.instagram.com/v6.0/{$instaId}/media?fields={$fields}&limit={$limit}&access_token=";

$cacheKey = 'instaProxy';
$ttl = 60 * 15; // 15 minutes.

// Create the logger
$logger = new Logger($cacheKey);
// Now add some handlers
$logger->pushHandler(new StreamHandler(__DIR__.'/'.$cacheKey.'.log', Level::Info));
$logger->pushHandler(new FirePHPHandler());

// Checks if there is data in the cache by key
$cachedData = apcu_fetch($cacheKey);
if(!$cachedData) {
  $cachedData = file_get_contents($baseUrl . $instaAccessToken);
  $isStored = apcu_store($cacheKey, $cachedData, $ttl);
  $logger->info("Cache generated: ", [$isStored]);
}

header("Content-Type: application/json");
echo ($cachedData);
exit();
