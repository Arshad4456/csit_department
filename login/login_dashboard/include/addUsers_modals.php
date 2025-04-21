<!-- Add Admin Modal -->
<div class="modal fade" id="adminForm" tabindex="-1" aria-labelledby="addAdminLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="backend/add_user.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addAdminLabel">Add Admin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="user_type" value="admin">
          <?php include 'add_user_forms/add_admin.php'; ?>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Add Admin</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Add Monitor Modal -->
<div class="modal fade" id="monitorForm" tabindex="-1" aria-labelledby="addMonitorLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="backend/add_user.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addMonitorLabel">Add Monitor</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="user_type" value="monitor">
          <?php include 'add_user_forms/add_monitor.php'; ?>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Add Monitor</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Add Faculty Modal -->
<div class="modal fade" id="facultyForm" tabindex="-1" aria-labelledby="addFacultyLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="backend/add_user.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addFacultyLabel">Add Faculty</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="user_type" value="faculty">
          <?php include 'add_user_forms/add_faculty.php'; ?>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Add Faculty</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Add Student Modal -->
<div class="modal fade" id="studentForm" tabindex="-1" aria-labelledby="addStudentLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="backend/add_user.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addStudentLabel">Add Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="user_type" value="student">
          <?php include 'add_user_forms/add_student.php'; ?>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Add Student</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
