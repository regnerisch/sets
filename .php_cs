<?php

require_once __DIR__ . '/vendor/autoload.php';

$config = new \Regnerisch\PhpCsFixerConfig\Php72Config();

$config->getFinder()
    ->in([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

return $config;
