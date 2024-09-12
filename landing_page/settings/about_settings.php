<?php
include '../db_connection.php';

// Fetch current about data
$result = mysqli_query($conn, "SELECT * FROM about WHERE id=1");
$data = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $learn_more_link = mysqli_real_escape_string($conn, $_POST['learn_more_link']);

    // Check if a new image is uploaded
    if (!empty($_FILES['image_url']['name'])) {
        $image_url = 'img/' . basename($_FILES['image_url']['name']);
        move_uploaded_file($_FILES['image_url']['tmp_name'], $image_url);
    } else {
        // Use the existing image if no new image is uploaded
        $image_url = $data['image_url'];
    }

    // Update the database
    $update_query = "UPDATE about SET title='$title', content='$content', image_url='$image_url', learn_more_link='$learn_more_link' WHERE id=1";
    if (mysqli_query($conn, $update_query)) {
        // Redirect back to the settings page after update
        header('Location: about_settings.php?success=1');
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Section Settings</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">

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
        form {
            max-width: 700px; /* Increased form width */
            margin: 0 auto;
            background-color: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        /* Increased size of content box */
        .form-control.content {
            height: 200px; /* Set custom height for textarea */
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
        .img-preview {
            display: block;
            margin: 10px 0;
        }
    </style>
</head>
<body>

<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">
        About section updated successfully!
    </div>
<?php endif; ?>

<h1>About Section Settings</h1>
<form action="about_settings.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($data['title']); ?>" required>
    </div>

    <div class="form-group">
        <label for="content">Content</label>
        <!-- Applied larger height to textarea -->
        <textarea id="content" name="content" class="form-control content" rows="10" required><?php echo htmlspecialchars($data['content']); ?></textarea>
    </div>

    <div class="form-group">
        <label for="image_url">Image</label>
        <input type="file" id="image_url" name="image_url" class="form-control">
        <?php if (!empty($data['image_url'])): ?>
            <p>Current Image: <img src="<?php echo htmlspecialchars($data['image_url']); ?>" alt="Current Image" class="img-preview" width="100"></p>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="learn_more_link">Learn More Link</label>
        <input type="btn btn-outline-success" id="learn_more_link" name="learn_more_link" class="form-control" value="<?php echo isset($data['learn_more_link']) ? htmlspecialchars($data['learn_more_link']) : ''; ?>">
    </div>

    <button type="submit" class="btn btn-primary">Update About Section</button>
</form>

</body>
</html>
