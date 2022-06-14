<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST,UPDATE,DELETE,GET');
header('Access-Control-Allow-Headers: *');

class users extends Controller
{
    public function index()
    {
        $this->loadModel('Admin');
        
    }
    public function googlelogin()
    {
        // google login
        $this->loadModel('User');
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data))
            return json_encode(['message' => 'No data']);
        $user = $this->User->googlelogin($data);
        if ($user) {
            echo json_encode([true, $user]);
        } else {
           
            echo json_encode([false, 'Invalid credentials']);
        }

    }
    public function login()
    {
        header('Access-Control-Allow-Headers: *');

        $this->loadModel('User');
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data))
            return json_encode(['message' => 'No data']);
        $user = $this->User->login($data);
        if ($user) {
            echo json_encode([true, $user]);
        } else {

            echo json_encode([false, 'Invalid credentials']);
        }

    }
    public function create()
    {
        $this->loadModel('User');
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data))
            return json_encode(['message' => 'No data']);
            // hash password
        // $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $user = $this->User->create($data);
        if ($user) {
            echo json_encode([true, $user]);
        } else {

            echo json_encode([false, 'Invalid credentials']);
        }

    }

}