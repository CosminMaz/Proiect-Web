<?php
require_once 'app/helpers/jwt_helper.php';

class PropertiesController extends Controller {
    private $propertyModel;

    public function __construct() {
        // Check if user is authenticated
        $token = JwtHelper::getTokenFromHeader();
        
        // If no token in header, check cookie
        if (!$token && isset($_COOKIE['token'])) {
            $token = $_COOKIE['token'];
        }

        if (!$token) {
            // If no token found, redirect to login
            header('Location: ' . URLROOT . '/users/login');
            exit();
        }

        // Validate token
        $decoded = JwtHelper::validateToken($token);
        if (!$decoded) {
            // If token is invalid, redirect to login
            header('Location: ' . URLROOT . '/users/login');
            exit();
        }

        $this->propertyModel = $this->model('Property');
    }

    public function search() {
        // Get all properties
        $properties = $this->propertyModel->getAllProperties();
        
        $data = [
            'title' => 'Caută Proprietăți',
            'properties' => $properties
        ];

        $this->view('properties/SearchView', $data);
    }
} 