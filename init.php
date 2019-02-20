<?php

session_start();

require_once APP_ROOT_DIR . '/services/autoload.php';
spl_autoload_register('__autoload');

require APP_ROOT_DIR . '/models/Address.php';
require APP_ROOT_DIR . '/controllers/AddressController.php';
require APP_ROOT_DIR . '/routes/router.php';

exit;
