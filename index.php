<?php

use core\base\controller\RouteController;

include 'settings.php';
include 'config.php';
include 'core/base/controller/RouteController.php';

RouteController::instance()->route();

//echo '<=== V2 BRANCH ===>';