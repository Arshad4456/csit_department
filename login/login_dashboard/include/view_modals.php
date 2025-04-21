<?php
include '../db_connection.php';

if (isset($_POST['user_id']) && isset($_POST['user_type'])) {
    $id = intval($_POST['user_id']);
    $type = $_POST['user_type'];

    $table = "";
    switch ($type) {
        case 'admin': $table = 'admins'; break;
        case 'monitor': $table = 'monitors'; break;
        case 'faculty': $table = 'faculty'; break;
        case 'student': $table = 'students'; break;
        default: exit("Invalid user type.");
    }

    $result = $mysqli->query("SELECT * FROM $table WHERE id = $id");
    if ($result && $user = $result->fetch_assoc()) {
        // echo "<p><strong>Name:</strong> {$user['name']}</p>";   
        // echo "<p><strong>Email:</strong> {$user['email']}</p>";


        if ($type == 'admin') {
            echo "<p><strong>User Type:</strong> " . $user['user_type'] . "</p>";
            echo "<p><strong>Honorific:</strong> " . $user['honorific'] . "</p>";
            echo "<p><strong>Name:</strong> " . $user['name'] . "</p>";
            echo "<p><strong>Father Name:</strong> " . $user['father_name'] . "</p>";
            echo "<p><strong>Gender:</strong> " . $user['gender'] . "</p>";
            echo "<p><strong>CNIC:</strong> " . $user['cnic'] . "</p>";
            echo "<p><strong>Employee Number:</strong> " . $user['employee_number'] . "</p>";
            echo "<p><strong>Designation:</strong> " . $user['designation'] . "</p>";
            echo "<p><strong>Contact Number:</strong> " . $user['contact_number'] . "</p>";
            echo "<p><strong>Address:</strong> " . $user['address'] . "</p>";
            echo "<p><strong>Qualification:</strong> " . $user['qualification'] . "</p>";
            echo "<p><strong>Email:</strong> " . $user['email'] . "</p>";
            echo "<p><strong>Password:</strong> " . $user['password'] . "</p>";
        }
    
        // Displaying information for faculty user type
        elseif ($type == 'faculty') {
            echo "<p><strong>Honorific:</strong> " . $user['honorific'] . "</p>";
            echo "<p><strong>Name:</strong> " . $user['name'] . "</p>";
            echo "<p><strong>Father Name:</strong> " . $user['father_name'] . "</p>";
            echo "<p><strong>Gender:</strong> " . $user['gender'] . "</p>";
            echo "<p><strong>CNIC:</strong> " . $user['cnic'] . "</p>";
            echo "<p><strong>Employee Number:</strong> " . $user['employee_number'] . "</p>";
            echo "<p><strong>Designation:</strong> " . $user['designation'] . "</p>";
            echo "<p><strong>Contact Number:</strong> " . $user['contact_number'] . "</p>";
            echo "<p><strong>Address:</strong> " . $user['address'] . "</p>";
            echo "<p><strong>Qualification:</strong> " . $user['qualification'] . "</p>";
            echo "<p><strong>Email:</strong> " . $user['email'] . "</p>";
            echo "<p><strong>Password:</strong> " . $user['password'] . "</p>";
        }

        // Displaying information for monitor user type
        elseif ($type == 'monitor') {
            echo "<p><strong>Honorific:</strong> " . $user['honorific'] . "</p>";
            echo "<p><strong>Name:</strong> " . $user['name'] . "</p>";
            echo "<p><strong>Father Name:</strong> " . $user['father_name'] . "</p>";
            echo "<p><strong>Gender:</strong> " . $user['gender'] . "</p>";
            echo "<p><strong>CNIC:</strong> " . $user['cnic'] . "</p>";
            echo "<p><strong>Employee Number:</strong> " . $user['employee_number'] . "</p>";
            echo "<p><strong>Designation:</strong> " . $user['designation'] . "</p>";
            echo "<p><strong>Contact Number:</strong> " . $user['contact_number'] . "</p>";
            echo "<p><strong>Address:</strong> " . $user['address'] . "</p>";
            echo "<p><strong>Qualification:</strong> " . $user['qualification'] . "</p>";
            echo "<p><strong>Email:</strong> " . $user['email'] . "</p>";
            echo "<p><strong>Password:</strong> " . $user['password'] . "</p>";
        }
    
        
        // Displaying information for student user type
        elseif ($type === 'student') {
            // Display user information in the modal
    echo "<p><strong>Name:</strong> " . $user['name'] . "</p>";
    echo "<p><strong>Father Name:</strong> " . $user['father_name'] . "</p>";
    echo "<p><strong>Gender:</strong> " . $user['gender'] . "</p>";
    echo "<p><strong>CNIC:</strong> " . $user['cnic'] . "</p>";
    echo "<p><strong>Registration No:</strong> " . $user['registration_no'] . "</p>";
    echo "<p><strong>Contact No:</strong> " . $user['contact_no'] . "</p>";
    echo "<p><strong>Address:</strong> " . $user['address'] . "</p>";
    echo "<p><strong>Email:</strong> " . $user['email'] . "</p>";
    echo "<p><strong>Program:</strong> " . $user['program'] . "</p>";
    echo "<p><strong>Batch:</strong> " . $user['batch'] . "</p>";
    echo "<p><strong>Password:</strong> " . $user['password'] . "</p>";
        }

    } else {
        echo "User not found.";
    }
}
?>
