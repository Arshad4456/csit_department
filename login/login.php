<?php
session_start();
include('login_dashboard/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userType = $_POST['user_type'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND user_type = ?");
    $stmt->bind_param("ss", $username, $userType);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password_hash'])) {
        // Store the user's data in the session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_type'] = $user['user_type'];

        // Redirect based on user type
        if ($userType === 'admin') {
            header('Location: ../admin/admin_dashboard/admin_dashboard.php');
        } elseif ($userType === 'faculty') {
            header('Location: ../faculty/faculty_dashboard.php');
        } elseif ($userType === 'student') {
            header('Location: ../student/student_log.php');
        }
        exit();
    } else {
        $error_message = "Invalid username or password. Please try again.";
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
    }
    .login-form {
      max-width: 400px;
      margin: 50px auto;
      background: #fff;
      padding: 30px;
      border-radius: 5px;
      box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
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
      top: 73%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #2c3be3;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
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
              </select>
            </div>
            <div class="form-group">
              <label for="username">Username:</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group password-container">
              <label for="password">Password:</label>
              <input type="password" class="form-control" id="password" name="password" required>
              <i class="fas fa-eye" id="togglePassword"></i>
            </div>
            <div class="checkbox mb-3">
              <label>
                <input type="checkbox" value="remember-me"> Remember me
              </label>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById("togglePassword").addEventListener("click", function() {
      var passwordField = document.getElementById("password");
      var type = passwordField.getAttribute("type") === "password" ? "text" : "password";
      passwordField.setAttribute("type", type);
      this.classList.toggle("fa-eye-slash");
    });
  </script>
</body>
</html>
