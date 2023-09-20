<?php

declare(strict_types=1);

use Application\App;

define("APP_PATH", dirname(__DIR__));

require_once __DIR__ . '/../vendor/autoload.php';

$app = new App();

$app->run();


