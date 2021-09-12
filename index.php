<?php

use base\controller\RouteController;

include 'settings.php';
include 'config.php';
include 'base/controller/RouteController.php';

RouteController::instance()->route();

echo '<=== V2 BRANCH ===>';