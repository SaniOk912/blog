<?php

use core\base\exceptions\RouteException;
use core\base\controller\RouteController;

//define('VG_ACCESS', true);

//header('Content-Type:text/html:charset=utf-8');
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

//echo '<=== V2 BRANCH ===>';