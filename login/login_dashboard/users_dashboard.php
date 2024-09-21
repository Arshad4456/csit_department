<?php
// Database connection
$mysqli = new mysqli("localhost", "root", "", "csit_login_db");

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Check for success message
if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
    // Unset the message after displaying it
    unset($_SESSION['success_message']);
}


// Fetch users from the database
$sql = "SELECT * FROM users";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    @media print {
        .modal-footer .btn-primary {
            display: none !important; /* Hide print button when printing */
        }
    
    }
        .input-group-append {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Users Dashboard</h2>

        <!-- Add Single User and Add Multiple Users via CSV buttons -->
        <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">Add Single User</button>
        <button class="btn btn-secondary" data-toggle="modal" data-target="#addMultipleUsersModal">Add Multiple Users via CSV</button>

        <!-- User table -->
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Employee Number</th>
                    <th>User Type</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Designation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['employee_number']) ?></td>
                        <td><?= htmlspecialchars($row['user_type']) ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['gender']) ?></td>
                        <td><?= htmlspecialchars($row['designation']) ?></td>
                        <td>
                            <button class="btn btn-info" data-toggle="modal" data-target="#viewUserModal<?= $row['id'] ?>">View</button>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#editUserModal<?= $row['id'] ?>">Edit</button>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteUserModal<?= $row['id'] ?>">Delete</button>
                        </td>
                    </tr>


                    <!-- Add User Modal -->
                    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="add_user.php" method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add User</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="user_type">User Type</label>
                                            <select name="user_type" class="form-control" required>
                                                <option value="admin">Admin</option>
                                                <option value="monitor">Monitor</option>
                                                <option value="faculty">Faculty Member</option>
                                                <option value="student">Student</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="honorific">Honorific</label>
                                            <select name="honorific" class="form-control" required>
                                                <option value="Mr.">Mr.</option>
                                                <option value="Ms.">Ms.</option>
                                                <option value="Mrs.">Mrs.</option>
                                                <option value="Dr.">Dr.</option>
                                                <option value="Prof.">Prof.</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="father_name">Father's Name</label>
                                            <input type="text" name="father_name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <select name="gender" class="form-control" required>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="cnic">CNIC</label>
                                            <input type="text" name="cnic" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="employee_number">Employee Number</label>
                                            <input type="text" name="employee_number" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="designation">Designation</label>
                                            <input type="text" name="designation" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_number">Contact Number</label>
                                            <input type="text" name="contact_number" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="qualification">Qualification</label>
                                            <input type="text" name="qualification" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password_hash">Password</label>
                                            <input type="password" name="password_hash" class="form-control" required>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Add User</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- Add Multiple Users Modal -->
                    <div class="modal fade" id="addMultipleUsersModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="upload_csv.php" method="POST" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Multiple Users via CSV</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="csv_file">Upload CSV File</label>
                                            <input type="file" name="csv_file" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Upload CSV</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>



                    <!-- View User Modal -->
                    <div class="modal fade" id="viewUserModal<?= $row['id'] ?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">View User Details</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>User Type:</strong> <?= htmlspecialchars($row['user_type']) ?></p>
                                    <p><strong>Honorific:</strong> <?= htmlspecialchars($row['honorific']) ?></p>
                                    <p><strong>Name:</strong> <?= htmlspecialchars($row['name']) ?></p>
                                    <p><strong>Father's Name:</strong> <?= htmlspecialchars($row['father_name']) ?></p>
                                    <p><strong>Gender:</strong> <?= htmlspecialchars($row['gender']) ?></p>
                                    <p><strong>CNIC:</strong> <?= htmlspecialchars($row['cnic']) ?></p>
                                    <p><strong>Employee Number:</strong> <?= htmlspecialchars($row['employee_number']) ?></p>
                                    <p><strong>Designation:</strong> <?= htmlspecialchars($row['designation']) ?></p>
                                    <p><strong>Contact Number:</strong> <?= htmlspecialchars($row['contact_number']) ?></p>
                                    <p><strong>Address:</strong> <?= htmlspecialchars($row['address']) ?></p>
                                    <p><strong>Qualification:</strong> <?= htmlspecialchars($row['qualification']) ?></p>
                                    <p><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>
                                    <!-- <p><strong>Password Hash:</strong> <?= htmlspecialchars($row['password_hash']) ?></p> -->
                                </div>
                                <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="printDetails()">Print</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit User Modal -->
                    <div class="modal fade" id="editUserModal<?= $row['id'] ?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="edit_user.php" method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit User</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                                        <div class="form-group">
                                            <label for="user_type">User Type</label>
                                            <select name="user_type" class="form-control" required>
                                                <option value="admin" <?= ($row['user_type'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                                                <option value="user" <?= ($row['user_type'] == 'monitor') ? 'selected' : '' ?>>Monitor</option>
                                                <option value="user" <?= ($row['user_type'] == 'faculty') ? 'selected' : '' ?>>Faculty_Member</option>
                                                <option value="user" <?= ($row['user_type'] == 'student') ? 'selected' : '' ?>>Student</option>
                                                <!-- Add more options as needed -->
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="honorific">Honorific</label>
                                            <select name="honorific" class="form-control" required>
                                                <option value="Mr." <?= ($row['honorific'] == 'Mr.') ? 'selected' : '' ?>>Mr.</option>
                                                <option value="Ms." <?= ($row['honorific'] == 'Ms.') ? 'selected' : '' ?>>Ms.</option>
                                                <option value="Mrs." <?= ($row['honorific'] == 'Mrs.') ? 'selected' : '' ?>>Mrs.</option>
                                                <option value="Mrs." <?= ($row['honorific'] == 'Dr.') ? 'selected' : '' ?>>Dr.</option>
                                                <option value="Mrs." <?= ($row['honorific'] == 'Prof.') ? 'selected' : '' ?>>Prof.</option>
                                                <!-- Add more options as needed -->
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($row['name']) ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="father_name">Father's Name</label>
                                            <input type="text" name="father_name" class="form-control" value="<?= htmlspecialchars($row['father_name']) ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <select name="gender" class="form-control" required>
                                                <option value="Male" <?= ($row['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                                                <option value="Female" <?= ($row['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                                                <option value="Other" <?= ($row['gender'] == 'Other') ? 'selected' : '' ?>>Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="cnic">CNIC</label>
                                            <input type="text" name="cnic" class="form-control" value="<?= htmlspecialchars($row['cnic']) ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="employee_number">Employee Number</label>
                                            <input type="text" name="employee_number" class="form-control" value="<?= htmlspecialchars($row['employee_number']) ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="designation">Designation</label>
                                            <input type="text" name="designation" class="form-control" value="<?= htmlspecialchars($row['designation']) ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_number">Contact Number</label>
                                            <input type="text" name="contact_number" class="form-control" value="<?= htmlspecialchars($row['contact_number']) ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($row['address']) ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="qualification">Qualification</label>
                                            <input type="text" name="qualification" class="form-control" value="<?= htmlspecialchars($row['qualification']) ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password_hash">Password Hash</label>
                                            <div class="input-group">
                                                <input type="password" name="password_hash" class="form-control" id="password_hash<?= $row['id'] ?>" value="<?= htmlspecialchars($row['password_hash']) ?>" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" onclick="togglePassword('password_hash<?= $row['id'] ?>')">
                                                        <i class="fa fa-eye" id="eyeIcon<?= $row['id'] ?>"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($row['email']) ?>" required>
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
                    <div class="modal fade" id="deleteUserModal<?= $row['id'] ?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="delete_user.php" method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete User</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this user?</p>
                                        <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>

function printDetails() {
        // Hide the print button before printing
        const printButton = document.querySelector('.modal-footer .btn-primary');
        printButton.style.display = 'none';
        
        // Print the modal content
        window.print();
        
        // Show the print button again after printing
        printButton.style.display = 'inline-block';
}
            
        function togglePassword(id) {
            var passwordInput = document.getElementById(id);
            var eyeIcon = document.getElementById('eyeIcon' + id.replace(/\D/g, ''));
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>