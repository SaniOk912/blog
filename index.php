<?php

use core\base\exceptions\RouteException;
use core\base\controller\RouteController;

session_start();

include 'settings.php';
include 'config.php';
include 'core/base/controller/RouteController.php';

try {
    RouteController::instance()->route();
}
catch (RouteException $e) {
    exit($e->getError());
}
