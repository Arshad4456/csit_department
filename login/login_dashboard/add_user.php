<?php
session_start(); // Start the session
include 'db_connection.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user data from POST
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
    $password_hash = password_hash($mysqli->real_escape_string($_POST['password_hash']), PASSWORD_DEFAULT);

    // Insert user into the database
    $sql = "INSERT INTO users (user_type, honorific, name, father_name, gender, cnic, employee_number, designation, contact_number, address, qualification, email, password_hash) VALUES ('$user_type', '$honorific', '$name', '$father_name', '$gender', '$cnic', '$employee_number', '$designation', '$contact_number', '$address', '$qualification', '$email', '$password_hash')";

    if ($mysqli->query($sql) === TRUE) {
        // Set success message
        $_SESSION['success_message'] = "New user added successfully!";
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
