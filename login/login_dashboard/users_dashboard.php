<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Users Dashboard</h1>
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addUserModal">Add New User</button>

    <!-- Table to Display Users -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'csit_login_db');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>
                            <button class='btn btn-info btn-sm' data-toggle='modal' data-target='#viewUserModal' data-id='{$row['id']}'>View</button>
                            <button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editUserModal' data-id='{$row['id']}'>Edit</button>
                            <button class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteUserModal' data-id='{$row['id']}'>Delete</button>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No users found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addUserForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <!-- More form fields as needed -->
                    <div class="form-group">
                        <label for="excelFile">Import Users from Excel</label>
                        <input type="file" class="form-control-file" id="excelFile" name="excelFile" accept=".xlsx, .xls">
                    </div>
                    <button type="submit" class="btn btn-primary">Add User(s)</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View User Modal -->
<div class="modal fade" id="viewUserModal" tabindex="-1" role="dialog" aria-labelledby="viewUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewUserModalLabel">View User Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>ID:</strong> <span id="viewUserId"></span></p>
                <p><strong>Name:</strong> <span id="viewUserName"></span></p>
                <p><strong>Email:</strong> <span id="viewUserEmail"></span></p>
                <!-- Add more fields as needed -->
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                    <input type="hidden" id="editUserId" name="id">
                    <div class="form-group">
                        <label for="editName">Name</label>
                        <input type="text" class="form-control" id="editName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" required>
                    </div>
                    <!-- More form fields as needed -->
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete User Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this user?</p>
                <input type="hidden" id="deleteUserId">
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Handle add user form submission
        $('#addUserForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'server_side_script.php', // Adjust this path as needed
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert(response.message);
                    $('#addUserModal').modal('hide');
                    location.reload(); // Refresh the page
                }
            });
        });

        // Handle edit user modal
        $('#editUserModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var userId = button.data('id');

            $.ajax({
                url: 'server_side_script.php', // Adjust this path as needed
                type: 'POST',
                data: { action: 'fetch_user', id: userId },
                dataType: 'json',
                success: function(response) {
                    $('#editUserId').val(response.id);
                    $('#editName').val(response.name);
                    $('#editEmail').val(response.email);
                    // Populate other fields as needed
                }
            });
        });

        // Handle edit user form submission
        $('#editUserForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: 'server_side_script.php', // Adjust this path as needed
                type: 'POST',
                data: { action: 'update_user', data: formData },
                success: function(response) {
                    alert(response.message);
                    $('#editUserModal').modal('hide');
                    location.reload(); // Refresh the page
                }
            });
        });

        // Handle delete user modal
        $('#deleteUserModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var userId = button.data('id');
            $('#deleteUserId').val(userId);
        });

        // Handle delete user confirmation
        $('#confirmDeleteBtn').on('click', function() {
            var userId = $('#deleteUserId').val();

            $.ajax({
                url: 'server_side_script.php', // Adjust this path as needed
                type: 'POST',
                data: { action: 'delete_user', id: userId },
                success: function(response) {
                    alert(response.message);
                    $('#deleteUserModal').modal('hide');
                    location.reload(); // Refresh the page
                }
            });
        });
    });
</script>

</body>
</html>
