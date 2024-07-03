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
}