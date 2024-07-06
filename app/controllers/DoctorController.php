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

    public function index()
    {
        $doctors = $this->model->getDoctors();
        $this->jsonResponse($doctors);
    }
    
    public function showDoctorById($id)
    {
        $doctor = $this->model->getDoctorById($id);
        $this->jsonResponse($doctor);
    }

    public function addDoctor()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $specialization_id = $_POST['specialization_id'];
            $data = [
                'name' => $name,
                'phone' => $phone,
                'specialization_id' => $specialization_id,
            ];

            if ($this->model->addDoctor($data)) {
                $message = array('message' => 'Doctor added successfully!');
                $this->jsonResponse($message);
            } else {
                $message = array('error' => 'Failed to add Doctor.');
                $this->jsonResponse($message);
            }
        }
    }

    public function updateDoctor($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
    
            if (isset($data['name']) && isset($data['phone']) && isset($data['specialization_id'])) {
                $data = [
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    'specialization_id' => $data['specialization_id'],
                ];
    
                if ($this->model->updateDoctor($id, $data)) {
                    $message = array('message' => 'Doctor updated successfully!');
                    $this->jsonResponse($message);
                } else {
                    $message = array('error' => 'Failed to update Doctor.');
                    $this->jsonResponse($message);
                }
            } else {
                $message = array('error' => 'Please provide all required fields.');
                $this->jsonResponse($message);
            }
        } else {
            $doctor = $this->model->getDoctorById($id);
            $message = array('error' => 'Worng method');
            $this->jsonResponse($message);
        }
    }

    public function deleteDoctor($id) {
        if ($this->model->deleteDoctor($id)) {
            $message = array('message' => 'Doctor deleted successfully!');
            $this->jsonResponse($message);
        } else {
            $message = array('error' => 'Failed to delete Doctor.');
            $this->jsonResponse($message);
        }
    }

    public function showAppointments($id)
    {
        $rate = $this->model->getDoctorAppointments($id);
        return $this->jsonResponse($rate);
    }

    public function showRate($id)
    {
        $rate = $this->model->getDoctorRate($id);
        return $this->jsonResponse($rate);
    }

}