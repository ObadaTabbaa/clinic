<?php

spl_autoload_register(function ($class) {
    require_once __DIR__ . '/app/controllers/' . $class . '.php';

});
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/vendor/Mysqlidb/MysqliDb.php';

$config = require 'config/config.php';
$db = new MysqliDb(
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name']
);


$request = $_SERVER['REQUEST_URI'];

define('BASE_PATH', '/clinic/');


$usercontroller= new UserController($db);

switch ($request) {
    case BASE_PATH . 'log_in':
        $usercontroller->logIn($name,$phone);
    break;
    case BASE_PATH . 'add_user':
        $usercontroller->addUser($name,$phone,$gender);
    break;
    case BASE_PATH . 'show_user?id=' . $_GET['id'] :
        if (isset($_GET['id'])) {
            $usercontroller->showUser($_GET['id']);
        } else {
            echo "User ID not provided.";
        }
    break;
    case BASE_PATH . 'delete_user'. $_GET['id']:
        if (isset($_GET['id'])) {
            $usercontroller->deleteUser($_GET['id']);
        } else {
            echo "User ID not provided for deletion.";
        }
    break;
    case BASE_PATH . 'update_user' . $_GET['id']:
        if (isset($_GET['id'])) {
            $usercontroller->updateUser($_GET['id']);
        } else {
            echo "User ID not provided for update.";
        }
    break;
    case BASE_PATH . 'show_report?id=' . $_GET['id']:
        if (isset($_GET['id'])) {
            $usercontroller->showReport($_GET['id']);
        } else {
            echo "Report ID not provided.";
        }
    break;
    default:
        echo "Invalid Request";
    break;
    
}
