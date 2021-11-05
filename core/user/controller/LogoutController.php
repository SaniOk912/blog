<?php

namespace core\user\controller;

class LogoutController extends BaseUser
{
    protected function inputData()
    {
        session_unset();
        session_destroy();

        $this->redirect('main');
    }

}