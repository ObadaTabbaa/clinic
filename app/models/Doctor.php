<?php

class Doctor
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getDoctors()
    {
        return $this->db->get('doctors');
    }

    public function getDoctorById($id)
    {
        return $this->db->where('id',$id)->getOne('doctors');
    }

    public function addDoctor($data)
    {
        $this->db->where('name', $data['name']);
        $this->db->where('phone', $data['phone']);
        $this->db->where('specialization_id', $data['specialization_id']);
        $res = $this->db->getOne('doctors');
        if ($res == null) {
            return $this->db->insert('doctors', $data);
        } else {
            return false;
        }
    }

    public function updateDoctor($id,$data)
    {
        $doctor = $this->getDoctorById($id);
        if($doctor) {
            return $this->db->where('id',$id)->update('doctors',$data);
        }else{
            return false;
        }
    }

    public function deleteDoctor($id) {
        $doctor = $this->getDoctorById($id);
        if ($doctor) {
            return $this->db->where('id', $id)->delete('doctors');
        } else {
            return 0;
        }
    }

    public function getDoctorAppointments($id)
    {
        return $this->db->where('doctor_id',$id)->get('appointments');
    }

    public function getDoctorRate($id)
    {
        $rates = $this->db->where('doctor_id', $id)->get('rates');
        $total = 0;
        $count = 0;
        foreach ($rates as $rate) {
            $total += $rate['rate'];
            $count++;
        }
        if ($count > 0) {
            $averageRate = number_format($total / $count, 2);
        } else {
            $averageRate = 'No rates found';
        }
        return $averageRate;
    }
}
