<?php
include '../db_connection.php';

if (isset($_POST['user_id']) && isset($_POST['user_type'])) {
    $id = intval($_POST['user_id']);
    $type = $_POST['user_type'];

    $table = match ($type) {
        'admin' => 'admins',
        'monitor' => 'monitors',
        'faculty' => 'faculty',
        'student' => 'students',
        default => exit('Invalid user type.'),
    };

    $result = $mysqli->query("SELECT * FROM $table WHERE id = $id");
    if ($result && $user = $result->fetch_assoc()) {
        echo "<div class='modal fade' id='editUserModal' tabindex='-1' role='dialog'>
            <div class='modal-dialog' role='document'>
            <form method='POST' action='backend/edit_user.php'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title'>Edit User</h5>
                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>
                    <div class='modal-body'>";
        
        echo "<input type='hidden' name='user_id' value='{$user['id']}'>";
        echo "<input type='hidden' name='user_type' value='{$type}'>";

        foreach ($user as $key => $value) {
            if (in_array($key, ['id', 'password_hash'])) continue;
            echo "<div class='form-group'>
                    <label>" . ucfirst(str_replace("_", " ", $key)) . "</label>
                    <input type='text' name='{$key}' class='form-control' value='{$value}'>
                  </div>";
        }

        echo "    </div>
                    <div class='modal-footer'>
                        <button type='submit' class='btn btn-success'>Update</button>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
                    </div>
                </div>
            </form>
            </div>
        </div>";
    } else {
        echo "User not found.";
    }
}
?>
