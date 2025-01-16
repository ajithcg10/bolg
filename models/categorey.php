<?php 
require_once __DIR__ . '/../config/database.php';

class Category {
    private $db;
    
    public function __construct(){
        $this->db = getDatabaseConnection();
        error_log("Database connection object: " . print_r($this->db, true));
    }

    public function addcategories($categorey_name, $slug, $active) {
        $query = "SELECT * FROM categories WHERE categorey_name = :categorey_name OR slug = :slug";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['categorey_name' => $categorey_name, 'slug' => $slug]);
        $found = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($found) {
            return "Category or slug already exists!";
        } else {
            $insertQuery = "INSERT INTO categories (categorey_name, slug, active) VALUES (:categorey_name, :slug, :active)";
            $insertStmt = $this->db->prepare($insertQuery);
    
            // Ensure $active is a boolean value
            $register = $insertStmt->execute([
                'categorey_name' => $categorey_name,
                'slug' => $slug,
                'active' => $active,
            ]);
    
            if ($register) {
                return "Category added successfully!";
            } else {
                throw new Exception("Failed to add category.");
            }
        }
    }
      // Fetch all categories
      public function getAllCategories() {
        $query = "SELECT * FROM categories";
        $stmt = $this->db->query($query); // Use query() for direct execution without binding parameters
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows as an associative array
    }

    public function updateCategory($category_id, $category_name, $slug, $active) {
        // Check if the category exists
        $query = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $category_id]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$category) {
            return "Category not found!";
        }
    
        // Check if the category name or slug already exists (excluding the current category)
        $query = "SELECT * FROM categories WHERE (categorey_name = :categorey_name OR slug = :slug) AND id != :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            'categorey_name' => $category_name,
            'slug' => $slug,
            'id' => $category_id
        ]);
        $found = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($found) {
            return "Category name or slug already exists!";
        }
    
        // Update the category
        $updateQuery = "UPDATE categories SET categorey_name = :categorey_name, slug = :slug, active = :active WHERE id = :id";
        $updateStmt = $this->db->prepare($updateQuery);
        
        $update = $updateStmt->execute([
            'categorey_name' => $category_name,
            'slug' => $slug,
            'active' => $active,
            'id' => $category_id,
        ]);
    
        if ($update) {
            return "Category updated successfully!";
        } else {
            throw new Exception("Failed to update category.");
        }
    }
    public function deleteCategory($categoryId) {
        try {
            $stmt = $this->db->prepare("DELETE FROM categories WHERE id = :id");
            $stmt->bindParam(':id', $categoryId, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "Category deleted successfully!";
            } else {
                return "Failed to delete category.";
            }
        } catch (PDOException $e) {
            return "Database error: " . $e->getMessage();
        }
    }  
}
