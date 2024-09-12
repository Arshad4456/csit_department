<?php
$csit_host = 'localhost';
$csit_user = 'root';
$csit_password = ''; // Or your password
$csit_dbname = 'csit_login_db';

// Create connection
$csit_conn = new mysqli($csit_host, $csit_user, $csit_password, $csit_dbname);

// Check connection
if ($csit_conn->connect_error) {
    die("Connection failed: " . $csit_conn->connect_error);
}
?>
