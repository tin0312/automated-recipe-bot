<?php

session_name('i65nyYg3MU77ZQvJAYnNheC9Qq4Eu2hma8jEh4AE');

if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

// GENERATE CSRF TOKEN
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$csrf_token = $_SESSION['csrf_token'];


