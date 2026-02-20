<?php
session_start();

define('BASE_PATH', dirname(__DIR__, 2));
define('APP_PATH', BASE_PATH . '/app');
define('VIEW_PATH', APP_PATH . '/views');
define('CONTROLLER_PATH', APP_PATH . '/controllers');
define('MODEL_PATH', APP_PATH . '/models');

// autoload composer
$vendorAutoload = BASE_PATH . "/vendor/autoload.php";
// var_dump($vendorAutoload);
if (file_exists($vendorAutoload)) {
    require_once $vendorAutoload;
    // Load MailService (không phải Composer package nên cần require thủ công)
    require_once BASE_PATH . '/vendor/Mailservice.php';
} else {
    echo "not working";
}

if (class_exists(\Dotenv\Dotenv::class)) {
    \Dotenv\Dotenv::createImmutable(APP_PATH)->safeLoad();
}

// var_dump(APP_PATH);
// var_dump($_ENV);

spl_autoload_register(function (string $class): void {
    $paths = [
        APP_PATH . '/core/' . $class . '.php',
        CONTROLLER_PATH . '/' . $class . '.php',
        MODEL_PATH . '/' . $class . '.php',
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});
?>