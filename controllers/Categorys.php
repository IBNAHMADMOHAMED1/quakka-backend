<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Content-Type:multipart/form-data');
header('Access-Control-Allow-Methods: POST,UPDATE,DELETE,GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


class categorys  extends Controller
{
    public function index()
    {
        $this->loadModel('Category');
        $categories = $this->Category->getall();
        if ($categories) {
            echo json_encode($categories);
        } else {
            echo json_encode('No categories found');
        }

    }
    public function create()
    {
     
       
        $this->loadModel('Category');
        $data = json_decode(file_get_contents('php://input'), true);
        if ($this->Category->create($data)) {
            echo json_encode(['message' => 'Category created']);
        } else {
            echo json_encode(['message' => 'Category not created']);
        }
    }
    public function update($id)
    {
        $this->loadModel('Category');
        $data = json_decode(file_get_contents('php://input'), true);
        if ($this->Category->update($id, $data)) {
            echo json_encode(['message' => 'Category updated']);
        } else {
            echo json_encode(['message' => 'Category not updated']);
        }
    }
    public function delete($id)
    {
        $this->loadModel('Category');
        if ($this->Category->delete($id)) {
            echo json_encode(['message' => 'Category deleted']);
        } else {
            echo json_encode(['message' => 'Category not deleted']);
        }
    }
    public function show($id)
    {
        $this->loadModel('Category');
        $category = $this->Category->show($id);
        if ($category) {
            echo json_encode(['success' => true, 'category' => $category]);
        } else {
            echo json_encode(['success' => 'Category not found']);
        }
    }
}