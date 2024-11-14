<?php
// Start session and include database connection
session_start();
include 'db_connection.php'; // Ensure you have a file to connect to your database

// Fetch dynamic data from the database
$query = "SELECT * FROM navbar_links";
$result = mysqli_query($conn, $query);
$links = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS/IT Department</title>

    <!-- All CSS -->
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css"> -->
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><span class="suit">SUIT</span> Peshawar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php foreach ($links as $link): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= htmlspecialchars($link['url']); ?>"><?= htmlspecialchars($link['name']); ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <form class="d-flex ms-3">
                
                    <button class="btn btn-outline-success" type="submit">ask me about Department</button>
                
                </form>

                <!-- <div class="dropdown ms-3">
                    <button type="button" class="dropbtn" onclick="toggleDropdown()">My Account</button>
                    <div id="myDropdown" class="dropdown-content">
                        <a href="#">Profile</a>
                        <a href="#">Settings</a>
                        <a href="#">Log out</a>
                    </div>
                </div> -->
            </div>
        </div>
    </nav>

   
