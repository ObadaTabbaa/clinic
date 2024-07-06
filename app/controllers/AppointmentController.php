<?php

require __DIR__ . '/../models/Appointment.php';


class AppointmentController
{
    private $model;


    public function __construct($db)
    {
        $this->model = new Appointment($db);
    }

    public function jsonResponse($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public function getDocAppointments($id)
    {
        $res = $this->model->getDocAppointments($id);
        if ($res != null) {
            $i = 0;
            $data = [];
            while ($i < count($res)) {
                $row = $res[$i];


                $data[$row['id']]['doctor'] = [
                    'id' => $row['doctor_id'],
                    'name' => $row['doctor_name'],
                    'phone' => $row['doctor_phone'],
                    'specialization' => [
                        'id' => $row['specialization_id'],
                        'name' => $row['specialization_name']
                    ]
                ];

                $data[$row['id']]['user'] = [
                    'id' => $row['user_id'],
                    'name' => $row['user_name'],
                    'phone' => $row['user_phone'],
                    'gender' => $row['user_gender']
                ];

                $data[$row['id']]['report'] = [
                    'id' => $row['report_id'],
                    'status' => $row['report_status'],
                    'comment' => $row['report_comment']
                ];

                $i++;
            }

            $msg = [
                'msg' => 'success',
                'data' => $data
            ];
            $this->jsonResponse($msg);
        } else {
            $msg = [
                'msg' => 'faild',
                'data' => []
            ];
            $this->jsonResponse($msg);
        }
    }


    public function getUserAppointments($id)
    {
        $res = $this->model->getUserAppointments($id);
        if ($res != null) {
            $i = 0;
            $data = [];
            while ($i < count($res)) {
                $row = $res[$i];


                $data[$row['id']]['doctor'] = [
                    'id' => $row['doctor_id'],
                    'name' => $row['doctor_name'],
                    'phone' => $row['doctor_phone'],
                    'specialization' => [
                        'id' => $row['specialization_id'],
                        'name' => $row['specialization_name']
                    ]
                ];

                $data[$row['id']]['user'] = [
                    'id' => $row['user_id'],
                    'name' => $row['user_name'],
                    'phone' => $row['user_phone'],
                    'gender' => $row['user_gender']
                ];

                $data[$row['id']]['report'] = [
                    'id' => $row['report_id'],
                    'status' => $row['report_status'],
                    'comment' => $row['report_comment']
                ];

                $i++;
            }

            $msg = [
                'msg' => 'success',
                'data' => $data
            ];
            $this->jsonResponse($msg);
        } else {
            $msg = [
                'msg' => 'faild',
                'data' => []
            ];
            $this->jsonResponse($msg);
        }
    }

    public function getReportAppointment($id)
    {
        $res = $this->model->getReportAppointment($id);
        if ($res != null) {
            $msg = [
                'msg' => 'success',
                'data' => $res
            ];
            $this->jsonResponse($msg);
        } else {
            $msg = [
                'msg' => 'faild',
                'data' => []
            ];
            $this->jsonResponse($msg);
        }
    }

    public function addAppointment($time, $doctor_id, $user_id, $report_id)
    {
        $data = [
            'time' => $time,
            'doctor_id' => $doctor_id,
            'user_id' => $user_id,
            'report_id' => $report_id
        ];
        $res = $this->model->addAppointment($data);
        if ($res) {
            $msg = [
                'msg' => 'success',
            ];
            $this->jsonResponse($msg);
        } else {
            $msg = [
                'msg' => 'faild',
            ];
            $this->jsonResponse($msg);
        }
    }

    public function editAppointment($id, $time, $doctor_id, $user_id, $report_id)
    {
        $data = [
            'time' => $time,
            'doctor_id' => $doctor_id,
            'user_id' => $user_id,
            'report_id' => $report_id
        ];
        $res = $this->model->editAppointment($id, $data);
        if ($res) {
            $msg = [
                'msg' => 'success',
            ];
            $this->jsonResponse($msg);
        } else {
            $msg = [
                'msg' => 'faild',
            ];
            $this->jsonResponse($msg);
        }
    }

    public function deleteAppointment($id)
    {
        $res = $this->model->deleteAppointment($id);
        if ($res) {
            $msg = [
                'msg' => 'success',
            ];
            $this->jsonResponse($msg);
        } else {
            $msg = [
                'msg' => 'faild',
            ];
            $this->jsonResponse($msg);
        }
    }

    public function searchAppointments($start_date, $end_date)
    {
        $res = $this->model->searchAppointments($start_date, $end_date);
        if ($res != null) {
            $msg = [
                'msg' => 'success',
                'data' => $res
            ];
            $this->jsonResponse($msg);
        } else {
            $msg = [
                'msg' => 'faild',
                'data' => []
            ];
            $this->jsonResponse($msg);
        }
    }

}