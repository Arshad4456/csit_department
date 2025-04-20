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
        <!-- User info will be loaded here -->
      </div>
    </div>
  </div>
</div>

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

function viewUser(userId, userType) {
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
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
