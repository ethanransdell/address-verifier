<?php

$configFilename = __DIR__ . '/env_config.php';
if (!file_exists($configFilename)) {
    require_once __DIR__ . '/views/errors/500.php';
    exit;
}

require_once $configFilename;

$initFilename = APP_ROOT_DIR . '/init.php';
if (!file_exists($initFilename)) {
    require_once APP_ROOT_DIR . '/views/errors/500.php';
    exit;
}

require_once $initFilename;
