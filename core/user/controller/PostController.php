<?php

namespace core\user\controller;

class PostController extends BaseUser
{
    protected function inputData()
    {
        $this->execBase();

        $this->createTableData('posts');

        $this->createPostsData('id', true);
    }
}