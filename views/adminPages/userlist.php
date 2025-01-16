<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .user-table img {
      width: 50px;
      height: 50px;
      object-fit: cover;
      border-radius: 50%;
    }

    .action-buttons button {
      margin-right: 5px;
    }

    @media (max-width: 768px) {
      .action-buttons button {
        margin-bottom: 5px;
      }
    }
  </style>
</head>
<?php 
require_once __DIR__ . '/../../controllers/AuthController.php';
$data = new AuthController("default");
$users = $data->getAlluser();
?>
<?php include 'modal.php'; ?>
<?php include 'deleteuser.php'; ?>

<body>
  <div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>User List</h2>

      <button type="button" class="btn btn-primary" data-bs-toggle="modal" name="action"  data-bs-target="#AddModal">Add New User</button>

    </div>
    <div class="table-responsive">
      <table class="table table-striped table-hover user-table">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
            <?php if (is_array($users) || is_object($users)): ?>
              <?php foreach($users as $user): ?>
                <?php $imageSrc = $user['image'] ? "/uploads/" . $user['image'] : "/assets/images/logo.webp";?>   
                <tr>
                  <td><?php echo $user['id'] ?></td>
                  <td><img src="<?php echo $imageSrc; ?>" alt="User Image"></td>
                  <td><?php echo $user['username'] ?></td>
                  <td><?php echo $user['email'] ?></td>
                  <td><?php echo $user['role'] ?></td>
                  <td><?php echo $user['created_at'] ?></td>
                  <td class="action-buttons">
                  <button type="button" class="btn btn-sm btn-warning update-button"
                      data-id="<?php echo $user['id']; ?>"
                      data-username="<?php echo $user['username']; ?>"
                      data-email="<?php echo $user['email']; ?>"
                      data-role="<?php echo $user['role']; ?>"
                      data-image="<?php echo $imageSrc; ?>"  
                      data-bs-toggle="modal" data-bs-target="#updateModal">
                        Update
                    </button>
                    <button type="button" class="btn btn-sm btn-danger .update-button" data-bs-toggle="modal" data-bs-target="#deleteModal" data-user-id=<?php echo $user['id']; ?>>Delete</button>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr><td colspan="7">No users found.</td></tr>
            <?php endif; ?>
        </tbody>

      </table>
    </div>


    <?php 
renderModal(
  'AddModal',
  'Example Modal Title',
 'adduser.php',  // This will dynamically load the modal body content
  // '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>'
);
renderModal(
  'updateModal',
  'User Update',
 'updateuser.php',  // This will dynamically load the modal body content
  // '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>'
);
?>
 <script>
document.addEventListener('DOMContentLoaded', function () {
    const updateButtons = document.querySelectorAll('.update-button');

    updateButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Get the data from the clicked button
            const userId = button.getAttribute('data-id');
            const username = button.getAttribute('data-username');
            const email = button.getAttribute('data-email');
            const role = button.getAttribute('data-role');
            const imageSrc = button.getAttribute('data-image');
            // Set the form values
            document.getElementById('update-user-id').value = userId;
            document.getElementById('update-username').value = username;
            document.getElementById('update-email').value = email;
            document.getElementById('update-role').value = role;
            document.getElementById('update-image-preview').src = imageSrc;
        });
    });
});
</script>
<script>
        // Populate the hidden input with the user ID when the modal is triggered
        var deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var userId = button.getAttribute('data-user-id'); // Extract user ID from data-* attribute
            var userIdInput = document.getElementById('deleteUserId'); // Hidden input in the form
            userIdInput.value = userId;
        });
    </script>


  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
