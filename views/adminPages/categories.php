<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php include 'addcategories.php'; ?>
<?php include 'updatecategories.php'; ?>
<?php include 'deleteCategory.php'; ?>
<?php 
require_once __DIR__ . '/../../controllers/CategoriesController.php';
$data = new CategoriesController();
$categories = $data->getAllCategories();
?>
<body>
    <div class="container mt-5">
        <!-- Title and Add Button -->
        <div class="row mb-4">
            <div class="col-12 col-md-6">
                <h1 class="text-center text-md-start">Categories</h1>
            </div>
            <div class="col-12 col-md-6 text-center text-md-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category</button>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Slug</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (is_array($categories) || is_object($categories)): ?>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td><?php echo $category['id']; ?></td>
                                <td><?php echo $category['categorey_name']; ?></td>
                                <td><?php echo $category['slug']; ?></td>
                                <td><?php echo $category['active']; ?></td>
                                <td>
                                    <div style="display: grid; grid-gap: 6px; grid-auto-flow: column;">
                                    <button class="btn btn-warning btn-sm update-category-button" 
                                        data-id="<?php echo $category['id']; ?>"
                                        data-name="<?php echo $category['categorey_name']; ?>"
                                        data-slug="<?php echo $category['slug']; ?>"
                                        data-active="<?php echo $category['active']; ?>"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#updateCategoryModal">
                                         Update
                                    </button>
                                        <button class="btn btn-danger btn-sm update-category-button" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteCategoryModal" 
                                                data-category-id="<?php echo $category['id']; ?>">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5">No categories found.</td></tr>
                        <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const updateCategoryButtons = document.querySelectorAll('.update-category-button');

            updateCategoryButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const categoryId = button.getAttribute('data-id');
                    const categoryName = button.getAttribute('data-name');
                    const categorySlug = button.getAttribute('data-slug');
                    const categoryActive = button.getAttribute('data-active');

                    // Populate the form fields in the modal with the category data
                    document.getElementById('update-category-id').value = categoryId;
                    document.getElementById('update-category-name').value = categoryName;
                    document.getElementById('update-category-slug').value = categorySlug;
                    document.getElementById('update-category-active').value = categoryActive;
                });
            });
        });
</script>
<script>
        // Populate the hidden input with the user ID when the modal is triggered
        var deleteModal = document.getElementById('deleteCategoryModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var userId = button.getAttribute('data-category-id'); // Extract user ID from data-* attribute
            var userIdInput = document.getElementById('update-deleteUserId'); // Hidden input in the form
            userIdInput.value = userId;
            console.log(userId );
            
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
