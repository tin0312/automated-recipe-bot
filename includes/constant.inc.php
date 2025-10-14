<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('CRYPT', [
    'indexKey' => $_ENV['CRYPT_INDEX_KEY'],
    'privateKey' => $_ENV['CRYPT_PRIVATE_KEY']
]);