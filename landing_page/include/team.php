<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css"> -->
    <?php
    include 'db_connection.php'; // Ensure you have the DB connection here

    $query = "SELECT * FROM team_members LIMIT 8";
    $result = mysqli_query($conn, $query);
?>

<section class="team section-padding" id="team">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center pb-5">
                    <h2>Faculty Members</h2>
                    <p>Details about Our Dear Faculty Members individually.</p>
                </div>
            </div>
        </div>

        <div class="team-card-container">
            <div class="row">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <!-- Display image -->
                                <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>" class="img-fluid rounded-circle">
                                <h3 class="card-title py-2"><?php echo $row['name']; ?></h3>
                                <h6><?php echo $row['position']; ?></h6><br>
                                <p class="card-text"><?php echo $row['description']; ?></p>
                                <br>
                                <!-- Social Icons with links -->
                                <p class="socials">
                                    <?php if ($row['twitter_link']) { ?>
                                        <a href="<?php echo $row['twitter_link']; ?>" target="_blank"><i class="bi bi-twitter text-dark mx-1"></i></a>
                                    <?php } ?>
                                    
                                    <?php if ($row['facebook_link']) { ?><a href="<?php echo $row['facebook_link']; ?>" target="_blank"><i class="bi bi-facebook text-dark mx-1"></i></a>
                                    <?php } ?>

                                    <?php if ($row['linkedin_link']) { ?><a href="<?php echo $row['linkedin_link']; ?>" target="_blank"><i class="bi bi-linkedin text-dark mx-1"></i></a>
                                    <?php } ?>

                                    <?php if ($row['instagram_link']) { ?>
                                        <a href="<?php echo $row['instagram_link']; ?>" target="_blank"><i class="bi bi-instagram text-dark mx-1"></i></a>
                                    <?php } ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- Button to go to all members -->
        <div class="text-center">
            <a href="all_members.php" class="btn btn-primary mt-4">Show All Members</a>
        </div>
    </div>
</section>

<!-- 
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/script.js"></script> -->