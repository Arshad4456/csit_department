<?php
// Include database connection
include '../db_connection.php';

// Initialize variables
$footerText = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newFooterText = mysqli_real_escape_string($conn, $_POST['footer_text']);
    
    // Update footer text in the database
    $updateQuery = "UPDATE footer_info SET text='$newFooterText' WHERE id=1"; // Assuming there's only one record
    if (mysqli_query($conn, $updateQuery)) {
        $successMessage = 'Footer updated successfully.';
    } else {
        $errorMessage = 'Error updating footer: ' . mysqli_error($conn);
    }
}

// Fetch current footer info
$query = "SELECT * FROM footer_info WHERE id=1"; // Assuming there's only one record
$result = mysqli_query($conn, $query);
if ($result) {
    $footer = mysqli_fetch_assoc($result);
    $footerText = htmlspecialchars($footer['text']);
} else {
    $errorMessage = 'Error fetching footer info: ' . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Settings</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <h1>Footer Settings</h1>

    <?php if (isset($successMessage)): ?>
        <p class="success"><?= $successMessage; ?></p>
    <?php endif; ?>
    
    <?php if (isset($errorMessage)): ?>
        <p class="error"><?= $errorMessage; ?></p>
    <?php endif; ?>

    <form action="footer_settings.php" method="POST">
        <label for="footer_text">Footer Text:</label>
        <textarea id="footer_text" name="footer_text" rows="4" cols="50"><?= $footerText; ?></textarea>
        <br>
        <button type="submit">Update Footer</button>
    </form>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
