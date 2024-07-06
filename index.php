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


$controller = new DoctorController($db);

switch ($request) {
    case BASE_PATH:
        $controller->index();
        break;
    case BASE_PATH . 'rate?id=' . $_GET['id']:
        $controller->showRate($_GET['id']);
        break;
    case BASE_PATH . 'appointments?id=' . $_GET['id']:
        $controller->showAppointments($_GET['id']);
        break;
    case BASE_PATH . 'showDoctor?id=' . $_GET['id']:
        $controller->showDoctorById($_GET['id']);
        break;
    case BASE_PATH . 'addDoctor':
        $controller->addDoctor();
        break;
    case BASE_PATH . 'updateDoctor?id=' . $_GET['id']:
        $controller->updateDoctor($_GET['id']);
        break;
    case BASE_PATH . 'deleteDoctor?id=' . $_GET['id']:
        $controller->deleteDoctor($_GET['id']);
        break;
    default:
        break;
}
