<?php

class commands extends Controller
{
    public function index()
    {
        $this->loadModel('Command');
        $commands = $this->Command->getall();
        if ($commands) {
            echo json_encode([http_response_code(200), $commands]);
        } else {
            echo json_encode(['success' => 'Commands not found']);
        }
    }

    public function getall()
    {
        header('Content-Type: application/json');
        $this->loadModel('Command');
        $commands = $this->Command->getall();
        $this->loadModel('Hall');
        $halls = $this->Hall->getall();
        $this->loadModel('Client');
        $clients = $this->Client->getall();
        $commands = array_map(function ($command) use ($halls, $clients) {
            $command['hall'] = array_filter($halls, function ($hall) use ($command) {
                return $hall['id'] == $command['hall_id'];
            });
            $command['client'] = array_filter($clients, function ($client) use ($command) {
                return $client['id'] == $command['client_id'];
            });
            return $command;
        }, $commands);


        if ($commands) {
            echo json_encode([true, $commands]);
        } else {
            echo json_encode([false, 'Commands not found']);
        }
    }
    public function delete($id)
    {
        $this->loadModel('Command');
        $command = $this->Command->delete($id);
        if ($command) {
            echo json_encode(['success' => true, 'command' => $command]);
        } else {
            echo json_encode(['message' => 'Command not deleted']);
        }
    }
    public function updatestatus()
    {

        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        $hall_id = $data['hall_id'];
        $value = $data['status'];
        $this->loadModel('Command');
        $command = $this->Command->updatestatus($id,$value);
        $this->loadModel('Hall');
        $hall = $this->Hall->updatestatus($hall_id,$value);

        if ($command) {
            echo json_encode([true, $command]);
        } else {
            echo json_encode(['message' => 'Command not updated']);
        }
    }
}