<?php
// tests/bootstrap.php

// Include Composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Set timezone
date_default_timezone_set('Asia/Jakarta');

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "PHPUnit bootstrap loaded successfully!\n";