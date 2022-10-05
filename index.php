<?php
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


$json = file_get_contents($baseUrl . $instaAccessToken);
$obj = json_decode($json);
var_dump($obj);
