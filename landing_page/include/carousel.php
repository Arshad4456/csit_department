<?php
include 'db_connection.php';

// Fetch carousel data from database
$result = mysqli_query($conn, "SELECT * FROM carousel ORDER BY id ASC");
?>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'.$i.'"';
            if ($i == 0) echo ' class="active" aria-current="true"';
            echo ' aria-label="Slide '.($i + 1).'"></button>';
            $i++;
        }
        ?>
    </div>
    <div class="carousel-inner">
        <?php
        mysqli_data_seek($result, 0); // Reset pointer
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="carousel-item';
            if ($i == 1) echo ' active';
            echo '">';
            echo '<img src="'.$row['image_url'].'" class="d-block w-100" alt="...">';
            echo '<div class="carousel-caption">';
            echo '<h5>'.$row['caption_title'].'</h5>';
            echo '<p>'.$row['caption_text'].'</p>';
            echo '<p><a href="'.$row['button_link'].'" class="btn btn-warning mt-3">'.$row['button_text'].'</a></p>';
            echo '</div></div>';
            $i--;
        }
        ?>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
