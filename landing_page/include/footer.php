<?php
// Start session and include database connection
// session_start();
include 'db_connection.php'; // Ensure you have a file to connect to your database

// Fetch dynamic data from the database
$query = "SELECT * FROM footer_info";
$result = mysqli_query($conn, $query);
$footer = mysqli_fetch_assoc($result);
?>

<footer class="bg-dark p-2 text-center">
    <div class="container">
        <p class="text-white"><?= htmlspecialchars($footer['text']); ?></p>
    </div>
</footer>


</body>
</html>