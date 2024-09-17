<?php
include 'db_connection.php';
// require 'vendor/autoload.php'; // For PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['excelFile']) && $_FILES['excelFile']['error'] == UPLOAD_ERR_OK) {
        // Process Excel file
        $filePath = $_FILES['excelFile']['tmp_name'];
        // $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray();

        foreach ($data as $row) {
            if (!empty($row[0])) { // Check if row has data
                $honorific = mysqli_real_escape_string($conn, $row[0]);
                $name = mysqli_real_escape_string($conn, $row[1]);
                $father_name = mysqli_real_escape_string($conn, $row[2]);
                $gender = mysqli_real_escape_string($conn, $row[3]);
                $email = mysqli_real_escape_string($conn, $row[4]);
                $cnic = mysqli_real_escape_string($conn, $row[5]);
                $employee_number = mysqli_real_escape_string($conn, $row[6]);
                $designation = mysqli_real_escape_string($conn, $row[7]);
                $contact_number = mysqli_real_escape_string($conn, $row[8]);
                $address = mysqli_real_escape_string($conn, $row[9]);
                $qualification = mysqli_real_escape_string($conn, $row[10]);

                $query = "INSERT INTO users (honorific, name, father_name, gender, email, cnic, employee_number, designation, contact_number, address, qualification) VALUES ('$honorific', '$name', '$father_name', '$gender', '$email', '$cnic', '$employee_number', '$designation', '$contact_number', '$address', '$qualification')";
                mysqli_query($conn, $query);
            }
        }
    } else {
        // Insert single user
        $honorific = mysqli_real_escape_string($conn, $_POST['honorific']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $father_name = mysqli_real_escape_string($conn, $_POST['father_name']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $cnic = mysqli_real_escape_string($conn, $_POST['cnic']);
        $employee_number = mysqli_real_escape_string($conn, $_POST['employee_number']);
        $designation = mysqli_real_escape_string($conn, $_POST['designation']);
        $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $qualification = mysqli_real_escape_string($conn, $_POST['qualification']);

        $query = "INSERT INTO users (honorific, name, father_name, gender, email, cnic, employee_number, designation, contact_number, address, qualification) VALUES ('$honorific', '$name', '$father_name', '$gender', '$email', '$cnic', '$employee_number', '$designation', '$contact_number', '$address', '$qualification')";
        mysqli_query($conn, $query);
    }

    header("Location: users_dashboard.php?status=success");
}
?>
