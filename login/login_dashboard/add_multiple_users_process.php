<?php
// Include database connection
include 'db_connection.php';

if (isset($_FILES['file']['tmp_name'])) {
    $file = $_FILES['file']['tmp_name'];

    $handle = fopen($file, "r");

    if ($handle) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Assuming CSV columns match your table structure: user_type, honorific, name, etc.
            $user_type = $data[0];
            $honorific = $data[1];
            $name = $data[2];
            $father_name = $data[3];
            $gender = $data[4];
            $password_hash = password_hash($data[5], PASSWORD_BCRYPT);
            $email = $data[6];
            $cnic = $data[7];
            $employee_number = $data[8];
            $designation = $data[9];
            $contact_number = $data[10];
            $address = $data[11];
            $qualification = $data[12];

            $sql = "INSERT INTO users (user_type, honorific, name, father_name, gender, password_hash, email, cnic, employee_number, designation, contact_number, address, qualification) 
                    VALUES ('$user_type', '$honorific', '$name', '$father_name', '$gender', '$password_hash', '$email', '$cnic', '$employee_number', '$designation', '$contact_number', '$address', '$qualification')";

            mysqli_query($conn, $sql);
        }
        fclose($handle);
        header("Location: users_dashboard.php?message=UsersUploaded");
    }
}
?>
