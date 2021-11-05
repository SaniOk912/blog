<?php

namespace core\user\controller;

use core\base\controller\BaseController;
use core\base\settings\Settings;
use core\user\model\Model;

class BaseUser extends BaseController
{
    protected $user_id;

    protected function inputData()
    {
        $this->init();

        if(!$this->model) $this->model = Model::instance();
        if(!$this->settings) $this->settings = Settings::instance();

    }

    protected function outputData()
    {
        if(!$this->content) {
            $args = func_get_arg(0);
            $vars = $args ? $args : [];

            $this->header = $this->render(TEMPLATE . 'include/header');
            $this->footer = $this->render(TEMPLATE . 'include/footer');

            $this->content = $this->render($this->template, $vars);
        }

        return $this->render(TEMPLATE . 'layout/default');
    }

    protected function outputNewData()
    {
        $this->header = $this->render(ADMIN_TEMPLATE . 'include/header');
        $this->footer = $this->render(ADMIN_TEMPLATE . 'include/footer');
        $this->content = $this->render('', ['template' => 'admin']);
        return $this->outputData();
    }

    protected function execBase()
    {
        self::inputData();
    }

    protected function createPostId($table, $date, $author)
    {
        $post_id = $this->model->get($table, [
            'fields' => ['id'],
            'where' => ['author_id' => $author, 'date' => $date]
        ]);
        return $post_id[0]['id'];
    }

    protected function checkLike()
    {
        if($_POST['date'] && $_POST['author_id'] && $_POST['table']) {

            $table = $_POST['table'];
            $date = $_POST['date'];
            $author = $_POST['author_id'];

            if($this->model->tableExists($table)) {

                $id = $this->createPostId($table, $date, $author);
                $post_id = $table . '/' . $id;

                $check_post_id = $this->model->get('likes', [
                    'fields' => ['id'],
                    'where' => ['post_id' => $post_id, 'user_id' => $_SESSION['id']]
                ])[0]['id'];

                $likes = $this->model->get($table, [
                    'fields' => ['likes'],
                    'where' => ['id' => $id]
                ])[0]['likes'];

                if($check_post_id) {
                    $this->model->delete('likes', [
                        'where' => ['id' => $check_post_id]
                    ]);

                    $likes--;
                }else{
                    $this->model->add('likes', [
                        'fields' => ['user_id' => $_SESSION['id'], 'post_id' => $post_id]
                    ]);

                    $likes++;
                }

                $this->model->edit($table, [
                    'fields' => ['likes' => $likes],
                    'where' => ['id' => $id]
                ]);
            }
            if($likes) $this->content = $likes;
            else $this->content = 'zero likes';
        }
    }

    protected function checkComment($action)
    {
        if($_POST['date'] && $_POST['author_id'] && $_POST['table'] && $_POST['content']) {

            $_POST = $this->clearStr($_POST);

            $table = $_POST['table'];
            $post_date = $_POST['date'];
            $author = $_POST['author_id'];
            $content = $_POST['content'];

            if($this->model->tableExists($table)) {
                $id = $this->createPostId($table, $post_date, $author);
                $post_id = $table . '/' . $id;

                if($action === 'comment') {
                    $this->model->add('comments', [
                        'fields' => ['author_id' => $_SESSION['id'], 'post_id' => $post_id, 'content' => $content, 'date' => date('Y-m-d H:i:s')]
                    ]);

                    $this->content = 'done';
                }elseif($action === 'edit') {

                    if($_SESSION['id'] = $author) {

                        $this->model->edit('comments', [
                            'fields' => ['content' => $content],
                            'where' => ['author_id' => $_SESSION['id'], 'date' => $post_date]
                        ]);
                    }
                }


            }
        }
    }

    protected function readMessage()
    {
        $this->model->edit('messages', [
            'fields' => ['is_read' => 'read'],
            'where' => ['user_id' => $_SESSION['id'], 'date' => $_POST['date']]
        ]);
    }

    protected function checkUser($email, $pass)
    {
        $var = $this->model->get('users', [
            'where' => ['email' => $email, 'password' => $pass]
        ]);

        if($var[0]) {
            $_SESSION['id'] = $var[0]['id'];
            $this->redirect('main');
            exit();
        }else{
            $var = $this->model->get('admins', [
                'where' => ['email' => $email, 'password' => $pass]
            ]);
            if($var[0]) {
                $_SESSION['id'] = $var[0]['id'];
                $_SESSION['admin'] = true;
                $this->redirect('main');
                exit();
            }
        }
    }

    protected function registration($username, $email, $pass)
    {
        $uEmail = $this->model->get('users', [
            'where' => ['email' => $email]
        ]);
        $AEmail = $this->model->get('admins', [
            'where' => ['email' => $email]
        ]);
        if($uEmail || $AEmail) {
            $this->redirect('signup?message=account already exists');
        }else{
            $this->model->add('users', [
                'fields' => [
                    'email' => $email,
                    'password' => $pass,
                    'username' => $username
                ]
            ]);
            $this->redirect('main?message=account created');
        }
    }
}