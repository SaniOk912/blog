<?php

use core\base\exceptions\RouteException;
use core\base\controller\RouteController;

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