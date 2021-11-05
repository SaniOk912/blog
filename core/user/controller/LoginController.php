<?php

namespace core\user\controller;

class LoginController extends BaseUser
{
    protected function inputData()
    {
        $this->execBase();

        if (isset($_POST['email']) && isset($_POST['password'])) {

            $email = addslashes($this->clearStr($_POST['email']));
            $pass = addslashes($this->clearStr($_POST['password']));

            $pass = md5($pass);

            $this->checkUser($email,$pass);

        }
    }
}