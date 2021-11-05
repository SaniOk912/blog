<?php

namespace core\user\controller;

class SignupController extends BaseUser
{
    protected function inputData()
    {
        $this->execBase();

        $this->checkUserData();
    }


    protected function checkUserData()
    {
        if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['re_password']) && isset($_POST['username'])) {

            $username = addslashes($this->clearStr($_POST['username']));
            $email = addslashes($this->clearStr($_POST['email']));

            if($_POST['password'] === $_POST['re_password']) {
                $pass = addslashes($this->clearStr($_POST['password']));

                $pass = md5($pass);

                $this->registration($username, $email, $pass);
            }

        }
    }
}