<!-- Edit Admin Modal -->
<div class="modal fade" id="editAdminModal<?= $row['id'] ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="edit_user.php" method="POST">
                <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Admin Details</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($row['name']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($row['email']) ?>" required>
                    </div>
                    <!-- Add more fields as necessary -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Repeat for Monitor, Faculty, and Student -->
