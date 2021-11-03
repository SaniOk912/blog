<?php

namespace core\user\controller;

class LoginController extends BaseUser
{
    protected function inputData()
    {
        $this->execBase();

        if (isset($_POST['email']) && isset($_POST['password'])) {

            $email = addslashes($this->clearStr($_POST['email']));
            $pass = $this->clearStr($_POST['password']);

            echo'email';
            print_arr($email);
            echo'=================== <br>';
            echo'password';
            print_arr($pass);

            if (empty($email)) {
                header("Location: login?error=User Name is required");
                exit();
            } elseif (empty($pass)) {
                header("Location: login?error=User Password is required");
                exit();
            } else {
                $pass = md5($pass);

                print_arr($pass);

//                $var = $this->model->get('users', [
//                    'where' => "email='$email' AND password='$pass'"
//                ]);
//
//                if($var[0]) {
//                    $_SESSION['email'] = $var[0]['email'];
//                    $_SESSION['name'] = $var[0]['name'];
//                    $_SESSION['id'] = $var[0]['id'];
//                    $this->redirect('main');
//                    exit();
//                }else{
//                    $var = $this->model->get('admins', [
//                        'fields' => '*',
//                        'where' => "email='$email' AND password='$pass'"
//                    ]);
//                    if($var[0]) {
//                        $_SESSION['email'] = $var[0]['email'];
//                        $_SESSION['name'] = $var[0]['name'];
//                        $_SESSION['id'] = $var[0]['id'];
//                        $_SESSION['admin'] = true;
//                        $this->redirect('main');
//                        exit();
//                    }
//                }
            }

        }
    }
}