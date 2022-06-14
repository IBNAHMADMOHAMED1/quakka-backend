<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST,UPDATE,DELETE,GET');
header('Access-Control-Allow-Headers: *');


class shippings extends Controller
{
    public function index()
    {
        $this->loadModel('Shipping');
    }
    public function createShipping()
    {
        $this->loadModel('Shipping');
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data)) {
            return json_encode(['message' => 'No data']);
        }

        $this->loadModel('Client');
        $client = $this->Client->getClient($data['client_id']);
        if (!$client) {
            return json_encode(['message' => 'Client not found']);
        }
        $data['email'] = $client['email'];
        $data['phone'] = $client['phoneNumber'];
        $data['mailing_address'] = $client['mailing_address'];
        $data['city'] = $client['city'];
        $data['postal_code'] = 44444;
        $data['country'] = 'N/A';

        $shipping = $this->Shipping->createShippingOtherDetails($data);
        if ($shipping) {
            echo json_encode([true, $shipping]);
        } else {
            echo json_encode([false, 'Invalid credentials']);
        }
    }
    public function createShippingOtherDetails()
    {
        $this->loadModel('Shipping');
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data)) {
            return json_encode(['message' => 'No data']);
        }

        $shipping = $this->Shipping->createShippingOtherDetails($data);
        if ($shipping) {
            echo json_encode([true, $shipping]);
        } else {
            echo json_encode([false, 'Invalid credentials']);
        }
    }
}