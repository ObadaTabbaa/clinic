<?php

class Admin
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function login($data)
    {
        $this->db->where('email', $data['email']);
        $this->db->where('password', $data['password']);
        $res = $this->db->getOne('admin');
        return $res;
    }


}