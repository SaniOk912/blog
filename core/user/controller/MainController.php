<?php

namespace core\user\controller;

class MainController extends BaseUser
{
    protected $userInfo;
    protected $posts;
    protected $comments;

    protected function inputData()
    {
        $this->execBase();

        $this->createMainData();

        print_arr($_SESSION['id']);

        print_arr($this->userInfo);
        print_arr($this->posts);
        print_arr($this->comments);
    }

    protected function createMainData()
    {
        $id = key($this->parameters);

        $this->userInfo = $this->model->get('users', [
            'fields' => ['id', 'username', 'img'],
            'where' => ['id' => $id]
        ]);

        $this->posts = $this->model->get('posts', [
            'fields' => ['*'],
            'where' => ['author_id' => $id]
        ]);

        foreach ($this->posts as $key => $value) {
            $post_id = 'posts/' . $value['id'];

            $this->comments[] = $this->model->get('comments', [
                'fields' => ['*'],
                'where' => ['post_id' => $post_id]
            ]);
        }
    }
}