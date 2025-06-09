<?php
class DashboardController extends Controller {
    private $propertyModel;

    public function __construct() {
        // Make sure user is logged in
        if(!isset($_SESSION['user_id'])) {
            header('location: ' . URLROOT . '/users/login');
            exit();
        }

        $this->propertyModel = $this->model('Property');
    }

    public function index() {
        try {
            // Get user's properties
            $properties = $this->propertyModel->getProperties();

            $data = [
                'properties' => $properties,
                'user_name' => $_SESSION['user_name']
            ];

            $this->view('dashboard/DashboardView', $data);
        } catch (Exception $e) {
            // If there's an error with the database, still show the dashboard
            $data = [
                'properties' => [],
                'user_name' => $_SESSION['user_name']
            ];

            $this->view('dashboard/DashboardView', $data);
        }
    }
} 