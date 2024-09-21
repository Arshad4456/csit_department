<?php
session_start(); // Start the session
include 'db_connection.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user data from POST
    $user_id = $mysqli->real_escape_string($_POST['user_id']);
    $user_type = $mysqli->real_escape_string($_POST['user_type']);
    $honorific = $mysqli->real_escape_string($_POST['honorific']);
    $name = $mysqli->real_escape_string($_POST['name']);
    $father_name = $mysqli->real_escape_string($_POST['father_name']);
    $gender = $mysqli->real_escape_string($_POST['gender']);
    $cnic = $mysqli->real_escape_string($_POST['cnic']);
    $employee_number = $mysqli->real_escape_string($_POST['employee_number']);
    $designation = $mysqli->real_escape_string($_POST['designation']);
    $contact_number = $mysqli->real_escape_string($_POST['contact_number']);
    $address = $mysqli->real_escape_string($_POST['address']);
    $qualification = $mysqli->real_escape_string($_POST['qualification']);
    $email = $mysqli->real_escape_string($_POST['email']);
    
    // Update user in the database
    $sql = "UPDATE users SET user_type='$user_type', honorific='$honorific', name='$name', father_name='$father_name', gender='$gender', cnic='$cnic', employee_number='$employee_number', designation='$designation', contact_number='$contact_number', address='$address', qualification='$qualification', email='$email' WHERE id='$user_id'";

    if ($mysqli->query($sql) === TRUE) {
        // Set success message
        $_SESSION['success_message'] = "User updated successfully!";
        // Redirect to users_dashboard.php
        header("Location: users_dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    // Close connection
    $mysqli->close();
}
?>
