<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Content-Type:multipart/form-data');
header('Access-Control-Allow-credentials: true');
header('Access-Control-Allow-Methods: POST,UPDATE,DELETE,GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');


class Images extends Controller
{
 

     public function uploadImage($id)
    {
        
        $this->loadModel('Image');
        $data = $_FILES;

        // check if images for product or hall
        
        // access to
        $images = $this->validate_images($data);
        
        if ($this->Image->upload_images($id, $images)) {
            echo json_encode(['success' => true, 'message' => 'Images uploaded']);
        } else {
            echo json_encode(['success' => 'Images not uploaded']);
        }
        
        
        
    }
    public function validate_images($imgas)
    {
        $images = $_FILES;
        $image_names = [];
      
        foreach ($imgas as $key => $image) {
            $fileName = $image['name'];
            $fileTmpName = $image['tmp_name'];
            $fileSize = $image['size'];
            $fileError = $image['error'];
            $fileType = $image['type'];
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('jpg', 'jpeg', 'png');
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 100000000) {
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        
                        $fileDestination = 'C:\xampp\htdocs\Quakka\frontend\dashboardadminquakkad\src\assets\img\product/' . $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        $image_names[] = $fileNameNew;
                    } else {
                        echo json_encode(['error' => 'File size is too big']);
                    }
                } else {
                    echo json_encode(['error' => 'There was an error uploading your file']);
                }
            } else {
                echo json_encode(['error' => 'You cannot upload files of this type']);
            }
        }
        return $image_names;
      
    }
}
    
