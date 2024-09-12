<?php
include 'db_connection.php';

// Fetch contact email data
$result = mysqli_query($conn, "SELECT * FROM contact WHERE id=1");
$data = mysqli_fetch_assoc($result);
?>

<section id="contact" class="contact section-padding">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center pb-5">
                    <h2>Contact Us</h2>
                    <p>If you have any doubt, contact us through;<br><?php echo htmlspecialchars($data['email']); ?></p>
                </div>
            </div>
        </div>
        <div class="row m-0">
            <div class="col-md-12 p-0 pt-4 pb-4">
                <form action="include/contact_process.php" method="POST" class="bg-light p-4 m-auto">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <input class="form-control" placeholder="Full Name" name="full_name" required="" type="text">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <input class="form-control" placeholder="Email" name="email" required="" type="email">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <textarea class="form-control" placeholder="Message" name="message" required="" rows="3"></textarea>
                            </div>
                        </div>
                        <button class="btn btn-warning btn-lg btn-block mt-3" type="submit">Send Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
