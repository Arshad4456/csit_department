<?php
include 'db_connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $id = $_POST['id'];
    $honorific = $_POST['honorific'];
    $name = $_POST['name'];
    $fatherName = $_POST['father_name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $cnic = $_POST['cnic'];
    $employeeNumber = $_POST['employee_number'];
    $designation = $_POST['designation'];
    $contactNumber = $_POST['contact_number'];
    $address = $_POST['address'];
    $qualification = $_POST['qualification'];

    // Update query
    $query = "UPDATE users SET
              honorific = '$honorific',
              name = '$name',
              father_name = '$fatherName',
              gender = '$gender',
              email = '$email',
              cnic = '$cnic',
              employee_number = '$employeeNumber',
              designation = '$designation',
              contact_number = '$contactNumber',
              address = '$address',
              qualification = '$qualification'
              WHERE id = $id";

    // Execute query
    if (mysqli_query($conn, $query)) {
        // Redirect to the dashboard with success message
        header("Location: users_dashboard.php?status=success");
    } else {
        // Redirect to the dashboard with error message
        header("Location: users_dashboard.php?status=error");
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // If not a POST request, redirect to the dashboard
    header("Location: users_dashboard.php");
}
?>
