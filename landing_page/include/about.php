<?php
include 'db_connection.php';

// Fetch about section data from the database
$result = mysqli_query($conn, "SELECT * FROM about WHERE id=1");
$data = mysqli_fetch_assoc($result);

// Ensure variables are set to default values if not found
$title = isset($data['title']) ? htmlspecialchars($data['title']) : 'Default Title';
$content = isset($data['content']) ? htmlspecialchars($data['content']) : 'Default Content';
$image_url = isset($data['image_url']) ? htmlspecialchars($data['image_url']) : 'img/default_image.jpg'; // Replace with a default image path if needed
$learn_more_link = isset($data['learn_more_link']) ? htmlspecialchars($data['learn_more_link']) : '#';
?>

<section id="about" class="about section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-12">
                <div class="about-img">
                    <img src="<?php echo $image_url; ?>" alt="About Image" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-12 ps-lg-5 mt-md-5">
                <div class="about-text">
                    <h2><?php echo $title; ?></h2>
                    <h1>Message</h1>
                    <p><?php echo $content; ?></p>
                    <a href="<?php echo $learn_more_link; ?>" class="btn btn-warning">Get More Information</a>
                </div>
            </div>
        </div>
    </div>
</section>
