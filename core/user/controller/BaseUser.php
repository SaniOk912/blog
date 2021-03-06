<?php

namespace core\user\controller;

use core\base\controller\BaseController;
use core\base\settings\Settings;
use core\user\model\Model;

class BaseUser extends BaseController
{
    protected $userPath;
    protected $userInfo;
    protected $posts;
    protected $comments;

    protected function inputData()
    {
        $this->init();

        if(!$this->model) $this->model = Model::instance();
        if(!$this->settings) $this->settings = Settings::instance();
        if(!$this->userPath) $this->userPath = $this->settings->get('routes')['user']['path'];
        if(!$this->formTemplates) $this->formTemplates = $this->settings->get('routes')['user']['formTemplates'];

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

    protected function checkUser($email, $pass)
    {
        $id = $this->model->get('users', [
            'where' => ['email' => $email, 'password' => $pass]
        ])[0]['id'];

        if($id) {
            $_SESSION['id'] = $id;
            $this->redirect("main/$id");
            exit();
        }else{
            $adminId = $this->model->get('admins', [
                'where' => ['email' => $email, 'password' => $pass]
            ])[0]['id'];
            if($adminId) {
                $_SESSION['admin_id'] = $adminId;
                $_SESSION['admin'] = true;
                $this->redirect("main/$adminId");
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

    protected function createPostsData($selectionField, $comments = false)
    {
        $id = key($this->parameters);

        $this->posts = $this->model->get('posts', [
            'fields' => ['*'],
            'where' => [$selectionField => $id]
        ]);

        if($comments) {
            foreach ($this->posts as $key => $value) {
                $post_id = 'posts/' . $value['id'];

                $this->comments = $this->model->get('comments', [
                    'fields' => ['*'],
                    'where' => ['post_id' => $post_id]
                ]);
            }
            foreach ($this->comments as $key => $value) {
                $this->userInfo[] = $this->model->get('users', [
                    'fields' => ['id', 'username', 'img'],
                    'where' => ['id' => $value['author_id']]
                ])[0];
            }
        }
    }
}