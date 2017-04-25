<?php
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/4/25
 * Time: 14:41
 */
function classLoader($class)
{
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $file = __DIR__ . '/src/' . $path . '.php';
    var_dump($class);
    if (file_exists($file)) {
        require_once $file;
    }
}
spl_autoload_register('classLoader');