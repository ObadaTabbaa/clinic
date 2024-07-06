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
$appiontmentController = new AppointmentController($db);
$usercontroller= new UserController($db);

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
    case BASE_PATH . 'get/docappiontments':
        $appiontmentController->getDocAppointments($_POST['id']);
        break;
    case BASE_PATH . 'get/userappointments':
        $appiontmentController->getUserAppointments($_POST['id']);
        break;
    case BASE_PATH . 'get/reportappointment':
        $appiontmentController->getReportAppointment($_POST['id']);
        break;
    case BASE_PATH . 'add/appointment':
        $appiontmentController->addAppointment($_POST['time'], $_POST['doctor_id'], $_POST['user_id'], $_POST['report_id']);
        break;
    case BASE_PATH . 'edit/appointment':
        $appiontmentController->editAppointment($_POST['id'], $_POST['time'], $_POST['doctor_id'], $_POST['user_id'], $_POST['report_id']);
        break;
    case BASE_PATH . 'delete/appointment':
        $appiontmentController->deleteAppointment($_POST['id']);
        break;
    case BASE_PATH . 'search/appointments':
        $appiontmentController->searchAppointments($_GET['start_date'], $_POST['end_date']);
        break;
    // case BASE_PATH . 'log_in':
    //     $usercontroller->logIn($name,$phone);
    // break;
    case BASE_PATH . 'add_user':
        $usercontroller->addUser($name,$phone,$gender);
    break;
    case BASE_PATH . 'show_user':
        if (isset($_GET['id'])) {
            $usercontroller->showUser($_GET['id']);
        } else {
            echo "User ID not provided.";
        }
    break;
    case BASE_PATH . 'delete_user':
        if (isset($_GET['id'])) {
            $usercontroller->deleteUser($_GET['id']);
        } else {
            echo "User ID not provided for deletion.";
        }
    break;
    case BASE_PATH . 'update_user':
        if (isset($_GET['id'])) {
            $usercontroller->updateUser($_GET['id']);
        } else {
            echo "User ID not provided for update.";
        }
    break;
    case BASE_PATH . 'show_report':
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
