<?php
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Monolog\Formatter\LineFormatter;

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

// Checks if there is data in the cache by key
$cachedData = apcu_fetch($cacheKey);
if(!$cachedData) {
  $cachedData = file_get_contents($baseUrl . $instaAccessToken);
  $ttl = 60 * 15; // 15 minutes.
  $isStored = apcu_store($cacheKey, $cachedData, $ttl);

  $dateFormat = "Y.m.d H:i:s";
  $output = "[%datetime%] > %level_name% > %message% %context%\n";
  $formatter = new LineFormatter($output, $dateFormat);
  $stream = new StreamHandler(__DIR__.'/'.$cacheKey.'.log', Level::Info);
  $stream->setFormatter($formatter);
  $logger = new Logger($cacheKey);
  $logger->pushHandler($stream);
  $logger->pushHandler(new FirePHPHandler());
  $logger->info("Cache generated: ", [$isStored]);
}

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
echo ($cachedData);
exit();
