<?php 
require_once __DIR__ . '/../config/database.php';

class User {
    private $db;

    public function __construct() {
        // Get database connection
        $this->db = getDatabaseConnection();
         error_log("Database connection object: " . print_r($this->db, true));
    }

    public function register($username, $email, $password ,$image="",$role ="") {
        try {
            // SQL to fetch user by email
            $sql = "SELECT * FROM users WHERE email = :email";
            $data = $this->db->prepare($sql);

            // Execute query
            $data->execute(['email' => $email]);

            // Fetch user data
            $user = $data->fetch(PDO::FETCH_ASSOC);
         
            if($user){
                return "The email address is already registered. Please use a different email.";
            }
                 // Hash password
            $hashpassword = password_hash($password, PASSWORD_BCRYPT);

            // Prepare SQL query
            $sql = "INSERT INTO users (username, email, password,image,role) VALUES (:username, :email, :password ,:image,:role)";
            $stmt = $this->db->prepare($sql);
            
            // Execute statement with parameters
             $stmt->execute([
                    'username' => $username,
                    'email' => $email,
                    'password' => $hashpassword,
                    'image' => $image,
                    'role' => $role
                ]);
            return "Registration successful!";
      
           
           
        } catch (PDOException $e) {
            // Log the error and return a meaningful message
            error_log("Error during registration: " . $e->getMessage());
            return "An error occurred during registration. Please try again.";
        }
    }

    public function login($email, $password) {
        try {
            // SQL to fetch user by email
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->db->prepare($sql);

            // Execute query
            $stmt->execute(['email' => $email]);

            // Fetch user data
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$user) {
                error_log("No user found with email: $email");
                return false; // No user found
            }

            // Debug: Show user data fetched from DB
            error_log("User found: " . print_r($user, true));

            // Verify password
            if (password_verify($password, $user['password'])) {
                // Successful login
                error_log("Password verified successfully for email: $email");
                return $user;
            } else {
                // Password mismatch
                error_log("Password mismatch for email: $email");
                return false;
            }

        } catch (PDOException $e) {
            // Log the error and return false
            error_log("Error during login: " . $e->getMessage());
            return false;
        }
    }
    public function getAllUser(){
        try {
            $query = "SELECT *  FROM users ORDER BY created_at ";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error during fetching..: " . $e->getMessage());
            return false;
        }
    }
    public function updateUser($user_id, $username, $image, $role){
        try {
            // Fix SQL query by correctly assigning role value
            $query = "UPDATE users SET username = :username, image = :image , role = :role WHERE id = :id";
            $stmt = $this->db->prepare($query);
            // SQL to fetch user by email
            $sql = "SELECT * FROM users WHERE id  = :id";
            $data = $this->db->prepare($sql);

            // Execute query
            $data->execute(['id' => $user_id]);

            // Fetch user data
            $user = $data->fetch(PDO::FETCH_ASSOC);
            if($image == null){
                // Execute the query with proper parameter bindings
            $stmt->execute([
                'id' => $user_id,
                'username' => $username,
                'image' => $user['image'],
                'role' => $role
            ]);
            
            return "update successful!";
            }else{
                $stmt->execute([
                    'id' => $user_id,
                    'username' => $username,
                    'image' => $image,
                    'role' => $role
                ]);
                
                return "update successful!";
            }

            
        } catch (PDOException $e) {
            error_log("Error during update: " . $e->getMessage());
            return "Error during update: " . $e->getMessage();
        }
    }

    public function deleteUser ($user_id){
        try {
            $query = "DELETE FROM users WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                'id' => $user_id,
            ]);
             // Check if the row was deleted
            if ($stmt->rowCount() > 0) {
                error_log("User with ID $user_id deleted successfully.");
                return true;
            } else {
                error_log("No rows affected. User with ID $user_id may not exist.");
                return false;
            }
        } catch (PDOException $e) {
            error_log("Error during delete: " . $e->getMessage());
            return false;
        }
       
    }
    


    
   
}
