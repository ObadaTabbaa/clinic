<?php

require __DIR__ . '/../models/Admin.php';


class AdminController
{
    private $model;


    public function __construct($db)
    {
        $this->model = new Admin($db);
    }

    public function jsonResponse($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public function login($email, $password)
    {
        $data = [
            'email' => $email,
            'password' => $password
        ];
        $res = $this->model->login($data);
        if ($res == null) {
            $msg = [
                'msg' => 'this email doesn\'t exist',
            ];
            $this->jsonResponse($msg);
        } else {
            $msg = [
                'msg' => 'welcome to the clinic',
            ];
            $this->jsonResponse($msg);
        }
    }





}