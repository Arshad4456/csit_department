<!-- View Admin Modal -->
<div class="modal fade" id="viewAdminModal<?= $row['id'] ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Admin Details</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <?= htmlspecialchars($row['name']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>
                <!-- Add more fields as necessary -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Repeat for Monitor, Faculty, and Student -->
