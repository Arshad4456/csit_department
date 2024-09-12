<?php
// Include database connection
include '../db_connection.php';

// Handle add, edit, and delete operations
if (isset($_POST['action'])) {
    if ($_POST['action'] == 'add') {
        // Add new member
        $name = $_POST['name'];
        $position = $_POST['position'];
        $description = $_POST['description'];
        $image_url = $_POST['image_url'];
        $twitter_link = $_POST['twitter_link'];
        $facebook_link = $_POST['facebook_link'];
        $linkedin_link = $_POST['linkedin_link'];
        $instagram_link = $_POST['instagram_link'];

        $query = "INSERT INTO team_members (name, position, description, image_url, twitter_link, facebook_link, linkedin_link, instagram_link) 
                  VALUES ('$name', '$position', '$description', '$image_url', '$twitter_link', '$facebook_link', '$linkedin_link', '$instagram_link')";
        mysqli_query($conn, $query);

        echo "Member added successfully!";
    } elseif ($_POST['action'] == 'edit') {
        // Edit existing member
        $id = $_POST['id'];
        $name = $_POST['name'];
        $position = $_POST['position'];
        $description = $_POST['description'];
        $image_url = $_POST['image_url'];
        $twitter_link = $_POST['twitter_link'];
        $facebook_link = $_POST['facebook_link'];
        $linkedin_link = $_POST['linkedin_link'];
        $instagram_link = $_POST['instagram_link'];

        $query = "UPDATE team_members 
                  SET name='$name', position='$position', description='$description', image_url='$image_url', twitter_link='$twitter_link', facebook_link='$facebook_link', linkedin_link='$linkedin_link', instagram_link='$instagram_link' 
                  WHERE id='$id'";
        mysqli_query($conn, $query);

        echo "Member updated successfully!";
    } elseif ($_POST['action'] == 'delete') {
        // Delete member
        $id = $_POST['id'];

        $query = "DELETE FROM team_members WHERE id='$id'";
        mysqli_query($conn, $query);

        echo "Member deleted successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Team Members</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<!-- <?php include 'include/navbar.php'; ?> -->

<div class="container mt-5">
    <h2 class="text-center">Manage Team Members</h2>

    <!-- Button to trigger Add Member modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMemberModal">
        Add New Member
    </button>

    <!-- Table to display team members -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Position</th>
                <!-- <th>Description</th> -->
                <!-- <th>Image URL</th> -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch and display team members
            $query = "SELECT * FROM team_members";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['position']; ?></td>
                    <!-- <td><?php echo $row['description']; ?></td> -->
                    <!-- <td><a href="<?php echo $row['image_url']; ?>" target="_blank">View Image</a></td> -->
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editMemberModal" data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-position="<?php echo $row['position']; ?>" data-description="<?php echo $row['description']; ?>" data-image_url="<?php echo $row['image_url']; ?>" data-twitter_link="<?php echo $row['twitter_link']; ?>" data-facebook_link="<?php echo $row['facebook_link']; ?>" data-linkedin_link="<?php echo $row['linkedin_link']; ?>" data-instagram_link="<?php echo $row['instagram_link']; ?>">
                            Edit
                        </button>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteMemberModal" data-id="<?php echo $row['id']; ?>">
                            Delete
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Add Member Modal -->
<div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMemberModalLabel">Add New Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addMemberForm" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="add">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control" id="position" name="position">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image_url" class="form-label">Image URL</label>
                        <input type="text" class="form-control" id="image_url" name="image_url">
                    </div>
                    <div class="mb-3">
                        <label for="twitter_link" class="form-label">Twitter Link</label>
                        <input type="text" class="form-control" id="twitter_link" name="twitter_link">
                    </div>
                    <div class="mb-3">
                        <label for="facebook_link" class="form-label">Facebook Link</label>
                        <input type="text" class="form-control" id="facebook_link" name="facebook_link">
                    </div>
                    <div class="mb-3">
                        <label for="linkedin_link" class="form-label">LinkedIn Link</label>
                        <input type="text" class="form-control" id="linkedin_link" name="linkedin_link">
                    </div>
                    <div class="mb-3">
                        <label for="instagram_link" class="form-label">Instagram Link</label>
                        <input type="text" class="form-control" id="instagram_link" name="instagram_link">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Member</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Member Modal -->
<div class="modal fade" id="editMemberModal" tabindex="-1" aria-labelledby="editMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMemberModalLabel">Edit Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editMemberForm" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_position" class="form-label">Position</label>
                        <input type="text" class="form-control" id="edit_position" name="position">
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_description" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_image_url" class="form-label">Image URL</label>
                        <input type="text" class="form-control" id="edit_image_url" name="image_url">
                    </div>
                    <div class="mb-3">
                        <label for="edit_twitter_link" class="form-label">Twitter Link</label>
                        <input type="text" class="form-control" id="edit_twitter_link" name="twitter_link">
                    </div>
                    <div class="mb-3">
                        <label for="edit_facebook_link" class="form-label">Facebook Link</label>
                        <input type="text" class="form-control" id="edit_facebook_link" name="facebook_link">
                    </div>
                    <div class="mb-3">
                        <label for="edit_linkedin_link" class="form-label">LinkedIn Link</label>
                        <input type="text" class="form-control" id="edit_linkedin_link" name="linkedin_link">
                    </div>
                    <div class="mb-3">
                        <label for="edit_instagram_link" class="form-label">Instagram Link</label>
                        <input type="text" class="form-control" id="edit_instagram_link" name="instagram_link">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Member</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Member Modal -->
<div class="modal fade" id="deleteMemberModal" tabindex="-1" aria-labelledby="deleteMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMemberModalLabel">Delete Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deleteMemberForm" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" id="delete_id" name="id">
                    <p>Are you sure you want to delete this member?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/script.js"></script>
<script>
    // Populate edit modal with data
    var editMemberModal = document.getElementById('editMemberModal');
    editMemberModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var name = button.getAttribute('data-name');
        var position = button.getAttribute('data-position');
        var description = button.getAttribute('data-description');
        var imageUrl = button.getAttribute('data-image_url');
        var twitterLink = button.getAttribute('data-twitter_link');
        var facebookLink = button.getAttribute('data-facebook_link');
        var linkedinLink = button.getAttribute('data-linkedin_link');
        var instagramLink = button.getAttribute('data-instagram_link');

        var modal = document.getElementById('editMemberModal');
        modal.querySelector('#edit_id').value = id;
        modal.querySelector('#edit_name').value = name;
        modal.querySelector('#edit_position').value = position;
        modal.querySelector('#edit_description').value = description;
        modal.querySelector('#edit_image_url').value = imageUrl;
        modal.querySelector('#edit_twitter_link').value = twitterLink;
        modal.querySelector('#edit_facebook_link').value = facebookLink;
        modal.querySelector('#edit_linkedin_link').value = linkedinLink;
        modal.querySelector('#edit_instagram_link').value = instagramLink;
    });

    // Populate delete modal with data
    var deleteMemberModal = document.getElementById('deleteMemberModal');
    deleteMemberModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');

        var modal = document.getElementById('deleteMemberModal');
        modal.querySelector('#delete_id').value = id;
    });
</script>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
