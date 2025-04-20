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
    <div class="mb-3">
        <button class="btn btn-info" onclick="fetchUsers('admin')">Admins</button>
        <button class="btn btn-info" onclick="fetchUsers('monitor')">Monitors</button>
        <button class="btn btn-info" onclick="fetchUsers('faculty')">Faculties</button>
        <button class="btn btn-info" onclick="fetchUsers('student')">Students</button>
        <button class="btn btn-success float-right" data-toggle="modal" data-target="#addUserModal">Add Single User</button>
    </div>

    <!-- Users Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="userTableBody">
            <!-- Fetched users will appear here -->
        </tbody>
    </table>
</div>

<!-- View User Modal -->
<div class="modal fade" id="viewUserModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">User Details</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="userDetailsContent">
        <!-- Details via AJAX -->
      </div>
    </div>
  </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <form id="addUserForm" action="backend/add_user.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Add Single User</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">

          <!-- User Type -->
          <div class="form-group">
            <label for="user_type">User Type</label>
            <select name="user_type" id="user_type" class="form-control" required onchange="loadUserFormFields(this.value)">
              <option value="">Select User Type</option>
              <option value="admin">Admin</option>
              <option value="monitor">Monitor</option>
              <option value="faculty">Faculty</option>
              <option value="student">Student</option>
            </select>
          </div>

          <!-- Dynamic Fields -->
          <div id="dynamicUserFields"></div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Add User</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function fetchUsers(userType) {
    $.post('fetch_user.php', { user_type: userType }, function(response) {
        $('#userTableBody').html(response);
    });
}

function viewUser(id, type) {
    $.post('include/view_modals.php', { user_id: id, user_type: type }, function(response) {
        $('#userDetailsContent').html(response);
        $('#viewUserModal').modal('show');
    });
}

function loadUserFormFields(userType) {
    if (userType) {
        $.post('add_user_forms/add_' + userType + '.php', function(data) {
            $('#dynamicUserFields').html(data);
        });
    } else {
        $('#dynamicUserFields').html('');
    }
}
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
