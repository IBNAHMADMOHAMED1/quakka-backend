<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Content-Type:multipart/form-data');
header('Access-Control-Allow-Methods: POST,UPDATE,DELETE,GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


class admins extends Controller
{
    public function index()
    {
        $this->loadModel('Admin');
        
    }
    public function login()
    {
        
        $this->loadModel('Admin');
        
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data))
            return json_encode(['message' => 'No data']);
      
        $admin = $this->Admin->login($data);
        if ($admin) {
            // echo satatus code 200 ok and $admin  
           
            echo json_encode([http_response_code(200), $admin]);
        } else {
           
            echo json_encode([401, 'Invalid credentials']);
        }

    }

    public function profile($id)
    {
        $this->loadModel('Admin');
        $admin = $this->Admin->profile($id);
        if ($admin) {
            
            echo json_encode([http_response_code(200), $admin]);
        } else {
            echo json_encode(['success' => 'Admin not found']);
        }
    }

   

    public function update($id)
    {
        $this->loadModel('Admin');
        
      
        $data = $_POST;

    //    get avatar and cover photo from the function
        $avatar = $this->getAvatar();
        $cover_photo = $this->getCoverPhoto();
        // push avatar and cover photo to the data array
        $data['avatar'] = $avatar;
        $data['cover_photo'] = $cover_photo;
        
        $admin = $this->Admin->update($id, $data);
        
        if ($admin) {
            echo json_encode([true,$admin]);
        } else {
            echo json_encode(['Error' => 'Admin not found']);
        }

    }

    public function getAvatar()
    {
        $fileName  =  $_FILES['avatar']['name'];
        $tempPath  =  $_FILES['avatar']['tmp_name'];
        $fileSize  =  $_FILES['avatar']['size'];


        if (empty($fileName)) {
            $errorMSG = json_encode(array("message" => "please select image", "status" => false));
            echo $errorMSG;
        } else {
            $upload_path = 'C:\xampp\htdocs\Quakka\frontend\dashboardadminquakkad\src\assets\img\Admin/'; // set upload folder path 

            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // get image extension

            // valid image extensions
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');

           
            if (in_array($fileExt, $valid_extensions)) {
                //check file not exist our upload folder path
                if (!file_exists($upload_path . $fileName)) {
                    // check file size '5MB'
                    if ($fileSize < 5000000) {
                        move_uploaded_file($tempPath, $upload_path . $fileName); // move file from system temporary path to our upload folder path 
                    } else {
                        $errorMSG = json_encode(array("message" => "Sorry, your file is too large, please upload 5 MB size", "status" => false));
                        return $errorMSG;
                        die();
                    }
                } else {
                    $errorMSG = json_encode(array("message" => "Sorry, file already exists check upload folder", "status" => false));
                    return $errorMSG;
                    die();
                }
            } else {
                $errorMSG = json_encode(array("message" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed", "status" => false));
                return $errorMSG;
                die();
            }
        }
        
        return $fileName;

    }

    public function getCoverPhoto()
    {
        $fileName  =  $_FILES['cover_photo']['name'];
        $tempPath  =  $_FILES['cover_photo']['tmp_name'];
        $fileSize  =  $_FILES['cover_photo']['size'];

        if (empty($fileName)) {
            $errorMSG = json_encode(array("message" => "please select image", "status" => false));
            echo $errorMSG;
        } else {
            $upload_path = 'C:\xampp\htdocs\Quakka\frontend\dashboardadminquakkad\src\assets\img\Admin/'; // set upload folder path 

            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // get image extension

            // valid image extensions
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');


            if (in_array($fileExt, $valid_extensions)) {
                //check file not exist our upload folder path
                if (!file_exists($upload_path . $fileName)) {
                    // check file size '5MB'
                    if ($fileSize < 5000000) {
                        move_uploaded_file($tempPath, $upload_path . $fileName); // move file from system temporary path to our upload folder path 
                    } else {
                        $errorMSG = json_encode(array("message" => "Sorry, your file is too large, please upload 5 MB size", "status" => false));
                        return $errorMSG;
                        die();
                    }
                } else {
                    $errorMSG = json_encode(array("message" => "Sorry, file already exists check upload folder", "status" => false));
                    return $errorMSG;
                    die();
                }
            } else {
                $errorMSG = json_encode(array("message" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed", "status" => false));
                return $errorMSG;
                die();
            }
        }
       
        return $fileName;

    }
}


