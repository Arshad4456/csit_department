<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editUserForm">
          <input type="hidden" name="user_id" id="user_id">
          <input type="hidden" name="user_type" id="user_type">

          <div class="mb-3">
            <label for="editName" class="form-label">Name</label>
            <input type="text" class="form-control" id="editName" name="name" required>
          </div>

          <div class="mb-3">
            <label for="editFatherName" class="form-label">Father's Name</label>
            <input type="text" class="form-control" id="editFatherName" name="father_name" required>
          </div>

          <div class="mb-3">
            <label for="editGender" class="form-label">Gender</label>
            <select class="form-select" id="editGender" name="gender">
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="editCnic" class="form-label">CNIC</label>
            <input type="text" class="form-control" id="editCnic" name="cnic" required>
          </div>

          <!-- Dynamic fields for Admin, Monitor, Faculty, and Student -->
          <div id="adminFields" class="d-none">
            <div class="mb-3">
              <label for="editEmployeeNumber" class="form-label">Employee Number</label>
              <input type="text" class="form-control" id="editEmployeeNumber" name="employee_number">
            </div>
            <div class="mb-3">
              <label for="editDesignation" class="form-label">Designation</label>
              <input type="text" class="form-control" id="editDesignation" name="designation">
            </div>
          </div>

          <div id="facultyFields" class="d-none">
            <div class="mb-3">
              <label for="editQualification" class="form-label">Qualification</label>
              <input type="text" class="form-control" id="editQualification" name="qualification">
            </div>
            <div class="mb-3">
              <label for="editDesignationFaculty" class="form-label">Designation</label>
              <input type="text" class="form-control" id="editDesignationFaculty" name="designation">
            </div>
          </div>

          <div id="studentFields" class="d-none">
            <div class="mb-3">
              <label for="editRegistrationNo" class="form-label">Registration No</label>
              <input type="text" class="form-control" id="editRegistrationNo" name="registration_no">
            </div>
            <div class="mb-3">
              <label for="editProgram" class="form-label">Program</label>
              <input type="text" class="form-control" id="editProgram" name="program">
            </div>
            <div class="mb-3">
              <label for="editBatch" class="form-label">Batch</label>
              <input type="text" class="form-control" id="editBatch" name="batch">
            </div>
          </div>

          <div class="mb-3">
            <label for="editContactNumber" class="form-label">Contact Number</label>
            <input type="text" class="form-control" id="editContactNumber" name="contact_number" required>
          </div>

          <div class="mb-3">
            <label for="editAddress" class="form-label">Address</label>
            <textarea class="form-control" id="editAddress" name="address"></textarea>
          </div>

          <div class="mb-3">
            <label for="editEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="editEmail" name="email" required>
          </div>

          <div class="mb-3">
            <label for="editPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="editPassword" name="password" required>
          </div>

          <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
