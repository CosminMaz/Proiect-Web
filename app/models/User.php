<?php
class User {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function login($email, $password) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if($row) {
            $hashed_password = $row->password;
            if(password_verify($password, $hashed_password)) {
                return $row;
            }
        }
        return false;
    }

    public function register($data) {
        // Split the name into nume (last name) and prenume (first name)
        $fullName = explode(' ', $data['name']);
        $prenume = $fullName[0];
        $nume = isset($fullName[1]) ? $fullName[1] : ''; // If no last name provided, use empty string

        $this->db->query('INSERT INTO users (nume, prenume, email, password) VALUES(:nume, :prenume, :email, :password)');
        $this->db->bind(':nume', $nume);
        $this->db->bind(':prenume', $prenume);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function findUserByEmail($email) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
} 