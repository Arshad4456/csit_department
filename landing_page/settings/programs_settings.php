<?php
include '../db_connection.php';

// Handle add program
if (isset($_POST['add_program'])) {
    $program_name = $_POST['program_name'];
    $image_url = $_POST['image_url'];
    $button_text = $_POST['button_text'];
    $button_link = $_POST['button_link'];
    
    // Move uploaded file to target directory
    move_uploaded_file($_POST['image_url'], 'img/' . $image_url);

    $sql = "INSERT INTO programs (program_name, image_url, button_text, button_link) VALUES ('$program_name', '$image_url', '$button_text', '$button_link')";
    if (mysqli_query($conn, $sql)) {
        $message = "Program added successfully!";
    } else {
        $message = "Error adding program: " . mysqli_error($conn);
    }
}

// Handle update program
if (isset($_POST['update_program'])) {
    $program_id = $_POST['program_id'];
    $program_name = $_POST['program_name'];
    $image_url = $_POST['image_url']['name'];
    $button_text = $_POST['button_text'];
    $button_link = $_POST['button_link'];

    if ($image_url) {
        // Move uploaded file to target directory
        move_uploaded_file($_POST['image_url']['tmp_name'], 'img/' . $image_url);
        $sql = "UPDATE programs SET program_name='$program_name', image_url='$image_url', button_text='$button_text', button_link='$button_link' WHERE id=$program_id";
    } else {
        $sql = "UPDATE programs SET program_name='$program_name', button_text='$button_text', button_link='$button_link' WHERE id=$program_id";
    }

    if (mysqli_query($conn, $sql)) {
        $message = "Program updated successfully!";
    } else {
        $message = "Error updating program: " . mysqli_error($conn);
    }
}

// Handle delete program
if (isset($_POST['delete_program'])) {
    $program_id = $_POST['program_id'];
    $sql = "DELETE FROM programs WHERE id=$program_id";
    if (mysqli_query($conn, $sql)) {
        $message = "Program deleted successfully!";
    } else {
        $message = "Error deleting program: " . mysqli_error($conn);
    }
}

// Fetch programs data
$result = mysqli_query($conn, "SELECT * FROM programs ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programs Settings</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Programs Settings</h2>

    <!-- Success Message -->
    <?php if (isset($message)) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $message; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php } ?>

    <!-- Button to trigger Add New Program Modal -->
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addProgramModal">Add New Program</button>

    <!-- Programs Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Program Name</th>
                <th>Image Link</th>
                <th>Button Text</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['program_name']); ?></td>
                <td><a href="../<?php echo htmlspecialchars($row['image_url']); ?>" target="_blank"><?php echo htmlspecialchars($row['image_url']); ?></a></td>
                <td><?php echo htmlspecialchars($row['button_text']); ?></td>
                <td>
                    <!-- Edit button triggers Edit Modal -->
                    <button class="btn btn-warning" data-toggle="modal" data-target="#editProgramModal" 
                        onclick="editProgram(<?php echo $row['id']; ?>, '<?php echo htmlspecialchars($row['program_name']); ?>', '<?php echo htmlspecialchars($row['image_url']); ?>', '<?php echo htmlspecialchars($row['button_text']); ?>', '<?php echo htmlspecialchars($row['button_link']); ?>')">Edit</button>
                    
                    <!-- Delete button triggers Delete Modal -->
                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteProgramModal" 
                        onclick="deleteProgram(<?php echo $row['id']; ?>)">Delete</button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Add New Program Modal -->
<div class="modal fade" id="addProgramModal" tabindex="-1" role="dialog" aria-labelledby="addProgramModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProgramModalLabel">Add New Program</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="programName">Program Name</label>
                        <input type="text" class="form-control" id="programName" name="program_name" required>
                    </div>
                    <div class="form-group">
                        <label for="programImage">Program Image URL</label>
                        <input type="text" class="form-control" id="programImage" name="image_url" required>
                    </div>
                    <div class="form-group">
                        <label for="buttonText">Button Text</label>
                        <input type="text" class="form-control" id="buttonText" name="button_text" required>
                    </div>
                    <div class="form-group">
                        <label for="buttonLink">Button Link</label>
                        <input type="text" class="form-control" id="buttonLink" name="button_link" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    <button type="submit" class="btn btn-primary" name="add_program">Add Program</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Program Modal -->
<div class="modal fade" id="editProgramModal" tabindex="-1" role="dialog" aria-labelledby="editProgramModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="editProgramId" name="program_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProgramModalLabel">Edit Program</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editProgramName">Program Name</label>
                        <input type="text" class="form-control" id="editProgramName" name="program_name" required>
                    </div>
                    <div class="form-group">
                        <label for="editProgramImage">Program image_url(Leave default if not changing)</label>
                        <input type="text" class="form-control" id="editProgramImage" name="image_url" required>
                    </div>
                    <div class="form-group">
                        <label for="editButtonText">Button Text</label>
                        <input type="text" class="form-control" id="editButtonText" name="button_text" required>
                    </div>
                    <div class="form-group">
                        <label for="editButtonLink">Button Link</label>
                        <input type="text" class="form-control" id="editButtonLink" name="button_link" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    <button type="submit" class="btn btn-warning" name="update_program">Update Program</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Program Modal -->
<div class="modal fade" id="deleteProgramModal" tabindex="-1" role="dialog" aria-labelledby="deleteProgramModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST">
                <input type="hidden" id="deleteProgramId" name="program_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProgramModalLabel">Delete Program</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this program?
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    <button type="submit" class="btn btn-danger" name="delete_program">Delete Program</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
function editProgram(id, name, image, buttonText, buttonLink) {
    document.getElementById('editProgramId').value = id;
    document.getElementById('editProgramName').value = name;
    document.getElementById('editProgramImage').value = image;
    document.getElementById('editButtonText').value = buttonText;
    document.getElementById('editButtonLink').value = buttonLink;
    // Set the image URL to be visible in the modal (for reference only)
    // The image URL will not be displayed directly, but you might want to show it in a label or similar element if needed
}

function deleteProgram(id) {
    document.getElementById('deleteProgramId').value = id;
}
</script>

</body>
</html>
