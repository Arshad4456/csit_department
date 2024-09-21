<?php
include 'db_connection.php';

// Check if a file has been uploaded
if (isset($_FILES['csv_file'])) {
    $file = $_FILES['csv_file']['tmp_name'];

    // Open the file for reading
    if (($handle = fopen($file, 'r')) !== FALSE) {
        // Skip the header row
        fgetcsv($handle);

        while (($data = fgetcsv($handle)) !== FALSE) {
            // Assuming the CSV columns match the database columns
            list($user_type, $honorific, $name, $father_name, $gender, $cnic, $employee_number, $designation, $contact_number, $address, $qualification, $email, $password_hash) = $data;

            // Hash the password
            $password_hash = password_hash($password_hash, PASSWORD_DEFAULT);

            // Prepare SQL query
            $sql = "INSERT INTO users (user_type, honorific, name, father_name, gender, cnic, employee_number, designation, contact_number, address, qualification, email, password_hash) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            // Use prepared statement to prevent SQL injection
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("sssssssssssss", $user_type, $honorific, $name, $father_name, $gender, $cnic, $employee_number, $designation, $contact_number, $address, $qualification, $email, $password_hash);
            $stmt->execute();
        }

        fclose($handle);
        echo "Users added successfully!";
    } else {
        echo "Error opening the file.";
    }

    header("Location: users_dashboard.php");
}

// Close connection
$mysqli->close();
?>
