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

$appiontmentController = new AppointmentController($db);
switch ($request) {
    // case BASE_PATH:
    //     $doctorController->index();
    //     break;
    case BASE_PATH . 'get/docappiontments?id=' . $_GET['id']:
        $appiontmentController->getDocAppointments($_GET['id']);
        break;
    case BASE_PATH . 'get/userappointments?id=' . $_GET['id']:
        $appiontmentController->getUserAppointments($_GET['id']);
        break;
    case BASE_PATH . 'get/reportappointment?id=' . $_GET['id']:
        $appiontmentController->getReportAppointment($_GET['id']);
        break;
    case BASE_PATH . 'add/appointment':
        $appiontmentController->addAppointment($_POST['time'], $_POST['doctor_id'], $_POST['user_id'], $_POST['report_id']);
        break;
    case BASE_PATH . 'edit/appointment?id=' . $_GET['id']:
        $appiontmentController->editAppointment($_GET['id'], $_POST['time'], $_POST['doctor_id'], $_POST['user_id'], $_POST['report_id']);
        break;
    case BASE_PATH . 'delete/appointment':
        $appiontmentController->deleteAppointment($_POST['id']);
        break;
    case BASE_PATH . 'search/appointments?start_date=' . $_GET['start_date'] . '&end_date=' . $_GET['end_date']:
        echo var_dump($_GET);
        // $appiontmentController->searchAppointments($_GET['start_date'], $_GET['end_date']);
        break;
    default:
        // var_dump($request);
        break;
}
