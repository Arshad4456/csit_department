<?php include 'db_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <h2>Users Dashboard</h2>
<!-- Add User Button -->
<div class="mt-3">
    <button class="btn btn-success" data-toggle="modal" data-target="#addUserModal">Add User</button>
</div>

    <!-- User Type Buttons -->
    <div class="mt-3">
        <button class="btn btn-info" onclick="fetchUsers('admin')">Admins</button>
        <button class="btn btn-info" onclick="fetchUsers('monitor')">Monitors</button>
        <button class="btn btn-info" onclick="fetchUsers('faculty')">Faculties</button>
        <button class="btn btn-info" onclick="fetchUsers('student')">Students</button>
    </div>

    <!-- Users Table -->
    <div class="mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                <!-- Fetched users will be displayed here -->
            </tbody>
        </table>
    </div>
</div>


<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3 text-center">
          <button type="button" class="btn btn-outline-primary me-2" onclick="showForm('admin')">Admin</button>
          <button type="button" class="btn btn-outline-success me-2" onclick="showForm('monitor')">Monitor</button>
          <button type="button" class="btn btn-outline-warning me-2" onclick="showForm('faculty')">Faculty</button>
          <button type="button" class="btn btn-outline-info" onclick="showForm('student')">Student</button>
        </div>

        <!-- Forms Section -->
        <div id="adminForm" class="user-form" style="display: none;">
          <?php include 'include/add_user_forms/add_admin.php'; ?>
        </div>
        <div id="monitorForm" class="user-form" style="display: none;">
          <?php include 'include/add_user_forms/add_monitor.php'; ?>
        </div>
        <div id="facultyForm" class="user-form" style="display: none;">
          <?php include 'include/add_user_forms/add_faculty.php'; ?>
        </div>
        <div id="studentForm" class="user-form" style="display: none;">
          <?php include 'include/add_user_forms/add_student.php'; ?>
        </div>
      </div>
    </div>
  </div>
</div>




<!-- View User Modal -->
<div class="modal fade" id="viewUserModal" tabindex="-1" role="dialog" aria-labelledby="viewUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">User Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- User info loaded via AJAX -->
      </div>
      <div class="modal-footer">
        <button id="editBtn" class="btn btn-warning">Edit</button>
        <button id="deleteBtn" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>

<?php include 'include/addUsers_modals.php'; ?>
<script>
function fetchUsers(userType) {
    $.ajax({
        url: 'fetch_user.php',
        method: 'POST',
        data: { user_type: userType },
        success: function(response) {
            $('#userTableBody').html(response);
        }
    });
}


  function showForm(userType) {
    // Hide all form divs
    document.querySelectorAll('.user-form').forEach(form => {
      form.style.display = 'none';
    });

    // Show the selected form
    const selectedForm = document.getElementById(userType + 'Form');
    if (selectedForm) {
      selectedForm.style.display = 'block';
    }

//      // Optional: reset form display when modal is closed
//   const modal = document.getElementById('addUserModal');
//   if (modal) {
//     modal.addEventListener('hidden.bs.modal', function () {
//       document.querySelectorAll('.user-form').forEach(form => {
//         form.style.display = 'none';
//       });
//     });
//   }

  }

 


let currentUserId = null;
let currentUserType = null;

function viewUser(userId, userType) {
    currentUserId = userId;
    currentUserType = userType;

    $.ajax({
        url: 'include/view_modals.php',
        method: 'POST',
        data: { user_id: userId, user_type: userType },
        success: function(response) {
            $('#viewUserModal .modal-body').html(response);
            $('#viewUserModal').modal('show');
        }
    });
}

// Edit button click
$(document).on('click', '#editBtn', function () {
    $('#viewUserModal').modal('hide');

    // Wait for modal to hide before opening new one
    $('#viewUserModal').on('hidden.bs.modal', function () {
        editUser(currentUserId, currentUserType);
        $(this).off('hidden.bs.modal'); // Remove listener to prevent stacking
    });
});


// Delete button click
$(document).on('click', '#deleteBtn', function () {
    if (confirm('Are you sure you want to delete this user?')) {
        $.post('backend/delete_user.php', { user_id: currentUserId, user_type: currentUserType }, function(response) {
            alert(response);
            $('#viewUserModal').modal('hide');
            fetchUsers(currentUserType);
        });
    }
});

function editUser(userId, userType) {
    $.ajax({
        url: 'include/edit_modals.php',
        type: 'POST',
        data: { user_id: userId, user_type: userType },
        success: function(response) {
            $('body').append(response);
            $('#editUserModal').modal('show');
        }
    });
}

</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
