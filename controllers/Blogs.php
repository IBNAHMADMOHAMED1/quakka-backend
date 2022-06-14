<?php 

class blogs extends controller
{
    public function index()
    {
        $this->loadModel('Blog');
        $blogs = $this->Blog->getall();
        if ($blogs) {
            echo json_encode([http_response_code(200), $blogs]);
        } else {
            echo json_encode(['success' => 'Blogs not found']);
        }
    }
    public function create()
    {
        $this->loadModel('Blog');
        $data = json_decode(file_get_contents('php://input'), true);
        if ($this->Blog->create($data)) {
            echo json_encode([true , 'Blog created']);
        } else {
            echo json_encode([false , 'Blog not created']);
        }
    }
}
   