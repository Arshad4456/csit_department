<?php
// Start session and include database connection
session_start();
include '../db_connection.php'; // Ensure you have a file to connect to your database

// Handle form submissions for adding or updating links
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_link'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $url = mysqli_real_escape_string($conn, $_POST['url']);
        $query = "INSERT INTO navbar_links (name, url) VALUES ('$name', '$url')";
        mysqli_query($conn, $query);
    } elseif (isset($_POST['update_link'])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $url = mysqli_real_escape_string($conn, $_POST['url']);
        $query = "UPDATE navbar_links SET name='$name', url='$url' WHERE id='$id'";
        mysqli_query($conn, $query);
    } elseif (isset($_POST['delete_link'])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $query = "DELETE FROM navbar_links WHERE id='$id'";
        mysqli_query($conn, $query);
    }
}

// Fetch navbar links
$query = "SELECT * FROM navbar_links";
$result = mysqli_query($conn, $query);
$links = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Settings</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/style.css"> -->

    <style>
        /* Page Settings CSS */

.container {
    max-width: 1200px;
    margin: auto;
}

h1 {
    font-size: 2rem;
    margin-bottom: 1.5rem;
}

h2 {
    font-size: 1.5rem;
    margin-top: 2rem;
}

.table {
    margin-top: 2rem;
}

.table td, .table th {
    vertical-align: middle;
}

.btn {
    margin: 0.2rem;
}

.modal-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.modal-body {
    padding: 1.5rem;
}

.modal-content {
    border-radius: 0.5rem;
}

.modal-footer {
    border-top: 1px solid #dee2e6;
}

    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Navbar Settings</h1>

        <!-- Add New Link Form -->
        <h2>Add New Link</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Link Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="url" class="form-label">Link URL</label>
                <input type="text" class="form-control" id="url" name="url" required>
            </div>
            <button type="submit" name="add_link" class="btn btn-primary">Add Link</button>
        </form>

        <!-- Existing Links Table -->
        <h2 class="mt-5">Existing Links</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>URL</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($links as $link): ?>
                    <tr>
                        <td><?= htmlspecialchars($link['id']); ?></td>
                        <td><?= htmlspecialchars($link['name']); ?></td>
                        <td><?= htmlspecialchars($link['url']); ?></td>
                        <td>
                            <!-- Edit Button -->
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= htmlspecialchars($link['id']); ?>">Edit</button>
                            <!-- Delete Form -->
                            <form method="post" action="" style="display:inline;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($link['id']); ?>">
                                <button type="submit" name="delete_link" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal<?= htmlspecialchars($link['id']); ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Link</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($link['id']); ?>">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Link Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($link['name']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="url" class="form-label">Link URL</label>
                                            <input type="text" class="form-control" id="url" name="url" value="<?= htmlspecialchars($link['url']); ?>" required>
                                        </div>
                                        <button type="submit" name="update_link" class="btn btn-primary">Update Link</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- All JavaScript -->
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
