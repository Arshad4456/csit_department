<?php
include 'db_connection.php';

// Fetch services data
$result = mysqli_query($conn, "SELECT * FROM services ORDER BY id ASC");
?>

<section class="services section-padding" id="services">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center pb-5">
                    <h2>Our Services</h2>
                    <p>This is the services section, <br>which is provided to the users.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card text-white text-center bg-dark pb-2">
                    <div class="card-body">
                        <!-- Ensure icon_class is sanitized for security -->
                        <i class="bi bi-<?php echo htmlspecialchars($row['icon_class']); ?>"></i>
                        <h3 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h3>
                        <p class="lead"><?php echo htmlspecialchars($row['description']); ?></p>
                        <button class="btn bg-warning text-dark">
                            <a href="<?php echo htmlspecialchars($row['button_link']); ?>" class="text-decoration-none">
                            <?php echo htmlspecialchars($row['button_text']); // Display the button text ?>
                            </a>
                        </button>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
