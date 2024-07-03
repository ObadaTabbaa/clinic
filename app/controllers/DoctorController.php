<?php
require __DIR__ . '/../models/Doctor.php';

class DoctorController
{
    private $model;


    public function __construct($db)
    {
        $this->model = new Doctor($db);
    }

    public function jsonResponse($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    function index()
    {
        $doctors = $this->model->getDoctors();
        $this->jsonResponse($doctors);
    }
}