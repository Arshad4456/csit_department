<?php
// Include database connection
include 'db_connection.php';

// Fetch users
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Include custom CSS (optional) -->
    <!-- <link rel="stylesheet" href="styles.css"> -->
</head>

<body>
    <div class="container mt-5">
        <h2>Users Dashboard</h2>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addUserModal">Add Single User</button>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addMultipleUserModal">Add Multiple Users</button>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#testmodal">Add Multiple Users</button>

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
                <?php while ($user = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td>
                            <button class="btn btn-info" data-toggle="modal" data-target="#viewUserModal" data-id="<?php echo $user['id']; ?>">View</button>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#editUserModal" data-id="<?php echo $user['id']; ?>">Edit</button>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteUserModal" data-id="<?php echo $user['id']; ?>">Delete</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Add Single User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add Single User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="add_user.php" method="POST">
                    <div class="modal-body">
                        <!-- Form fields for adding a user -->
                        <div class="form-group">
                            <label for="user_type">User Type</label>
                            <select class="form-control" id="user_type" name="user_type" required>
                                <option value="Admin">Admin</option>
                                <option value="Faculty">Faculty</option>
                                <option value="Student">Student</option>
                                <option value="Monitor">Monitor</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="honorific">Honorific</label>
                            <input type="text" class="form-control" id="honorific" name="honorific" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="father_name">Father Name</label>
                            <input type="text" class="form-control" id="father_name" name="father_name">
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password_hash" name="password_hash" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="togglePassword()">
                                        <i class="fas fa-eye" id="eyeIcon"></i>
                                    </span>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="cnic">CNIC</label>
                                <input type="text" class="form-control" id="cnic" name="cnic">
                            </div>
                            <div class="form-group">
                                <label for="employee_number">Employee Number</label>
                                <input type="text" class="form-control" id="employee_number" name="employee_number">
                            </div>
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <input type="text" class="form-control" id="designation" name="designation">
                            </div>
                            <div class="form-group">
                                <label for="contact_number">Contact Number</label>
                                <input type="text" class="form-control" id="contact_number" name="contact_number">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                            <div class="form-group">
                                <label for="qualification">Qualification</label>
                                <input type="text" class="form-control" id="qualification" name="qualification">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save User</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Multiple Users Modal -->
    <div class="modal fade" id="addMultipleUserModal" tabindex="-1" role="dialog" aria-labelledby="addMultipleUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMultipleUserModalLabel">Add Multiple Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="add_multiple_users_process.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file">Upload CSV</label>
                        <input type="file" class="form-control-file" id="file" name="file" accept=".csv" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
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
                    <div id="userDetails"></div> <!-- Content populated dynamically by JS -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="printView()">Print</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="edit_user.php" method="POST">
                    <div class="modal-body">
                        <!-- Fields populated dynamically using JavaScript -->
                        <input type="hidden" id="edit_user_id" name="id">
                        <div class="form-group">
                            <label for="user_type">User Type</label>
                            <select class="form-control" id="user_type" name="user_type">
                                <option value="Admin">Admin</option>
                                <option value="Faculty">Faculty</option>
                                <option value="Student">Student</option>
                                <option value="Monitor">Monitor</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="honorific">Honorific</label>
                            <input type="text" class="form-control" id="honorific" name="honorific">
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="father_name">Father Name</label>
                            <input type="text" class="form-control" id="father_name" name="father_name">
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password_hash">Password</label>
                            <input type="password" class="form-control" id="password_hash" name="password_hash">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="cnic">CNIC</label>
                            <input type="text" class="form-control" id="cnic" name="cnic">
                        </div>
                        <div class="form-group">
                            <label for="employee_number">Employee Number</label>
                            <input type="text" class="form-control" id="employee_number" name="employee_number">
                        </div>
                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" id="designation" name="designation">
                        </div>
                        <div class="form-group">
                            <label for="contact_number">Contact Number</label>
                            <input type="text" class="form-control" id="contact_number" name="contact_number">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                        <div class="form-group">
                            <label for="qualification">Qualification</label>
                            <input type="text" class="form-control" id="qualification" name="qualification">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
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
                </div>
                <div class="modal-footer">
                    <form action="delete_user.php" method="POST">
                        <input type="hidden" id="delete_user_id" name="id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

  <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script>


    // Function to fetch and populate user data into the Edit Modal
    $('#editUserModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var userId = button.data('id');

        $.ajax({
            url: 'fetch_user.php',
            method: 'POST',
            data: { id: userId },
            dataType: 'json',
            success: function(data) {
                $('#edit_user_id').val(data.id);
                $('#user_type').val(data.user_type);
                $('#honorific').val(data.honorific);
                $('#name').val(data.name);
                $('#father_name').val(data.father_name);
                $('#gender').val(data.gender);
                $('#password_hash').val(data.password_hash);
                $('#email').val(data.email);
                $('#cnic').val(data.cnic);
                $('#employee_number').val(data.employee_number);
                $('#designation').val(data.designation);
                $('#contact_number').val(data.contact_number);
                $('#address').val(data.address);
                $('#qualification').val(data.qualification);
            }
        });
    });

    // Function to confirm deletion in the Delete Modal
    $('#deleteUserModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var userId = button.data('id');
        $('#delete_user_id').val(userId);
    });

    // Function to populate the View Modal
    $('#viewUserModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var userId = button.data('id');

        $.ajax({
            url: 'fetch_user.php',
            method: 'POST',
            data: { id: userId },
            dataType: 'json',
            success: function(data) {
                var userDetails = `<p><strong>User Type:</strong> ${data.user_type}</p>
                                   <p><strong>Name:</strong> ${data.name}</p>
                                   <p><strong>Email:</strong> ${data.email}</p>`;
                $('#userDetails').html(userDetails);
            }
        });
    });




            //eyeIcon
        function togglePassword() {
    var passwordField = document.getElementById("password_hash");
    var eyeIcon = document.getElementById("eyeIcon");
    if (passwordField.type === "password") {
        passwordField.type = "text";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    } else {
        passwordField.type = "password";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    }
}
    </script>
</body>

</html>