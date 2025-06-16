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

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Get user ID from token
            $token = JwtHelper::getTokenFromHeader();
            if (!$token && isset($_COOKIE['token'])) {
                $token = $_COOKIE['token'];
            }
            $decoded = JwtHelper::validateToken($token);

            // Init data
            $data = [
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'price' => trim($_POST['price']),
                'suprafata' => trim($_POST['suprafata']),
                'latitude' => trim($_POST['latitude']),
                'longitude' => trim($_POST['longitude']),
                'contact' => trim($_POST['contact']),
                'status' => trim($_POST['status']),
                'facilities' => trim($_POST['facilities']),
                'risks' => trim($_POST['risks']),
                'user_id' => $decoded->user->id,
                'title_err' => '',
                'price_err' => '',
                'suprafata_err' => '',
                'latitude_err' => '',
                'longitude_err' => '',
                'contact_err' => '',
                'status_err' => ''
            ];

            // Validate title
            if (empty($data['title'])) {
                $data['title_err'] = 'Vă rugăm să introduceți titlul';
            }

            // Validate price
            if (empty($data['price'])) {
                $data['price_err'] = 'Vă rugăm să introduceți prețul';
            }

            // Validate suprafata
            if (empty($data['suprafata'])) {
                $data['suprafata_err'] = 'Vă rugăm să introduceți suprafața';
            }

            // Validate latitude
            if (empty($data['latitude'])) {
                $data['latitude_err'] = 'Vă rugăm să introduceți latitudinea';
            }

            // Validate longitude
            if (empty($data['longitude'])) {
                $data['longitude_err'] = 'Vă rugăm să introduceți longitudinea';
            }

            // Validate contact
            if (empty($data['contact'])) {
                $data['contact_err'] = 'Vă rugăm să introduceți datele de contact';
            }

            // Validate status
            if (empty($data['status'])) {
                $data['status_err'] = 'Vă rugăm să selectați statusul';
            }

            // Make sure errors are empty
            if (empty($data['title_err']) && empty($data['price_err']) && 
                empty($data['suprafata_err']) && empty($data['latitude_err']) && 
                empty($data['longitude_err']) && empty($data['contact_err']) && 
                empty($data['status_err'])) {
                
                // Add property
                if ($this->propertyModel->addProperty([
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'suprafata' => $data['suprafata'],
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude'],
                    'contact' => $data['contact'],
                    'status' => $data['status'],
                    'facilities' => $data['facilities'],
                    'risks' => $data['risks'],
                    'user_id' => $data['user_id']
                ])) {
                    // Redirect to properties search
                    header('Location: ' . URLROOT . '/properties/search');
                    exit();
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('properties/AddView', $data);
            }
        } else {
            // Init data
            $data = [
                'title' => '',
                'description' => '',
                'price' => '',
                'suprafata' => '',
                'latitude' => '',
                'longitude' => '',
                'contact' => '',
                'status' => '',
                'facilities' => '',
                'risks' => '',
                'title_err' => '',
                'price_err' => '',
                'suprafata_err' => '',
                'latitude_err' => '',
                'longitude_err' => '',
                'contact_err' => '',
                'status_err' => ''
            ];

            // Load view
            $this->view('properties/AddView', $data);
        }
    }
} 