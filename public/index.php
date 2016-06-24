<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/Configurations/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../src/Configurations/dependencies.php';

// Register middleware
require __DIR__ . '/../src/Configurations/middleware.php';

// Register routes
$routeFiles = glob('../src/Routes/*.php');
foreach($routeFiles as $routeFile) {
    require ($routeFile);
}

// Run app
$app->run();