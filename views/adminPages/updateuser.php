<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    

<div class="container mt-5">
    <div class="row justify-content-center">
        <div >
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="card-title">Update User</h4>
                </div>
                <div class="card-body">
                    <form action="user-update" method="POST" enctype="multipart/form-data">
                        <!-- Username -->
                        <input type="hidden" id="update-user-id" name="user_id" value="">

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="update-username" name="username" class="form-control" value="" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <!-- <label for="email" class="form-label">Email</label> -->
                            <input type="hidden" id="update-email" name="email" class="form-control" value="" required>
                        </div>

                        <!-- Image Preview -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Profile Image</label>
                            <img id="update-image-preview" src="" alt="Image Preview" class="img-thumbnail mb-2" style="max-width: 200px; display:block;">
                            <input onchange="display_image(this.files[0])" type="file" id="update-image" name="image" class="form-control image-preview-edit" accept="image/*">
                        </div>

                        <!-- Role -->
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select id="update-role" name="role" class="form-select" required>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Upddate User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function display_image(file){
        const preview = document.getElementById("update-image-preview");
        console.log(preview);
        
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = "block";
        } else {
            preview.src = "";
            preview.style.display = "none";
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
