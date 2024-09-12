<?php
// Start session and include database connection
session_start();
include '../db_connection.php'; // Ensure you have a file to connect to your database

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_carousel'])) {
        // Handle the add request
        $image_url = mysqli_real_escape_string($conn, $_POST['image_url']);
        $caption_title = mysqli_real_escape_string($conn, $_POST['caption_title']);
        $caption_text = mysqli_real_escape_string($conn, $_POST['caption_text']);
        $button_text = mysqli_real_escape_string($conn, $_POST['button_text']);
        $button_link = mysqli_real_escape_string($conn, $_POST['button_link']);
        
        $query = "INSERT INTO carousel (image_url, caption_title, caption_text, button_text, button_link)
                  VALUES ('$image_url', '$caption_title', '$caption_text', '$button_text', '$button_link')";
        if (mysqli_query($conn, $query)) {
            header('Location: carousel_settings.php'); // Refresh to reflect changes
            exit();
        } else {
            $error = 'Error adding record: ' . mysqli_error($conn);
        }
    }

    if (isset($_POST['update_carousel'])) {
        // Handle the update request
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $image_url = mysqli_real_escape_string($conn, $_POST['image_url']);
        $caption_title = mysqli_real_escape_string($conn, $_POST['caption_title']);
        $caption_text = mysqli_real_escape_string($conn, $_POST['caption_text']);
        $button_text = mysqli_real_escape_string($conn, $_POST['button_text']);
        $button_link = mysqli_real_escape_string($conn, $_POST['button_link']);
        
        $query = "UPDATE carousel SET image_url='$image_url', caption_title='$caption_title', caption_text='$caption_text', 
                  button_text='$button_text', button_link='$button_link' WHERE id='$id'";
        if (mysqli_query($conn, $query)) {
            header('Location: carousel_settings.php'); // Refresh to reflect changes
            exit();
        } else {
            $error = 'Error updating record: ' . mysqli_error($conn);
        }
    }

    if (isset($_POST['delete_carousel'])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        
        $query = "DELETE FROM carousel WHERE id='$id'";
        if (mysqli_query($conn, $query)) {
            echo json_encode(['status' => 'success']);
            exit();
        } else {
            echo json_encode(['status' => 'error']);
            exit();
        }
    }
    
}

// Fetch dynamic data from the database
$query = "SELECT * FROM carousel";
$result = mysqli_query($conn, $query);
$carousel_items = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carousel Settings</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Add your custom CSS here */
        .modal-header {
            background-color: #f8f9fa;
        }
        .modal-body {
            padding: 20px;
        }
        .btn-close {
            font-size: 1.25rem;
            line-height: 1;
            color: #000;
            opacity: .5;
        }
        .btn-close:hover {
            opacity: .75;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Carousel Settings</h2>
        
        <!-- Button to trigger add modal -->
        <button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#addModal">Add New Carousel Item</button>
        
        <!-- Table displaying carousel items -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image URL</th>
                    <th>Caption Title</th>
                    <!-- <th>Caption Text</th> -->
                    <th>Button Text</th>
                    <!-- <th>Button Link</th> -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($carousel_items as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['id']); ?></td>
                        <td><img src="<?= htmlspecialchars($item['image_url']); ?>" alt="Image" style="width: 100px;"></td>
                        <td><?= htmlspecialchars($item['caption_title']); ?></td>
                        <!-- <td><?= htmlspecialchars($item['caption_text']); ?></td> -->
                        <td><?= htmlspecialchars($item['button_text']); ?></td>
                        <!-- <td><a href="<?= htmlspecialchars($item['button_link']); ?>" target="_blank"><?= htmlspecialchars($item['button_link']); ?></a></td> -->
                        <td>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= htmlspecialchars($item['id']); ?>">Edit</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="<?= htmlspecialchars($item['id']); ?>">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Modal for adding -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add New Carousel Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="">
                            <div class="mb-3">
                                <label for="image_url" class="form-label">Image URL</label>
                                <input type="text" class="form-control" id="image_url" name="image_url" required>
                            </div>
                            <div class="mb-3">
                                <label for="caption_title" class="form-label">Caption Title</label>
                                <input type="text" class="form-control" id="caption_title" name="caption_title" required>
                            </div>
                            <div class="mb-3">
                                <label for="caption_text" class="form-label">Caption Text</label>
                                <input type="text" class="form-control" id="caption_text" name="caption_text" required>
                            </div>
                            <div class="mb-3">
                                <label for="button_text" class="form-label">Button Text</label>
                                <input type="text" class="form-control" id="button_text" name="button_text" required>
                            </div>
                            <div class="mb-3">
                                <label for="button_link" class="form-label">Button Link</label>
                                <input type="text" class="form-control" id="button_link" name="button_link" required>
                            </div>
                            <button type="submit" name="add_carousel" class="btn btn-primary">Add Carousel Item</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for editing -->
        <?php foreach ($carousel_items as $item): ?>
            <div class="modal fade" id="editModal<?= htmlspecialchars($item['id']); ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Carousel Item</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']); ?>">
                                <div class="mb-3">
                                    <label for="image_url" class="form-label">Image URL</label>
                                    <input type="text" class="form-control" id="image_url" name="image_url" value="<?= htmlspecialchars($item['image_url']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="caption_title" class="form-label">Caption Title</label>
                                    <input type="text" class="form-control" id="caption_title" name="caption_title" value="<?= htmlspecialchars($item['caption_title']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="caption_text" class="form-label">Caption Text</label>
                                    <input type="text" class="form-control" id="caption_text" name="caption_text" value="<?= htmlspecialchars($item['caption_text']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="button_text" class="form-label">Button Text</label>
                                    <input type="text" class="form-control" id="button_text" name="button_text" value="<?= htmlspecialchars($item['button_text']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="button_link" class="form-label">Button Link</label>
                                    <input type="text" class="form-control" id="button_link" name="button_link" value="<?= htmlspecialchars($item['button_link']); ?>" required>
                                </div>
                                <button type="submit" name="update_carousel" class="btn btn-primary">Update Carousel Item</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- JS and Bootstrap scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.delete-btn').on('click', function() {
                const id = $(this).data('id');
                if (confirm('Are you sure you want to delete this carousel item?')) {
                    $.ajax({
                        type: 'POST',
                        url: 'carousel_settings.php',
                        data: { id: id, delete_carousel: true },
                        success: function(response) {
                            const result = JSON.parse(response);
                            if (result.status === 'success') {
                                location.reload();
                            } else {
                                alert('Failed to delete the carousel item.');
                            }
                        },
                        error: function() {
                            alert('An error occurred.');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
