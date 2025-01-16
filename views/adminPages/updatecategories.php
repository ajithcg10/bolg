<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update Category Modal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="modal fade <?php if (!empty($error)) echo 'show'; ?>" id="updateCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" style="<?php if (!empty($error)) echo 'display: block;'; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
            <form method="POST" action="update-category">
              <input type="hidden" id="update-category-id" name="categoryId" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateCategoryModalLabel">Update Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if (!empty($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <strong>Error:</strong> <?php echo htmlspecialchars($error); ?>
                    </div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="update-category-name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="update-category-name" name="categoryName" value="" required>
                    </div>
                    <div class="mb-3">
                        <label for="update-category-slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="update-category-slug" name="categorySlug" value="" required>
                    </div>
                    <div class="mb-3">
                        <label for="update-category-active" class="form-label">Active</label>
                        <select class="form-select" id="update-category-active" name="categoryActive" required>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
