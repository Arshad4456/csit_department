<?php
$conn = new mysqli('localhost', 'root', '', 'csit_login_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Add User
    if (isset($_FILES['excelFile']) && $_FILES['excelFile']['error'] == UPLOAD_ERR_OK) {
        // Import users from Excel file
        require 'vendor/autoload.php'; // Ensure PHPExcel or PhpSpreadsheet library is included
        $fileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($_FILES['excelFile']['tmp_name']);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($fileType);
        $spreadsheet = $reader->load($_FILES['excelFile']['tmp_name']);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray();

        foreach ($data as $row) {
            $name = $conn->real_escape_string($row[0]);
            $email = $conn->real_escape_string($row[1]);
            // Add other fields as needed

            $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
            $conn->query($sql);
        }

        $response['message'] = 'Users imported successfully';
    } else if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Add User
        if ($action == 'add_user') {
            $name = $conn->real_escape_string($_POST['name']);
            $email = $conn->real_escape_string($_POST['email']);
            // Add other fields as needed

            $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
            if ($conn->query($sql) === TRUE) {
                $response['message'] = 'User added successfully';
            } else {
                $response['message'] = 'Error: ' . $conn->error;
            }

        // Update User
        } else if ($action == 'update_user') {
            parse_str($_POST['data'], $data);
            $id = $conn->real_escape_string($data['id']);
            $name = $conn->real_escape_string($data['name']);
            $email = $conn->real_escape_string($data['email']);
            // Update other fields as needed

            $sql = "UPDATE users SET name='$name', email='$email' WHERE ID='$id'";
            if ($conn->query($sql) === TRUE) {
                $response['message'] = 'User updated successfully';
            } else {
                $response['message'] = 'Error: ' . $conn->error;
            }

        // Delete User
        } else if ($action == 'delete_user') {
            $id = $conn->real_escape_string($_POST['id']);
            $sql = "DELETE FROM users WHERE ID='$id'";
            if ($conn->query($sql) === TRUE) {
                $response['message'] = 'User deleted successfully';
            } else {
                $response['message'] = 'Error: ' . $conn->error;
            }

        // Fetch User
        } else if ($action == 'fetch_user') {
            $id = $conn->real_escape_string($_POST['id']);
            $sql = "SELECT * FROM users WHERE ID='$id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $response = $result->fetch_assoc();
            } else {
                $response['message'] = 'User not found';
            }
        }
    }
}

$conn->close();
echo json_encode($response);
?>
