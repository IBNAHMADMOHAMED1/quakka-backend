<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST,UPDATE,DELETE,GET');
header('Access-Control-Allow-Headers: *');

class orders extends Controller
{
    public function index()
    {
        $this->loadModel('Order');
    }
    public function createOrder()
    {
        $this->loadModel('Order');
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data)) {
            return json_encode(['message' => 'No data']);
        }
        else {
            $order = $this->Order->createOrder($data);
            if ($order) {
                echo json_encode([true, $order]);  
            } else {
                echo json_encode([false, 'Invalid credentials']);
            }
        }
    }
    public function createListOfProducts()
    {
        $this->loadModel('Order');
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data)) {
            return json_encode(['message' => 'No data']);
        }
        else {
            $listOfProducts = $this->Order->createListOfProducts($data);
            echo json_encode([true, $listOfProducts]);
        }
    }
    public function getall()
    {
        header('Content-Type: application/json');
        $this->loadModel('Order');
        $orders = $this->Order->getall();
        $this->loadModel('Client');
        $clients = $this->Client->getall();
        $this->loadModel('shipping');
        $shippings = $this->shipping->getall();
        $this->loadModel('ListOfProduct');
        $listOfProducts = $this->ListOfProduct->getall();
        // echo json_encode($listOfProducts);
        // die();

        $orders = array_map(function ($order) use ($clients, $shippings, $listOfProducts) {
            $order['client'] = array_filter($clients, function ($client) use ($order) {
                return $client['id'] == $order['client_id'];
            });
            $order['client'] = array_values($order['client'])[0];
            $order['shipping'] = array_filter($shippings, function ($shipping) use ($order) {
                return $shipping['id'] == $order['shipping_id'];
            });
            $order['shipping'] =   array_values($order['shipping'])[0];
            // list of products
            $order['listOfProducts'] = array_filter($listOfProducts, function ($listOfProduct) use ($order) {
                return $order['list_of_products'] == $listOfProduct['id'];
            });
            $order['listOfProducts'] = array_values($order['listOfProducts']);
           
            return $order;
        }, $orders);
        echo json_encode($orders);
    } 

    public function getListOfProducts()
    {
        
        $dataIds = json_decode(file_get_contents('php://input'), true);
        $this->loadModel('ListOfProduct');
        $listOfProducts = $this->ListOfProduct->getListOfProducts($dataIds);
        echo json_encode($listOfProducts);
        

    }


}