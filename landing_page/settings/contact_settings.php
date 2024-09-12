<?php
include '../db_connection.php';

// Handle form submission to update contact email
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Update the contact email in the database
    $update_query = "UPDATE contact SET email='$new_email' WHERE id=1";
    
    if (mysqli_query($conn, $update_query)) {
        $success_message = "Contact email updated successfully.";
    } else {
        $error_message = "Error updating contact email: " . mysqli_error($conn);
    }
}

// Fetch contact email data
$result = mysqli_query($conn, "SELECT * FROM contact WHERE id=1");
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Settings</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Contact Settings</h2>
        <?php if (isset($success_message)) { echo '<div class="alert alert-success">' . $success_message . '</div>'; } ?>
        <?php if (isset($error_message)) { echo '<div class="alert alert-danger">' . $error_message . '</div>'; } ?>
        <form action="contact_settings.php" method="POST" class="bg-light p-4">
            <div class="mb-3">
                <label for="email" class="form-label">Contact Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Email</button>
        </form>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
