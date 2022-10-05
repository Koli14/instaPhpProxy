<?php
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$csirke = $_ENV['ALMA'];
echo($csirke);
