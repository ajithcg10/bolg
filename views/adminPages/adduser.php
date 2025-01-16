<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div >
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="card-title">Add User</h4>
                </div>
                <div class="card-body">
                    <form  action="user-register" method="POST" enctype="multipart/form-data">
                        <!-- Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email"  id="email" name="email" class="form-control" required>
                            <?php if (!empty($error)): ?>
                                 <p id="error-message" style="color: red;"><?php echo htmlspecialchars($error); ?></p>
                            <?php endif; ?>
                        </div>

                       <!-- Image Preview -->
                       <div class="mb-3">
                            <label for="image" class="form-label">Profile Image</label>
                            <img id="image-preview" src="" alt="Image Preview" class="img-thumbnail mb-2" style="max-width: 200px; display: none;">
                            <input onchange="display_image(this.files[0])" type="file"  id="image" name="image" class="form-control image-preview-edit" accept="image/*">
                        </div>
                        <!-- Role -->
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select id="role" name="role" class="form-select" required>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Add User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function display_image(file){
        const preview = document.getElementById("image-preview");
        console.log(preview,"ajith");
        
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = "block";
        } else {
            preview.src = "";
            preview.style.display = "none";
        }
    }
</script>
<script>
    setTimeout(() => {
      const errormessage = document.getElementById("error-message")
      if(errormessage){
        errormessage.style.display = "none"
       
      }
    }, 1000);
    
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
