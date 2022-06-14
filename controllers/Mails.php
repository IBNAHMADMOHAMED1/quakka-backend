<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST,UPDATE,DELETE,GET');
header('Access-Control-Allow-Headers: *');

class mails extends Controller
{
    public function index()
    {
        $this->loadModel('Mail');
    }

    public function sendMail()
    {
        $this->loadModel('Mail');
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data)) {
            return json_encode(['message' => 'No data']);
        }
        $mail = $this->Mail->sendMail($data);
        if ($mail) {
            echo json_encode([true, $mail]);
        } else {
            echo json_encode([false, 'Invalid credentials']);
        }
    }
}