<?php

function print_arr($arr) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}

spl_autoload_register(function ($class_name) {
    $class_name = str_replace('\\', '/', $class_name);
    include $class_name . '.php';
});