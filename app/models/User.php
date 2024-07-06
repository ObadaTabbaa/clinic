<?php
class User {
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function login($data)
    {
        $this->db->where('email', $data['email']);
        $this->db->where('password', $data['password']);
        $res = $this->db->getOne('users');
        return $res;
    }
    public function addUser($data)
    {
        $this->db->where('name', $data['name']);
        $this->db->where('phone', $data['phone']);
        $this->db->where('gender', $data['gender']);
        $res = $this->db->getOne('users');
        if ($res == null) {
            return $this->db->insert('users', $data);
        } else {
            return false;
        }
    }
    public function getUserById($id) {
        return $this->db->where('id', $id)->getOne('users');
    }
    public function deleteUser($id) {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }
    public function updateUser($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }
    public function getReportById($id) {
        $this->db->join("users u", "a.user_id=u.id", "INNER");
        $this->db->join("reports r", "a.report_id=r.id", "INNER"); 
        $this->db->where("u.id", $id);
        return $this->db->get("appointments a", null, [
            "r.id AS report_id",
            "r.status AS report_status",
            "r.comment AS report_comment"
        ]);
    }
}
?>