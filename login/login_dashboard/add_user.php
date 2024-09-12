<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
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
    <div class="container mt-5">
        <h2>Add New User</h2>
        <form action="process_add_user.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group password-container">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <i class="fas fa-eye" id="togglePassword"></i>
            </div>
            <div class="form-group">
                <label for="user_type">User Type:</label>
                <select class="form-control" id="user_type" name="user_type" required>
                    <option value="admin">Admin</option>
                    <option value="faculty">Faculty</option>
                    <option value="student">Student</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add User</button>
        </form>
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
