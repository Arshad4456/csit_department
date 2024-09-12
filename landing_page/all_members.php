<?php
// Include database connection
include 'db_connection.php';

// Fetch all team members from the 'team_members' table
$query = "SELECT * FROM team_members";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Team Members</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="team section-padding" id="team">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center pb-5">
                    <h2>All Team Members</h2>
                    <p>Meet all our team members and their details.</p>
                </div>
            </div>
        </div>

        <div class="team-card-container">
            <div class="row">
                <?php
                // Loop through all team members and display them
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <!-- Display member image -->
                                <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>" class="img-fluid rounded-circle">

                                <!-- Display member name and position -->
                                <h3 class="card-title py-2"><?php echo $row['name']; ?></h3>
                                <h6><?php echo $row['position']; ?></h6>
                                <p class="card-text"><?php echo $row['description']; ?></p>

                                <!-- Social media links with icons -->
                                <p class="socials">
                                    <?php if (!empty($row['twitter_link'])) { ?>
                                        <a href="<?php echo $row['twitter_link']; ?>" target="_blank"><i class="bi bi-twitter text-dark mx-1"></i></a>
                                    <?php } ?>
                                    <?php if (!empty($row['facebook_link'])) { ?>
                                        <a href="<?php echo $row['facebook_link']; ?>" target="_blank"><i class="bi bi-facebook text-dark mx-1"></i></a>
                                    <?php } ?>
                                    <?php if (!empty($row['linkedin_link'])) { ?>
                                        <a href="<?php echo $row['linkedin_link']; ?>" target="_blank"><i class="bi bi-linkedin text-dark mx-1"></i></a>
                                    <?php } ?>
                                    <?php if (!empty($row['instagram_link'])) { ?>
                                        <a href="<?php echo $row['instagram_link']; ?>" target="_blank"><i class="bi bi-instagram text-dark mx-1"></i></a>
                                    <?php } ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
