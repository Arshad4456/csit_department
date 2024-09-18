<?php
// Include database connection
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
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

    $sql = "UPDATE users SET user_type='$user_type', honorific='$honorific', name='$name', father_name='$father_name', gender='$gender', password_hash='$password_hash', 
            email='$email', cnic='$cnic', employee_number='$employee_number', designation='$designation', contact_number='$contact_number', address='$address', 
            qualification='$qualification' WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: users_dashboard.php?message=UserUpdated");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
