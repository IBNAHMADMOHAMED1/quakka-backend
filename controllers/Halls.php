<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Content-Type:multipart/form-data');
header('Access-Control-Allow-Methods: POST,UPDATE,DELETE,GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

class Halls extends Controller
{

    public function index()
    {
        $this->loadModel('Hall');
        $halls = $this->Hall->getall();
        if ($halls) {
            echo json_encode([http_response_code(200), $halls]);
        } else {
            echo json_encode(['success' => 'Halls not found']);
        }
    }

    public function getall()
    {
        header('Content-Type: application/json');
        $this->loadModel('Hall');
        $halls = $this->Hall->getall();
        $this->loadModel('Imagehall');
        $images = $this->Imagehall->getall();
        $halls = array_map(function ($hall) use ($images) {
            $hall['images'] = array_filter($images, function ($image) use ($hall) {
                return $image['idHall'] == $hall['id'];
            });
            return $hall;
        }, $halls);
        echo json_encode([http_response_code(200), $halls]);
    }

    public function create()
    {
        $this->loadModel('Hall');
        $data = json_decode(file_get_contents('php://input'), true);
        $hall = $this->Hall->create($data);

        if ($hall) {
            echo json_encode(['success' => true, 'hall' => $hall]);
        } else {
            echo json_encode(['message' => 'Hall not created']);
        }
    }

    public function UploadImage()
    {
        $this->loadModel('Image');
    }

    public function delete($id)
    {
        $this->loadModel('Imagehall');
        $images = $this->Imagehall->_delete_images($id);
        $this->loadModel('Hall');
        $hall = $this->Hall->delete($id);

        if ($hall) {
            echo json_encode(['success' => true, 'hall' => $hall]);
        } else {
            echo json_encode(['message' => 'Hall not deleted']);
        }
    }
    public function getone($id)
    {
        $this->loadModel('Hall');
        $hall = $this->Hall->_oneHall($id);
        $this->loadModel('Imagehall');
        $images = $this->Imagehall->_getImages($id);


        if ($images) {
            $hall['images'] = $images;
        }
        if ($hall) {
            echo json_encode([http_response_code(200), $hall]);
        } else {
            echo json_encode(['success' => 'Hall not found']);
        }
    }
    public function update($id) {
        $this->loadModel('Hall');
        $data = json_decode(file_get_contents('php://input'), true);
        if ($this->Hall->update($id, $data)) {
            echo json_encode(['success' => true, 'hall' => $this->Hall->_oneHall($id)]);
        } else {
            echo json_encode(['message' => 'Hall not updated']);
        }
    }
    
}

