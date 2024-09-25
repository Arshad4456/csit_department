<?php
include 'db_connection.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_type = $_POST['csv_user_type'];
    $csv_file = $_FILES['csv_file']['tmp_name'];

    if (($handle = fopen($csv_file, "r")) !== false) {
        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            if ($user_type == 'student') {
                // Columns: name, father_name, cnic, program, registration_no, batch, email, password_hash
                $query = "INSERT INTO students (name, father_name, cnic, program, registration_no, batch, email, password_hash)
                          VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]', '".password_hash($data[7], PASSWORD_DEFAULT)."')";
            } else {
                // Columns: name, designation, email, password_hash
                $query = "INSERT INTO $user_type (name, designation, email, password_hash)
                          VALUES ('$data[0]', '$data[1]', '$data[2]', '".password_hash($data[3], PASSWORD_DEFAULT)."')";
            }

            $mysqli->query($query);
        }
        fclose($handle);
        header("Location: ../users_dashboard.php?success=1");
    } else {
        echo "Error opening CSV file.";
    }
}
?>
