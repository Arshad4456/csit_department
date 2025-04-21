<?php
session_start();

// Connect to the database
$mysqli = new mysqli("localhost", "root", "", "csit_login_db");

if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_type = $_POST['user_type'] ?? '';
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($user_type) || empty($username) || empty($password)) {
        $error_message = "All fields are required.";
    } else {
        switch ($user_type) {
            case 'admin':
                $query = "SELECT id, password FROM admins WHERE email = ?";
                break;
            case 'monitor':
                $query = "SELECT id, password FROM monitors WHERE email = ?";
                break;
            case 'faculty':
                $query = "SELECT id, password FROM faculty WHERE email = ?";
                break;
            case 'student':
                $query = "SELECT id, password FROM students WHERE registration_no = ?";
                break;
            default:
                $error_message = "Invalid user type selected.";
                break;
        }

        if (empty($error_message)) {
            $stmt = $mysqli->prepare($query);
            if ($stmt) {
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();

                    // Check plain text password
                    if ($password === $user['password']) {
                        $_SESSION['user_type'] = $user_type;
                        $_SESSION['user_id'] = $user['id'];

                        // Redirect to respective dashboards
                        switch ($user_type) {
                            case 'admin':
                                header("Location: ../admin/admin_dashboard/admin_dashboard.php");
                                break;
                            case 'monitor':
                                header("Location: ../monitor/monitor_dashboard/monitor_dashboard.php");
                                break;
                            case 'faculty':
                                header("Location: ../faculty/faculty_dashboard.php");
                                break;
                            case 'student':
                                header("Location: ../student/student_dashboard.php");
                                break;
                            default:
                                header("Location: login.php"); // Fallback
                                break;
                        }
                        exit();
                    } else {
                        $error_message = "Invalid password.";
                    }
                } else {
                    $error_message = "Invalid username or user type.";
                }
                $stmt->close();
            } else {
                $error_message = "Failed to prepare the query.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Font Awesome for Eye Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        p {
            text-align: center;
            color: red;
        }
    </style>
</head>
<body>
    
    <?php if (!empty($error_message)): ?>
        <p><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>

    <form action="login.php" method="POST">
    <h2>User Login</h2>
        <label for="user_type">Select User Type:</label>
        <select id="user_type" name="user_type" class="form-control" required>
            <option value="">--Select--</option>
            <option value="admin">Admin</option>
            <option value="monitor">Monitor</option>
            <option value="faculty">Faculty</option>
            <option value="student">Student</option>
        </select><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" class="form-control" required><br>

        <label for="password">Password:</label>
        <div class="input-group mb-3">
            <input type="password" id="password" name="password" class="form-control" required>
            <div class="input-group-append">
                <span class="input-group-text" id="toggle-password">
                    <i class="fas fa-eye" id="eye-icon"></i>
                </span>
            </div>
        </div>
        <p>In case of password forget,contact to the department.</p>
        <button type="submit" class="btn btn-success btn-block">Login</button>
    </form>

    <script>
        document.getElementById('toggle-password').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        });
    </script>
</body>
</html>
