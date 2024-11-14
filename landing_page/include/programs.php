<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/style.css"> -->
<?php
include 'db_connection.php';

// Fetch programs data
$result = mysqli_query($conn, "SELECT * FROM programs ORDER BY id ASC");
?>

<section  class="programs section-padding"  id="programs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center pb-5">
                    <h2>Programs</h2>
                    <p>The followings are the programs which are available for students in our CS/IT Department.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-12 col-md-12 col-lg-4">
                <div class="card text-light text-center bg-white pb-2">
                    <div class="card-body text-dark">
                        <!-- Display image first -->
                        <div class="img-area mb-4">
                            <img src="<?php echo htmlspecialchars($row['image_url']); ?>" class="img-fluid" alt="">
                        </div>
                        <!-- Display program name -->
                        <h3 class="card-title"><?php echo htmlspecialchars($row['program_name']); ?></h3>
                        <!-- Display button -->
                        <!-- <button class="btn bg-warning text-dark">
                            <a href="<?php echo htmlspecialchars($row['button_link']); ?>" class="text-decoration-none"><?php echo htmlspecialchars($row['button_text']); ?></a>
                        </button> -->
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- 
<script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/script.js"></script> -->