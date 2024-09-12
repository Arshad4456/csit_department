<?php
include '../db_connection.php';

// Handle form submission for adding a new service
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_service'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $icon_class = mysqli_real_escape_string($conn, $_POST['icon_class']);
    $button_link = mysqli_real_escape_string($conn, $_POST['button_link']);
    $button_text = mysqli_real_escape_string($conn, $_POST['button_text']);

    $insert_query = "INSERT INTO services (title, description, icon_class, button_link, button_text) VALUES ('$title', '$description', '$icon_class', '$button_link', '$button_text')";
    if (mysqli_query($conn, $insert_query)) {
        header('Location: services_settings.php?success=1');
        exit();
    } else {
        echo "Error adding record: " . mysqli_error($conn);
    }
}

// Handle form submission for editing a service
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_service'])) {
    $id = intval($_POST['id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $icon_class = mysqli_real_escape_string($conn, $_POST['icon_class']);
    $button_link = mysqli_real_escape_string($conn, $_POST['button_link']);
    $button_text = mysqli_real_escape_string($conn, $_POST['button_text']);

    $update_query = "UPDATE services SET title='$title', description='$description', icon_class='$icon_class', button_link='$button_link', button_text='$button_text' WHERE id=$id";
    if (mysqli_query($conn, $update_query)) {
        header('Location: services_settings.php?success=1');
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Handle service deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $delete_query = "DELETE FROM services WHERE id=$id";
    if (mysqli_query($conn, $delete_query)) {
        header('Location: services_settings.php?success=1');
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Fetch current services data
$result = mysqli_query($conn, "SELECT * FROM services ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <!-- Custom Inline CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .btn-primary {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .alert-success {
            color: green;
            text-align: center;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .btn-warning {
            background-color: #ffc107;
            border: none;
            color: #000;
        }



        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            Operation completed successfully!
        </div>
    <?php endif; ?>

    <h1>Services Settings</h1>

    <!-- Button to Open Add Service Modal -->
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addServiceModal">
        Add New Service
    </button>

    <!-- Existing Services List -->
    <h2 class="mt-5">Existing Services</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <!-- <th>Icon Class</th> -->
                <!-- <th>Button Link</th> -->
                <!-- <th>Button Text</th> -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <!-- <td><?php echo htmlspecialchars($row['icon_class']); ?></td> -->
                    <!-- <td><?php echo htmlspecialchars($row['button_link']); ?></td> -->
                    <!-- <td><?php echo htmlspecialchars($row['button_text']); ?></td> -->
                    <td>
                        <!-- Button to Open Edit Service Modal -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editServiceModal" data-id="<?php echo $row['id']; ?>" data-title="<?php echo htmlspecialchars($row['title']); ?>" data-description="<?php echo htmlspecialchars($row['description']); ?>" data-icon_class="<?php echo htmlspecialchars($row['icon_class']); ?>" data-button_link="<?php echo htmlspecialchars($row['button_link']); ?>" data-button_text="<?php echo htmlspecialchars($row['button_text']); ?>">Edit</button>
                        <a href="services_settings.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this service?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Add Service Modal -->
    <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addServiceModalLabel">Add New Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="services_settings.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="icon_class">Icon Class</label>
                            <input type="text" id="icon_class" name="icon_class" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="button_link">Button Link</label>
                            <input type="btn btn-outline-succes" id="button_link" name="button_link" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="button_text">Button Text</label>
                            <input type="text" id="button_text" name="button_text" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                        <button type="submit" name="add_service" class="btn btn-primary">Add Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Service Modal -->
<div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editServiceModalLabel">Edit Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="services_settings.php" method="POST">
                <input type="hidden" id="edit_id" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_title">Title</label>
                        <input type="text" id="edit_title" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_description">Description</label>
                        <textarea id="edit_description" name="description" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_icon_class">Icon Class</label>
                        <input type="text" id="edit_icon_class" name="icon_class" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_button_link">Button Link</label>
                        <input type="btn btn-outline-success" id="edit_button_link" name="button_link" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_button_text">Button Text</label>
                        <input type="text" id="edit_button_text" name="button_text" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    <button type="submit" name="edit_service" class="btn btn-primary">Update Service</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="../js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editServiceModal = document.getElementById('editServiceModal');

        editServiceModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var id = button.getAttribute('data-id');
            var title = button.getAttribute('data-title');
            var description = button.getAttribute('data-description');
            var icon_class = button.getAttribute('data-icon_class');
            var button_link = button.getAttribute('data-button_link');
            var button_text = button.getAttribute('data-button_text');

            // Access the form elements inside the modal
            var modal = editServiceModal.querySelector('form');
            modal.querySelector('#edit_id').value = id;
            modal.querySelector('#edit_title').value = title;
            modal.querySelector('#edit_description').value = description;
            modal.querySelector('#edit_icon_class').value = icon_class;
            modal.querySelector('#edit_button_link').value = button_link;
            modal.querySelector('#edit_button_text').value = button_text;
        });
    });
</script>


</body>

</html>