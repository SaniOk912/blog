<?php

namespace user\controller;

use base\model\Database;
use base\model\Model;

class MainController extends BaseUser
{
    protected function inputData()
    {
//        $this->execBase();
//        echo'123';
        $db = Model::instance();

        $sql = "123\//'123" . '"' . "\\\\123";

//        $db->execute("INSERT users(username, password) VALUES(" . "'" . addslashes($sql) . "'" . ", '444444')");
//        $db->execute("INSERT INTO 'users' SET 'username'='artem', 'password'='555555'");

//        $users = $db->query('SELECT * FROM users WHERE id = "1"');
//        print_r($users);

//===========================GET=============================
//        $result = $db->get('users', [
//            'fields' => ['password'],
//            'where' => ['id' => '35'],
////            'operand' => ['IN', 'NOT IN'],
////            'condition' => ['AND']
//        ]);
//        foreach ($result as $key => $value){
//            foreach ($value as $name => $item){
//                print_r(json_decode($item));
//            }
//        }
//===========================GET=============================
//===========================ADD=============================
//        $arr = [
//            'username' => ['Sasha', 'Vlad', "$sql"],
//            'password' => $sql
//        ];
//
//        $db->add('users', $arr);
//===========================ADD=============================
//===========================EDIT=============================
//        $db->edit('users', [
//            'fields' => ['username' => 'Vlad', 'password' => '555555'],
//            'files' => ['username' => 'JustSasha'],
//            'where' => ['id' => '10']
//        ]);
//===========================EDIT=============================
//==========================DELETE=============================
        print_arr($db->delete('users', [
            'where' => ['id' => '3']
        ]));
//==========================DELETE=============================
    }
}