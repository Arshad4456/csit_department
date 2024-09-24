<!-- Delete Admin Modal -->
<div class="modal fade" id="deleteAdminModal<?= $row['id'] ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="delete_user.php" method="POST">
                <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Admin</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this admin?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Repeat for Monitor, Faculty, and Student -->
