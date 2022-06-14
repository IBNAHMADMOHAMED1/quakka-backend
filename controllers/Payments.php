<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Content-Type:multipart/form-data');
header('Access-Control-Allow-Methods: POST,UPDATE,DELETE,GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


class payments extends Controller
{
    public function index()
    {
        $this->loadModel('Payment');
        
    }

    public function createPayment()
    {
        $this->loadModel('Payment');
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data)) {
            return json_encode(['message' => 'No data']);
        }

        $payment = $this->Payment->createPayment($data);
        if ($payment) {
            echo json_encode([true, $payment]);
        } else {
            echo json_encode([false, 'Invalid credentials']);
        }

    }
}   
