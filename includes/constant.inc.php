<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define('CRYPT', [
    'indexKey' => $_ENV['CRYPT_INDEX_KEY'],
    'privateKey' => $_ENV['CRYPT_PRIVATE_KEY']
]);

define('SUCCESS_CODE', 200);
define('EMAIL_ERROR_CODE', 300);
define('DATABASE_ERROR', 100);
define('USER_EMAIL', 'automatedrecipebot@gmail.com');
define('USER_PASSWORD', 'sqxtyaqmqgjwjuf');