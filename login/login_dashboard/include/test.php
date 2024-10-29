<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>User Dashboard</title>
</head>
<body>
    <div class="container mt-5">
        <h2>User Management Dashboard</h2>
        <!-- Button trigger modal for adding single user -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
            Add Single User
        </button>

        <!-- Button trigger modal for adding multiple users -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addMultipleUsersModal">
            Add Multiple Users via CSV
        </button>

        <!-- Include modals here -->
        <?php include 'addUsers_modals.php'; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
