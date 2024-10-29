<?php
include 'db_connection.php'; // Include your database connection
?>

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

    <!-- Add User and Add Multiple Users Buttons -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
        Add Single User
    </button>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addMultipleUsersModal">
        Add Multiple Users via CSV
    </button>

    <!-- User Type Buttons -->
    <div class="mt-3">
        <button class="btn btn-info" onclick="fetchUsers('admin')">Admins</button>
        <button class="btn btn-info" onclick="fetchUsers('monitor')">Monitors</button>
        <button class="btn btn-info" onclick="fetchUsers('faculty')">Faculties</button>
        <button class="btn btn-info" onclick="fetchUsers('student')">Students</button>
    </div>

    <!-- Users Table -->
    <div class="mt-4">
        <table class="table table-bordered" id="usersTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                <!-- Data will be populated here -->
            </tbody>
        </table>
    </div>
</div>

<!-- Include modals for Add User, Edit User, View User, Delete User -->
<?php include 'include/addUsers_modals.php'; ?>
<?php include 'include/view_modals.php'; ?>
<?php include 'include/edit_modals.php'; ?>
<?php include 'include/delete_modals.php'; ?>

<script>


function viewUser(userId, userType) {
    $.ajax({
        url: ' include/view_modals.php', // This should handle fetching data for view modal
        method: 'POST',
        data: { user_id: userId, user_type: userType },
        success: function(response) {
            $('#viewUserModal .modal-body').html(response); // Populate the modal with the user details
            $('#viewUserModal').modal('show');
        }
    });
}

function editUser(userId, userType) {
    $.ajax({
        url: 'include/edit_modals.php', // This should handle fetching data for edit modal
        method: 'POST',
        data: { user_id: userId, user_type: userType },
        success: function(response) {
            $('#editUserModal .modal-body').html(response); // Populate the modal with the user details
            $('#editUserModal').modal('show');
        }
    });
}

function deleteUser(userId, userType) {
    $.ajax({
        url: 'include/delete_modals.php', // This should handle fetching data for delete modal
        method: 'POST',
        data: { user_id: userId, user_type: userType },
        success: function(response) {
            $('#deleteUserModal .modal-body').html(response); // Populate the modal with the user details
            $('#deleteUserModal').modal('show');
        }
    });
}




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
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
