<?php
require_once __DIR__ . "/../models/categorey.php";

class CategoriesController{
    public function addcategorey(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $categoryName = $_POST['categoryName'] ?? null;
            $categorySlug = $_POST['categorySlug'] ?? null;
            $categoryActive = $_POST['categoryActive'] ?? null;
            
        
            $categoryModel = new Category();
            $success = $categoryModel->addcategories($categoryName, $categorySlug, $categoryActive);
            // Validate data
            if ( $success == "Category added successfully!") {
                header('Location: /admin?page=categories');
                exit();
            } else {
                $error= $success ;
                require_once __DIR__ . '/../views/adminPages/addcategories.php';
                exit();
            }
        } else {
            echo "Invalid request method.";
        }

    }
    public function getAllCategories(){
        $categoreyModel = new Category();
        $categorey =  $categoreyModel->getAllCategories();
        if($categorey){
         return $categorey ;
        }
        else{
         return "something went wrong";
        }
     }

     public function updateCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $categoryId = $_POST['categoryId'] ?? null;
            $categoryName = $_POST['categoryName'] ?? null;
            $categorySlug = $_POST['categorySlug'] ?? null;
            $categoryActive = $_POST['categoryActive'] ?? null;

            if (!$categoryId || !$categoryName || !$categorySlug) {
                $error = "All fields are required!";
                require_once __DIR__ . '/../views/adminPages/updatecategories.php'; // Return the form with error
                exit();
            }
            
            $categoryModel = new Category();
            $result = $categoryModel->updateCategory($categoryId, $categoryName, $categorySlug, $categoryActive);
            
            // Validate update result
            if ($result == "Category updated successfully!") {
                header('Location: /admin?page=categories');
                exit();
            } else {
                $error = $result;
                require_once __DIR__ . '/../views/adminPages/updatecategories.php'; // Return the form with error
                exit();
            }
        } else {
            echo "Invalid request method.";
        }
    }
    public function deleteCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve category ID from the form
            $categoryId = $_POST['categoryId'] ?? null;
       

            if (!$categoryId) {
                $error = "Category ID is required!";
                echo  $categoryId;
                header('Location: /admin?page=categories&error=' . urlencode($error));
                exit();
            }

            $categoryModel = new Category();
            $result = $categoryModel->deleteCategory($categoryId);

            // Validate delete result
            if ($result == "Category deleted successfully!") {
                header('Location: /admin?page=categories');
                exit();
            } else {
                $error = $result;
                header('Location: /admin?page=categories&error=' . urlencode($error));
                exit();
            }
        } else {
            echo "Invalid request method.";
        }
    }
}


