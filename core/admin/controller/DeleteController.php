<?php

namespace core\admin\controller;

use core\base\exceptions\RouteException;

class DeleteController extends BaseAdmin
{
    protected $contentId;

    protected function inputData()
    {
        $this->execBase();

        $userId = $this->clearNum($this->parameters['users']);

        foreach ($this->parameters as $key => $value) {
            if($key !== 'users' && $this->model->tableExists($key)) $this->createTableData($key);
        }

        $this->deleteData();

        $this->redirect('/admin/show/posts');

//        $this->model->add('messages', [
//            'fields' => ['user_id' => $userId, 'message' => 'your post/content was deleted by ADMINISTRATAR', 'is_read' => 'New', 'date' => date('Y-m-d H:i:s')]
//        ]);

    }
}