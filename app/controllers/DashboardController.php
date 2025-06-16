<!--
This is the dashboard controller.
It is used to display the dashboard page.
It is used to check if the user is authenticated and if the token is valid.
If the user is not authenticated or the token is invalid, it redirects to the login page.
If the user is authenticated and the token is valid, it displays the dashboard page.
-->
<?php
require_once 'app/helpers/jwt_helper.php';

class DashboardController extends Controller {
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

    public function index() {
        // Get token from header or cookie
        $token = JwtHelper::getTokenFromHeader();
        
        if (!$token && isset($_COOKIE['token'])) {
            $token = $_COOKIE['token'];
        }
        
        // Validate token
        $decoded = JwtHelper::validateToken($token);
        if (!$decoded) {
            header('Location: ' . URLROOT . '/users/login');
            exit();
        }
        
        $data = [
            'title' => 'Dashboard',
            'user' => $decoded->user
        ];

        $this->view('dashboard/DashboardView', $data);
    }
} 