<?php
// Include database connection
include('../../db_connection.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $user_type = $_POST['user_type']; // admin, monitor, faculty, student

    // Common fields for all user types
    $name = $_POST['name'];
    $father_name = $_POST['father_name'];
    $gender = $_POST['gender'];
    $cnic = $_POST['cnic'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // Additional fields for specific user types
    if ($user_type == 'admin' || $user_type == 'monitor' || $user_type == 'faculty') {
        $honorific = $_POST['honorific'];
        $employee_number = $_POST['employee_number'];
        $designation = $_POST['designation'];
        $qualification = $_POST['qualification'];
    }

    // Specific fields for students
    if ($user_type == 'student') {
        $registration_no = $_POST['registration_no'];
    }

    // Prepare SQL query based on user type
    if ($user_type == 'admin') {
        $sql = "INSERT INTO admins (name, father_name, gender, cnic, contact_number, address, email, password_hash, honorific, employee_number, designation, qualification) 
                VALUES ('$name', '$father_name', '$gender', '$cnic', '$contact_number', '$address', '$email', '$password', '$honorific', '$employee_number', '$designation', '$qualification')";
    } elseif ($user_type == 'monitor') {
        $sql = "INSERT INTO monitors (name, father_name, gender, cnic, contact_number, address, email, password_hash, honorific, employee_number, designation, qualification) 
                VALUES ('$name', '$father_name', '$gender', '$cnic', '$contact_number', '$address', '$email', '$password', '$honorific', '$employee_number', '$designation', '$qualification')";
    } elseif ($user_type == 'faculty') {
        $sql = "INSERT INTO faculty (name, father_name, gender, cnic, contact_number, address, email, password_hash, honorific, employee_number, designation, qualification) 
                VALUES ('$name', '$father_name', '$gender', '$cnic', '$contact_number', '$address', '$email', '$password', '$honorific', '$employee_number', '$designation', '$qualification')";
    } elseif ($user_type == 'student') {
        $sql = "INSERT INTO students (name, father_name, gender, cnic, registration_no, contact_no, address, email, password_hash) 
                VALUES ('$name', '$father_name', '$gender', '$cnic', '$registration_no', '$contact_number', '$address', '$email', '$password')";
    }

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "New user added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>
