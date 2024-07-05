<?php

class Appointment
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getDocAppointments($id)
    {

        $results = $this->db->rawQuery("SELECT appointments.id as id, users.id as user_id, users.name as user_name, users.phone as user_phone, users.gender as user_gender, doctors.id as doctor_id, doctors.name as doctor_name, doctors.phone as doctor_phone, specializations.id as specialization_id, specializations.name as specialization_name, reports.id as report_id, reports.status as report_status, reports.comment as report_comment from specializations JOIN doctors on specializations.id = doctors.specialization_id JOIN appointments on appointments.doctor_id = doctors.id JOIN users on users.id = appointments.user_id JOIN reports on reports.id = appointments.report_id WHERE doctors.id = '$id';");
        return $results;
    }

    public function getUserAppointments($id)
    {
        $results = $this->db->rawQuery("SELECT appointments.id as id, users.id as user_id, users.name as user_name, users.phone as user_phone, users.gender as user_gender, doctors.id as doctor_id, doctors.name as doctor_name, doctors.phone as doctor_phone, specializations.id as specialization_id, specializations.name as specialization_name, reports.id as report_id, reports.status as report_status, reports.comment as report_comment from specializations JOIN doctors on specializations.id = doctors.specialization_id JOIN appointments on appointments.doctor_id = doctors.id JOIN users on users.id = appointments.user_id JOIN reports on reports.id = appointments.report_id WHERE users.id = '$id';");
        return $results;
    }

    public function getReportAppointment($id)
    {
        $this->db->where('id', $id);
        $res = $this->db->get('reports');
        return $res;
    }

    public function addAppointment($data)
    {
        $this->db->where('time', $data['time']);
        $this->db->where('doctor_id', $data['doctor_id']);
        $this->db->where('user_id', $data['user_id']);
        $this->db->where('report_id', $data['report_id']);

        $res = $this->db->getOne('appointments');
        if ($res == null) {
            $res = $this->db->insert('appointments', $data);
            return $res;
        } else {
            return false;
        }
    }

    public function editAppointment($id, $data)
    {
        $this->db->where('id', $id);

        $res = $this->db->getOne('appointments');
        if ($res != null) {
            $this->db->where('id', $id);
            $res = $this->db->update('appointments', $data);
            return $res;
        } else {
            return false;
        }

    }

    public function deleteAppointment($id)
    {
        $this->db->where('id', $id);

        $res = $this->db->getOne('appointments');
        if ($res != null) {
            $this->db->where('id', $id);
            $res = $this->db->delete('appointments');
            return $res;
        } else {
            return false;
        }
    }

    public function searchAppointments($start_date, $end_date)
    {
        $this->db->where('time', array($start_date, $end_date), 'BETWEEN');
        $res = $this->db->get('appointments');
        return $res;
    }

}