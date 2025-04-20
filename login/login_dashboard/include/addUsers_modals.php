<!-- Add Single User Modal -->
<div class="modal fade" id="addSingleUserModal" tabindex="-1" aria-labelledby="addSingleUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSingleUserModalLabel">Add Single User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- User Type Selection -->
        <div class="mb-3">
          <label for="userType" class="form-label">User Type</label>
          <select class="form-select" id="userType" name="user_type" required>
            <option value="admin">Admin</option>
            <option value="monitor">Monitor</option>
            <option value="faculty">Faculty</option>
            <option value="student">Student</option>
          </select>
        </div>
        
        <!-- Dynamic Form Fields Based on User Type -->
        <div id="dynamicForm"></div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveUser">Save User</button>
      </div>
    </div>
  </div>
</div>

<!-- Add Multiple Users (CSV Upload) Modal -->
<div class="modal fade" id="uploadCSVModal" tabindex="-1" aria-labelledby="uploadCSVModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="uploadCSVModalLabel">Upload CSV for Multiple Users</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- User Type Selection for CSV Upload -->
        <div class="mb-3">
          <label for="csvUserType" class="form-label">User Type</label>
          <select class="form-select" id="csvUserType" name="csv_user_type" required>
            <option value="admin">Admin</option>
            <option value="monitor">Monitor</option>
            <option value="faculty">Faculty</option>
            <option value="student">Student</option>
          </select>
        </div>

        <!-- CSV File Upload -->
        <div class="mb-3">
          <label for="csvFile" class="form-label">CSV File</label>
          <input class="form-control" type="file" id="csvFile" accept=".csv" required>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="uploadCSV">Upload CSV</button>
      </div>
    </div>
  </div>
</div>
