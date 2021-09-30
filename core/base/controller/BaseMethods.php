<?php

namespace core\base\controller;

trait BaseMethods
{
    protected function clearStr($str) {

        if(is_array($str)) {
            foreach ($str as $key => $item) $str[$key] = trim(strip_tags($item));
            return $str;
        }else{
            return trim(strip_tags($str));
        }

    }

    protected function clearNum($num) {
        return $num * 1;
    }

    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    protected function clearPostFields(&$arr = [])
    {
        if(!$arr) $arr = &$_POST;

        foreach ($arr as $key => $item) {
            if (is_array($item)) {
                $this->clearPostFields($settings, $item);
            } else {
                if (is_numeric($item)) {
                    $arr[$key] = $this->clearNum($item);
                }
            }
        }
    }

    protected function redirect($http = false, $code = false) {
        if($code) {
            $codes = ['301' => 'HTTP/1.1 301 Move Permanently'];

            if($codes[$code]) header($codes[$code]);
        }

        if($http) $redirect = $http;
        else $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;

        header("Location: $redirect");

        exit;
    }
}