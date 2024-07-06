<?php
require __DIR__.'/../models/User.php'; 
class UserController {
    protected $model;


    public function __construct($db) {
    
        $this->model = new User($db);
    }
    public function jsonResponse($data) {
        header("Content-Type: application/json");
        echo json_encode($data);
        exit;
    }
public function login($name, $phone)
    {
        $data = [
            'name' => $name,
            'phone' => $phone
        ];
        $res = $this->model->login($data);
        if ($res == null) {
            $msg = [
                'msg' => 'this user doesn\'t exist',
            ];
            $this->jsonResponse($msg);
        } else {
            $msg = [
                'msg' => 'welcome to the clinic',
            ];
            $this->jsonResponse($msg);
        }
    }
    public function addUser($name, $phone, $gender)
    {
        $data = [
            'name' => $name,
            'phone' => $phone,
            'gender' => $gender
        ];

        $res = $this->model->addUser($data);
        if ($res) {
            $msg = [
                'msg' => 'user added successfully'
            ];
            $this->jsonResponse($msg);
        } else {
            $msg = [
                'msg' => 'error while adding the user'
            ];
            $this->jsonResponse($msg);
        }
    }
    public function showUser($id) {
        $user = $this->model->getUserById($id);
        if ($user) {
            $this->jsonResponse($user);
        }else {
            $msg = [
                'msg' => "No results found for user with id: $id"
            ];
            $this->jsonResponse($msg);
        }
    }
    public function deleteUser($id) {
        $user = $this->model->getUserById($id);
        if ($user) {
            $res = $this->model->deleteUser($id);
            if ($res) {
                $msg = [
                    'msg' => 'User deleted successfully!'
            ];
            $this->jsonResponse($msg);
            } 
            else {
                $msg = [
                    'msg' => "Failed to delete user."
                ];
                $this->jsonResponse($msg);
            }
        }
        else {
            $msg = [
                'msg' => "User not found!"
            ];
            $this->jsonResponse($msg);
        }
    }
    public function updateUser($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $gender = $_POST['gender'];
            $data = [
                'name' => $name,
                'phone' => $phone,
                'gender' => $gender
            ];
            $res = $this->model->updateUser($id, $data);
            if ($res) {
                $msg = [
                    'msg' => "User updated successfully!"
                ];
                $this->jsonResponse($msg);
            } 
            else {
                $msg = [
                    'msg' => "Failed to update user."
                ];
                $this->jsonResponse($msg);
            }
        }
    }
    public function showReport($id) {
        $report = $this->model->getReportById($id);
        if ($report) {
            $this->jsonResponse($report);
        } else {
            $msg = [
                'msg' => "No results found for user with id: $id"
            ];
            $this->jsonResponse($msg);
        }
    }
}
?>