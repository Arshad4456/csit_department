<?php
// Include database connection
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];  // User ID passed from the modal

    // SQL query to fetch user details
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $user = mysqli_fetch_assoc($result);

        // Prepare the response as HTML
        echo "
            <p><strong>User Type:</strong> {$user['user_type']}</p>
            <p><strong>Honorific:</strong> {$user['honorific']}</p>
            <p><strong>Name:</strong> {$user['name']}</p>
            <p><strong>Father Name:</strong> {$user['father_name']}</p>
            <p><strong>Gender:</strong> {$user['gender']}</p>
            <p><strong>Email:</strong> {$user['email']}</p>
            <p><strong>CNIC:</strong> {$user['cnic']}</p>
            <p><strong>Employee Number:</strong> {$user['employee_number']}</p>
            <p><strong>Designation:</strong> {$user['designation']}</p>
            <p><strong>Contact Number:</strong> {$user['contact_number']}</p>
            <p><strong>Address:</strong> {$user['address']}</p>
            <p><strong>Qualification:</strong> {$user['qualification']}</p>";
    } else {
        echo "User not found.";
    }
}
?>
