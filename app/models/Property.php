<?php
class Property {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getProperties() {
        $this->db->query('SELECT * FROM properties WHERE user_id = :user_id ORDER BY created_at DESC');
        $this->db->bind(':user_id', $_SESSION['user_id']);
        return $this->db->resultSet();
    }

    public function addProperty($data) {
        $this->db->query('INSERT INTO properties (title, description, price, area, location, type, user_id) VALUES(:title, :description, :price, :area, :location, :type, :user_id)');
        
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':area', $data['area']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':user_id', $data['user_id']);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getPropertyById($id) {
        $this->db->query('SELECT * FROM properties WHERE id = :id AND user_id = :user_id');
        $this->db->bind(':id', $id);
        $this->db->bind(':user_id', $_SESSION['user_id']);
        return $this->db->single();
    }

    public function updateProperty($data) {
        $this->db->query('UPDATE properties SET title = :title, description = :description, price = :price, area = :area, location = :location, type = :type WHERE id = :id AND user_id = :user_id');
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':area', $data['area']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':user_id', $_SESSION['user_id']);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteProperty($id) {
        $this->db->query('DELETE FROM properties WHERE id = :id AND user_id = :user_id');
        $this->db->bind(':id', $id);
        $this->db->bind(':user_id', $_SESSION['user_id']);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
} 