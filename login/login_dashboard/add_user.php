<?php
// Include database connection
include 'db_connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_type = $_POST['user_type'];
    $honorific = $_POST['honorific'];
    $name = $_POST['name'];
    $father_name = $_POST['father_name'];
    $gender = $_POST['gender'];
    $password_hash = password_hash($_POST['password_hash'], PASSWORD_BCRYPT);
    $email = $_POST['email'];
    $cnic = $_POST['cnic'];
    $employee_number = $_POST['employee_number'];
    $designation = $_POST['designation'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];
    $qualification = $_POST['qualification'];

    // Insert into database
    $sql = "INSERT INTO users (user_type, honorific, name, father_name, gender, password_hash, email, cnic, employee_number, designation, contact_number, address, qualification) 
            VALUES ('$user_type', '$honorific', '$name', '$father_name', '$gender', '$password_hash', '$email', '$cnic', '$employee_number', '$designation', '$contact_number', '$address', '$qualification')";

    if (mysqli_query($conn, $sql)) {
        header("Location: users_dashboard.php?message=UserAdded");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
