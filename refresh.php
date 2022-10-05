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
$baseUrl = 'https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token=';
$instance = 'refreshToken';

$logger = new Logger($instance);
$logger->pushHandler(new StreamHandler(__DIR__.'/'.$instance.'.log', Level::Info));
$logger->pushHandler(new FirePHPHandler());

// Use a free Cron Job service (e.g.: https://cron-job.org), and call this endpoint weekly, as Long-Lived Tokens are valid for only 60 days
// With calling this endpoint, your token will be refreshed to 60 days
// More info: https://developers.facebook.com/docs/instagram-basic-display-api/guides/long-lived-access-tokens#get-a-long-lived-token

$data = file_get_contents($baseUrl . $instaAccessToken);
$logger->info("Trying to refresh instaToken DONE.", [$data]);
echo("Trying to refresh instaToken DONE.");
var_dump($data);
