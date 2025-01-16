<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category Modal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Add Category Modal -->
    <div class="modal fade <?php if (!empty($error)) echo 'show'; ?>" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" style="<?php if (!empty($error)) echo 'display: block;'; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="categorey_add">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php if (!empty($error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Error:</strong> <?php echo htmlspecialchars($error); ?>
                        </div>
                        <?php endif; ?>

                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" name="categoryName" value="<?php echo htmlspecialchars($_POST['categoryName'] ?? ''); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="categorySlug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="categorySlug" name="categorySlug" value="<?php echo htmlspecialchars($_POST['categorySlug'] ?? ''); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="categoryActive" class="form-label">Active</label>
                            <select class="form-select" id="categoryActive" name="categoryActive" required>
                                <option value="Yes" <?php if ($_POST['categoryActive'] ?? '' === 'Yes') echo 'selected'; ?>>Yes</option>
                                <option value="No" <?php if ($_POST['categoryActive'] ?? '' === 'No') echo 'selected'; ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
