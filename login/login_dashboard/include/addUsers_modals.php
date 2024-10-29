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
                    <div class="form-group">
                        <label for="userType">User Type</label>
                        <select class="form-control" id="userType" name="user_type" onchange="showFields()" required>
                            <option value="" disabled selected>Select an option</option>
                            <option value="admin">Admin</option>
                            <option value="monitor">Monitor</option>
                            <option value="faculty">Faculty</option>
                            <option value="student">Student</option>
                        </select>
                    </div>

                    <!-- Fields for Admin, Monitor, Faculty -->
                    <div id="commonFields" style="display: none;">
                        <div class="form-group">
                            <label for="honorific">Honorific</label>
                            <input type="text" class="form-control" id="honorific" name="honorific" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="fatherName">Father's Name</label>
                            <input type="text" class="form-control" id="fatherName" name="father_name" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cnic">CNIC</label>
                            <input type="text" class="form-control" id="cnic" name="cnic" required>
                        </div>
                        <div class="form-group">
                            <label for="employeeNumber">Employee Number</label>
                            <input type="text" class="form-control" id="employeeNumber" name="employee_number" required>
                        </div>
                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" id="designation" name="designation" required>
                        </div>
                        <div class="form-group">
                            <label for="contactNumber">Contact Number</label>
                            <input type="text" class="form-control" id="contactNumber" name="contact_number" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="qualification">Qualification</label>
                            <input type="text" class="form-control" id="qualification" name="qualification" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>

                    <!-- Fields for Student -->
                    <div id="studentFields" style="display: none;">
                        <div class="form-group">
                            <label for="studentName">Name</label>
                            <input type="text" class="form-control" id="studentName" name="student_name" required>
                        </div>
                        <div class="form-group">
                            <label for="fatherName">Father's Name</label>
                            <input type="text" class="form-control" id="fatherName" name="father_name" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cnic">CNIC</label>
                            <input type="text" class="form-control" id="cnic" name="cnic" required>
                        </div>
                        <div class="form-group">
                            <label for="registrationNo">Registration No</label>
                            <input type="text" class="form-control" id="registrationNo" name="registration_no" required>
                        </div>
                        <div class="form-group">
                            <label for="contactNo">Contact No</label>
                            <input type="text" class="form-control" id="contactNo" name="contact_no" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="batch">Batch</label>
                            <input type="text" class="form-control" id="batch" name="batch" required>
                        </div>
                        <div class="form-group">
                            <label for="studentEmail">Email</label>
                            <input type="email" class="form-control" id="studentEmail" name="student_email" required>
                        </div>
                        <div class="form-group">
                            <label for="studentPassword">Password</label>
                            <input type="password" class="form-control" id="studentPassword" name="student_password" required>
                        </div>
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

<!-- Add Multiple Users via CSV Modal -->
<div class="modal fade" id="addMultipleUsersModal" tabindex="-1" role="dialog" aria-labelledby="addMultipleUsersModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMultipleUsersModalLabel">Add Users via CSV</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="upload_csv.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="csvUserType">User Type</label>
                        <select class="form-control" id="csvUserType" name="csv_user_type" required>
                            <option value="admin">Admin</option>
                            <option value="monitor">Monitor</option>
                            <option value="faculty">Faculty</option>
                            <option value="student">Student</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="csvFile">CSV File</label>
                        <input type="file" class="form-control" id="csvFile" name="csv_file" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload Users</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showFields() {
    const userType = document.getElementById('userType').value;
    const commonFields = document.getElementById('commonFields');
    const studentFields = document.getElementById('studentFields');

    if (userType === 'student') {
        studentFields.style.display = 'block';
        commonFields.style.display = 'none';
    } else {
        studentFields.style.display = 'none';
        commonFields.style.display = 'block';
    }
}
</script>
