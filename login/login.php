<?php
session_start();
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userType = $_POST['user_type'];
    $password = $_POST['password'];

    // Check if the user is admin, faculty, or monitor and use email for login
    if ($userType === 'admin' || $userType === 'faculty' || $userType === 'monitor') {
        $email = $_POST['email'];

        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND user_type = ?");
        $stmt->bind_param("ss", $email, $userType);
    } elseif ($userType === 'student') {
        // For students, use registration_no for login
        $registration_no = $_POST['registration_no'];

        // Prepare the SQL statement for student login
        $stmt = $conn->prepare("SELECT * FROM users WHERE registration_no = ? AND user_type = ?");
        $stmt->bind_param("ss", $registration_no, $userType);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password_hash'])) {
        // Store the user's data in the session
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'] ?? null; // For admin/faculty/monitor
        $_SESSION['registration_no'] = $user['registration_no'] ?? null; // For students
        $_SESSION['user_type'] = $user['user_type'];

        // Redirect based on user type
        if ($userType === 'admin') {
            header('Location: ../admin/admin_dashboard/admin_dashboard.php');
        } elseif ($userType === 'faculty') {
            header('Location: ../faculty/faculty_dashboard.php');
        } elseif ($userType === 'monitor') {
            header('Location: ../monitor/monitor_dashboard.php');
        } elseif ($userType === 'student') {
            header('Location: ../student/student_log.php');
        }
        exit();
    } else {
        $error_message = "Invalid login credentials. Please try again.";
    }

    $stmt->close();
}

$conn->close();
?>
