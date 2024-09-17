<?php
include 'db_connection.php';

// Fetch user data
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

// Display status messages
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'success') {
        echo '<div class="alert alert-success">User updated successfully!</div>';
    } elseif ($_GET['status'] == 'error') {
        echo '<div class="alert alert-danger">Failed to update user. Please try again.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Users Dashboard</h2>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">Add User</button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Honorific</th>
                    <th>Name</th>
                    <!-- <th>Father Name</th> -->
                    <!-- <th>Gender</th> -->
                    <th>Email</th>
                    <!-- <th>CNIC</th> -->
                    <!-- <th>Employee Number</th> -->
                    <th>Designation</th>
                    <!-- <th>Contact Number</th> -->
                    <!-- <th>Address</th> -->
                    <!-- <th>Qualification</th> -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['honorific']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <!-- <td><?php echo $row['father_name']; ?></td> -->
                        <!-- <td><?php echo $row['gender']; ?></td> -->
                        <td><?php echo $row['email']; ?></td>
                        <!-- <td><?php echo $row['cnic']; ?></td> -->
                        <!-- <td><?php echo $row['employee_number']; ?></td> -->
                        <td><?php echo $row['designation']; ?></td>
                        <!-- <td><?php echo $row['contact_number']; ?></td> -->
                        <!-- <td><?php echo $row['address']; ?></td> -->
                        <!-- <td><?php echo $row['qualification']; ?></td> -->
                        <td>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal" data-id="<?php echo $row['id']; ?>" data-honorific="<?php echo $row['honorific']; ?>" data-name="<?php echo $row['name']; ?>" data-father_name="<?php echo $row['father_name']; ?>" data-gender="<?php echo $row['gender']; ?>" data-email="<?php echo $row['email']; ?>" data-cnic="<?php echo $row['cnic']; ?>" data-employee_number="<?php echo $row['employee_number']; ?>" data-designation="<?php echo $row['designation']; ?>" data-contact_number="<?php echo $row['contact_number']; ?>" data-address="<?php echo $row['address']; ?>" data-qualification="<?php echo $row['qualification']; ?>">Edit</button>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $row['id']; ?>">Delete</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>


    <!-- Add User Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addForm" method="POST" action="add_user.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="addHonorific">Honorific</label>
                        <input type="text" class="form-control" id="addHonorific" name="honorific">
                    </div>
                    <div class="form-group">
                        <label for="addName">Name</label>
                        <input type="text" class="form-control" id="addName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="addFatherName">Father Name</label>
                        <input type="text" class="form-control" id="addFatherName" name="father_name">
                    </div>
                    <div class="form-group">
                        <label for="addGender">Gender</label>
                        <input type="text" class="form-control" id="addGender" name="gender">
                    </div>
                    <div class="form-group">
                        <label for="addEmail">Email</label>
                        <input type="email" class="form-control" id="addEmail" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="addCnic">CNIC</label>
                        <input type="text" class="form-control" id="addCnic" name="cnic">
                    </div>
                    <div class="form-group">
                        <label for="addEmployeeNumber">Employee Number</label>
                        <input type="text" class="form-control" id="addEmployeeNumber" name="employee_number">
                    </div>
                    <div class="form-group">
                        <label for="addDesignation">Designation</label>
                        <input type="text" class="form-control" id="addDesignation" name="designation" required>
                    </div>
                    <div class="form-group">
                        <label for="addContactNumber">Contact Number</label>
                        <input type="text" class="form-control" id="addContactNumber" name="contact_number">
                    </div>
                    <div class="form-group">
                        <label for="addAddress">Address</label>
                        <textarea class="form-control" id="addAddress" name="address"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="addQualification">Qualification</label>
                        <input type="text" class="form-control" id="addQualification" name="qualification">
                    </div>
                    <div class="form-group">
                        <label for="excelFile">Upload Excel File (optional)</label>
                        <input type="file" class="form-control-file" id="excelFile" name="excelFile" accept=".xlsx, .xls">
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


    <!-- Edit User Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" method="POST" action="edit_user.php">
                    <div class="modal-body">
                        <input type="hidden" id="editId" name="id">
                        <div class="form-group">
                            <label for="editHonorific">Honorific</label>
                            <input type="text" class="form-control" id="editHonorific" name="honorific">
                        </div>
                        <div class="form-group">
                            <label for="editName">Name</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="editFatherName">Father Name</label>
                            <input type="text" class="form-control" id="editFatherName" name="father_name">
                        </div>
                        <div class="form-group">
                            <label for="editGender">Gender</label>
                            <input type="text" class="form-control" id="editGender" name="gender">
                        </div>
                        <div class="form-group">
                            <label for="editEmail">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="editCnic">CNIC</label>
                            <input type="text" class="form-control" id="editCnic" name="cnic">
                        </div>
                        <div class="form-group">
                            <label for="editEmployeeNumber">Employee Number</label>
                            <input type="text" class="form-control" id="editEmployeeNumber" name="employee_number">
                        </div>
                        <div class="form-group">
                            <label for="editDesignation">Designation</label>
                            <input type="text" class="form-control" id="editDesignation" name="designation" required>
                        </div>
                        <div class="form-group">
                            <label for="editContactNumber">Contact Number</label>
                            <input type="text" class="form-control" id="editContactNumber" name="contact_number">
                        </div>
                        <div class="form-group">
                            <label for="editAddress">Address</label>
                            <textarea class="form-control" id="editAddress" name="address"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editQualification">Qualification</label>
                            <input type="text" class="form-control" id="editQualification" name="qualification">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete User Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="delete_user.php">
                        <input type="hidden" id="deleteId" name="id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var honorific = button.data('honorific');
            var name = button.data('name');
            var fatherName = button.data('father_name');
            var gender = button.data('gender');
            var email = button.data('email');
            var cnic = button.data('cnic');
            var employeeNumber = button.data('employee_number');
            var designation = button.data('designation');
            var contactNumber = button.data('contact_number');
            var address = button.data('address');
            var qualification = button.data('qualification');

            var modal = $(this);
            modal.find('#editId').val(id);
            modal.find('#editHonorific').val(honorific);
            modal.find('#editName').val(name);
            modal.find('#editFatherName').val(fatherName);
            modal.find('#editGender').val(gender);
            modal.find('#editEmail').val(email);
            modal.find('#editCnic').val(cnic);
            modal.find('#editEmployeeNumber').val(employeeNumber);
            modal.find('#editDesignation').val(designation);
            modal.find('#editContactNumber').val(contactNumber);
            modal.find('#editAddress').val(address);
            modal.find('#editQualification').val(qualification);
        });

        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);
            modal.find('#deleteId').val(id);
        });
    </script>
</body>
</html>
