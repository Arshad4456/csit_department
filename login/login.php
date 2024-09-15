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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    body {
      background-color: #f8f9fa;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .login-form {
      max-width: 400px;
      width: 100%;
      background: #fff;
      padding: 30px;
      border-radius: 5px;
      box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    }
    .login-form h2 {
      text-align: center;
      margin-bottom: 30px;
    }
    .password-container {
      position: relative;
    }
    .password-container input {
      width: 100%;
      padding-right: 40px;
    }
    .password-container .fa-eye {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #2c3be3;
    }
    .alert {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="login-form">
      <h2>Login</h2>
      <?php if (isset($error_message)) { echo '<div class="alert alert-danger">' . $error_message . '</div>'; } ?>
      <form action="login.php" method="post">
        <div class="form-group">
          <label for="userType">User Type:</label>
          <select class="form-control" id="userType" name="user_type" required>
            <option value="" disabled selected>Select User Type</option>
            <option value="admin">Administration</option>
            <option value="faculty">Faculty Member</option>
            <option value="student">Student</option>
            <option value="monitor">Monitor</option>
          </select>
        </div>
        <div class="form-group" id="emailOrRegNo">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group" id="registrationNo" style="display: none;">
          <label for="registration_no">Registration Number:</label>
          <input type="text" class="form-control" id="registration_no" name="registration_no">
        </div>
        <div class="form-group password-container">
          <label for="password">Password:</label>
          <input type="password" class="form-control" id="password" name="password" required>
          <i class="fas fa-eye" id="togglePassword"></i>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
      </form>
    </div>
  </div>

  <script>
    document.getElementById("togglePassword").addEventListener("click", function() {
      var passwordField = document.getElementById("password");
      var type = passwordField.getAttribute("type") === "password" ? "text" : "password";
      passwordField.setAttribute("type", type);
      this.classList.toggle("fa-eye-slash");
    });

    document.getElementById("userType").addEventListener("change", function() {
      var userType = this.value;
      var emailOrRegNo = document.getElementById("emailOrRegNo");
      var registrationNo = document.getElementById("registrationNo");

      if (userType === 'student') {
        emailOrRegNo.style.display = "none";
        registrationNo.style.display = "block";
      } else {
        emailOrRegNo.style.display = "block";
        registrationNo.style.display = "none";
      }
    });
  </script>
</body>
</html>
