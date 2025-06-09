<?php
class PropertiesController extends Controller {
    private $propertyModel;

    public function __construct() {
        if(!isset($_SESSION['user_id'])) {
            header('location: ' . URLROOT . '/users/login');
        }

        $this->propertyModel = $this->model('Property');
    }

    public function index() {
        $properties = $this->propertyModel->getProperties();
        $data = [
            'properties' => $properties
        ];
        
        $this->view('properties/index', $data);
    }

    public function add() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'price' => trim($_POST['price']),
                'area' => trim($_POST['area']),
                'location' => trim($_POST['location']),
                'type' => trim($_POST['type']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'description_err' => '',
                'price_err' => '',
                'area_err' => '',
                'location_err' => '',
                'type_err' => ''
            ];

            // Validate data
            if(empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }
            if(empty($data['description'])) {
                $data['description_err'] = 'Please enter description';
            }
            if(empty($data['price'])) {
                $data['price_err'] = 'Please enter price';
            }
            if(empty($data['area'])) {
                $data['area_err'] = 'Please enter area';
            }
            if(empty($data['location'])) {
                $data['location_err'] = 'Please enter location';
            }
            if(empty($data['type'])) {
                $data['type_err'] = 'Please enter type';
            }

            // Make sure no errors
            if(empty($data['title_err']) && empty($data['description_err']) && empty($data['price_err']) && 
               empty($data['area_err']) && empty($data['location_err']) && empty($data['type_err'])) {
                if($this->propertyModel->addProperty($data)) {
                    header('location: ' . URLROOT . '/properties');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('properties/add', $data);
            }
        } else {
            $data = [
                'title' => '',
                'description' => '',
                'price' => '',
                'area' => '',
                'location' => '',
                'type' => '',
                'title_err' => '',
                'description_err' => '',
                'price_err' => '',
                'area_err' => '',
                'location_err' => '',
                'type_err' => ''
            ];

            $this->view('properties/add', $data);
        }
    }

    public function edit($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'price' => trim($_POST['price']),
                'area' => trim($_POST['area']),
                'location' => trim($_POST['location']),
                'type' => trim($_POST['type']),
                'title_err' => '',
                'description_err' => '',
                'price_err' => '',
                'area_err' => '',
                'location_err' => '',
                'type_err' => ''
            ];

            // Validate data
            if(empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }
            if(empty($data['description'])) {
                $data['description_err'] = 'Please enter description';
            }
            if(empty($data['price'])) {
                $data['price_err'] = 'Please enter price';
            }
            if(empty($data['area'])) {
                $data['area_err'] = 'Please enter area';
            }
            if(empty($data['location'])) {
                $data['location_err'] = 'Please enter location';
            }
            if(empty($data['type'])) {
                $data['type_err'] = 'Please enter type';
            }

            // Make sure no errors
            if(empty($data['title_err']) && empty($data['description_err']) && empty($data['price_err']) && 
               empty($data['area_err']) && empty($data['location_err']) && empty($data['type_err'])) {
                if($this->propertyModel->updateProperty($data)) {
                    header('location: ' . URLROOT . '/properties');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('properties/edit', $data);
            }
        } else {
            $property = $this->propertyModel->getPropertyById($id);

            $data = [
                'id' => $id,
                'title' => $property->title,
                'description' => $property->description,
                'price' => $property->price,
                'area' => $property->area,
                'location' => $property->location,
                'type' => $property->type,
                'title_err' => '',
                'description_err' => '',
                'price_err' => '',
                'area_err' => '',
                'location_err' => '',
                'type_err' => ''
            ];

            $this->view('properties/edit', $data);
        }
    }

    public function delete($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($this->propertyModel->deleteProperty($id)) {
                header('location: ' . URLROOT . '/properties');
            } else {
                die('Something went wrong');
            }
        } else {
            header('location: ' . URLROOT . '/properties');
        }
    }

    public function show($id) {
        $property = $this->propertyModel->getPropertyById($id);
        $data = [
            'property' => $property
        ];

        $this->view('properties/show', $data);
    }
} 