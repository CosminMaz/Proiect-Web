<?php
class Property {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getProperties($user_id) {
        $this->db->query('SELECT * FROM properties WHERE user_id = :user_id ORDER BY created_at DESC');
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }

    public function addProperty($data) {
        $this->db->query('INSERT INTO properties (title, description, price, suprafata, latitude, longitude, contact, status, facilities, risks, user_id) VALUES(:title, :description, :price, :suprafata, :latitude, :longitude, :contact, :status, :facilities, :risks, :user_id)');
        
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':suprafata', $data['suprafata']);
        $this->db->bind(':latitude', $data['latitude']);
        $this->db->bind(':longitude', $data['longitude']);
        $this->db->bind(':contact', $data['contact']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':facilities', $data['facilities']);
        $this->db->bind(':risks', $data['risks']);
        $this->db->bind(':user_id', $data['user_id']);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getPropertyById($id, $user_id) {
        $this->db->query('SELECT * FROM properties WHERE id = :id AND user_id = :user_id');
        $this->db->bind(':id', $id);
        $this->db->bind(':user_id', $user_id);
        return $this->db->single();
    }

    public function updateProperty($data, $user_id) {
        $this->db->query('UPDATE properties SET title = :title, description = :description, price = :price, area = :area, location = :location, type = :type WHERE id = :id AND user_id = :user_id');
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':area', $data['area']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':user_id', $user_id);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteProperty($id) {
        $this->db->query('DELETE FROM properties WHERE id = :id');
        $this->db->bind(':id', $id);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllProperties() {
        $this->db->query('SELECT * FROM properties');
        return $this->db->resultSet();
    }
    
    // Returns all properties with latitude and longitude
    public function getAllPropertiesLatLng() {
        $this->db->query('SELECT id, title, latitude, longitude FROM properties');
        return $this->db->resultSet();
    }

}
