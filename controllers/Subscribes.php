<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Content-Type:multipart/form-data');
header('Access-Control-Allow-Methods: POST,UPDATE,DELETE,GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


class Subscribes extends Controller
{
    public function index()
    {
        $this->loadModel('Subscribe');
        
    }
    public function createSubscribe()
    {
        $this->loadModel('Subscribe');
        
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data)) {
            return json_encode(['message' => 'No data']);
        }

        $subscribe = $this->Subscribe->createSubscribe($data);
        if ($subscribe) {
            echo json_encode([true, $subscribe]);
        } else {
            echo json_encode([false, 'Invalid credentials']);
        }
    }
}   
