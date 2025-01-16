<?php 
require_once __DIR__ . "/../models/user.php";



class AuthController {
    private $type;
    public function __construct($action) {
        // Constructor if needed for initial setup
        $this->type =$action;
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && $this->type === "/user-register") {
            // Collect form data
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? '';
    
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $file_name = $_FILES['image']['name'];
                $tempname = $_FILES['image']['tmp_name'];
                $upload_dir = __DIR__ . '/../public/uploads/';
                $folder = $upload_dir . $file_name;
    
                // Check if the uploads directory exists and is writable
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
    
                // Prevent overwriting existing files
                if (file_exists($folder)) {
                    $file_name = time() . '_' . $file_name; // Add a timestamp to the file name
                    $folder = $upload_dir . $file_name;
                }
    
                // Move the file first
                if (move_uploaded_file($tempname, $folder)) {
                    // Register user after file upload is successful
                    $userModel = new User();
                    $registrationSuccess = $userModel->register($username, $email, $password, $file_name, $role);
    
                    if ($registrationSuccess === "Registration successful!") {
                        header('Location: /admin?page=user');
                        exit();
                    } else {
                      
                    $error = $registrationSuccess;
                    $showModal = true; // Set flag to true to show modal
                    require_once __DIR__ . '/../views/adminPages/modal.php';
                    exit();
                   
                    }
                } else {

                    echo "File upload failed.";

                }
            } else {
                $error = "No file uploaded or file upload error.";
                $showModal = true; // Set flag to true to show modal
                require_once __DIR__ . '/../views/adminPages/modal.php';
                exit();
                echo "No file uploaded or file upload error.";
            }
            
            // If registration without file fails
            $userModel = new User();
            $registrationSuccess = $userModel->register($username, $email, $password);
    
            if ($registrationSuccess === "Registration successful!") {
                header('Location: /login');
                exit();
            } else {
                $error = $registrationSuccess;
                require_once __DIR__ . '/../views/signup.php';
            }
        } else {
            echo "Invalid request method.";
        }
    }
    
    

    public function login(){
        if ($_SERVER["REQUEST_METHOD"] === "POST" &&  $this->type == "/login-form"){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $userModel= new User();
            $user = $userModel->login($email,$password);
                // Redirect if registration is successful
                if ( $user) {
                    $jsonString = json_encode($user);

                    session_start();
                    $_SESSION['user'] =     $jsonString ;
                    header('Location: /admin');
                    exit();
                } else {
                    $error ="Wrong username or password!"; 
                    require_once __DIR__ . '/../views/login.php'; 
                  
                }

        }
    }
    public function logout(){
        session_start();
        session_destroy();
        header('Location: /login');
        exit;

    }
    public function getAllUser(){
       $userModel = new User();
       $users =  $userModel->getAllUser();
       if($users){
        return $users;
       }
       else{
        return "something went wrong";
       }
    }
    public function updateUser(){
        if($_SERVER["REQUEST_METHOD"] === "POST" && $this->type == "/user-update"){
            $user_id = $_POST['user_id'];
            $username = $_POST['username'];
            $role = $_POST['role'];
    
           
            
            if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
                $file_name = $_FILES['image']['name'];
                $tempname = $_FILES['image']['tmp_name'];
                $upload_dir = __DIR__ . '/../public/uploads/';
                $folder = $upload_dir . $file_name;
    
                // Check if the uploads directory exists and is writable
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
    
                // Prevent overwriting existing files
                if (file_exists($folder)) {
                    $file_name = time() . '_' . $file_name; // Add a timestamp to the file name
                    $folder = $upload_dir . $file_name;
                }
    
                // Move the file first
                if (move_uploaded_file($tempname, $folder)) {
                    // Register user after file upload is successful
                    $userModel = new User();
                    $registrationSuccess = $userModel->updateUser($user_id, $username, $file_name, $role);
    
                    if ($registrationSuccess === "update successful!") {
                        header('Location: /admin?page=user');
                        exit();
                    } else {
                        echo $registrationSuccess;
                        exit();
                    }
                } else {
                    echo "File upload failed.";
                    exit();
                }
            } else {
                // If no file is uploaded, update user info without image
                $userModel = new User();
                $registrationSuccess = $userModel->updateUser($user_id, $username, null, $role);
    
                if ($registrationSuccess === "update successful!") {
                    $val = $image;
                    header('Location: /admin?page=user');
                    exit();
                } else {
                    echo $registrationSuccess;
                    exit();
                }
            }
        } else {
            echo "Invalid request method.";
        }
    }

    public function deleteUser(){
        if($_SERVER["REQUEST_METHOD"] === "POST"  && $this->type == "/delete_user"){ 
            $user_id = $_POST['user_id'];
            $userModel =new User();
            $delete_user =$userModel->deleteuser($user_id);
            if($delete_user){
                header('Location: /admin?page=user');
            }
            else{
                die("Error: Unable to delete user. Check logs for details.");
            }
        }
    }
    
}



