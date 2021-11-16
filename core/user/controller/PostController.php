<?php

namespace core\user\controller;

class PostController extends BaseUser
{
    protected function inputData()
    {
        $this->action = 'add';
        $this->execBase();

        $this->createTableData('posts');

        $this->createPostsData('id', true);

        if(isset($_POST) && isset($_SESSION['id'])) {
            $_POST['author_id'] = $_SESSION['id'];
            $_POST['post_id'] = 'posts/' . $_POST['post_id'];
            $_POST['date'] = date('Y-m-d H:i:s');
            $this->checkPost();
        }

    }
}