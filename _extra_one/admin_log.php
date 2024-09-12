<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS/IT Department</title>

    <!-- All CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
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
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#programs">Programs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#team">Faculty</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    
                </ul>
                <!-- Search form -->
                <form class="d-flex">
                    <button class="btn btn-outline-success" type="submit" id="openPageButton">Search</button>
<div id="chatContainer"></div>

                    <div class="dropdown">
                        <!-- <a class="nav-link" href="#">My Account</a> -->
                        <button type="button" onclick="toggleDropdown()" class="dropbtn">My Account</button>
                        <div id="myDropdown" class="dropdown-content">
                            <a href="../admin/admin_dashboard/admin_dashboard.php">My Dashboard</a>
                            <a href="https://console.dialogflow.com/api-client/demo/embedded/a7bd3d7d-150d-4ef2-aedb-839496fbdd7d">ask me</a>
                            <a href="#">profile</a>
                            <a href="#">Setting</a>
                            <a href="#">Log out</a>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </nav>




    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/carousal1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <h5>Welcome to the CS/IT Department</h5>
                    <p>A comprehensive SUIT CS/IT Department website</p>
                    <p><a href="#" class="btn btn-warning mt-3">Learn More</a></p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/carousal2.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <h5>Welcome to the CS/IT Department</h5>
                    <p>A comprehensive SUIT CS/IT Department website</p>
                    <p><a href="#" class="btn btn-warning mt-3">Learn More</a></p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/carousal3.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <h5>Welcome to the CS/IT Department</h5>
                    <p>A comprehensive SUIT CS/IT Department website</p>
                    <p><a href="#" class="btn btn-warning mt-3">Learn More</a></p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- about section starts -->
    <section id="about" class="about section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="about-img">
                        <img src="img/Dean_pic2.jpg" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-12 ps-lg-5 mt-md-5">
                    <div class="about-text">
                        <h2>Dean's</h2>
                        <h1>Message</h1>
                        <p>It is my immense pleasure to welcome the prospective students of Sarhad University of Science & Information Technology, Peshawar, especially those who are about to join my Faculty in the year 2022-2023. I believe that higher education is one of the key elements for economic and social development of a country It is also a proven fact that no country has been developed without investing its capital in human resource development in the form of higher education. Institutions of higher education are responsible to play a key role in achieving it. The Universities equip individuals with advance knowledge and skills required for professional leadership in Government, Business and Industry. It is also important to develop new technology but it is equally important to apply technology to our industry to improve quality of productivity and quality of the lives of common people. Sarhad University of Science and Information Technology, Peshawar among its aims and objectives have provision for skills based education. In the Faculty of Sciences, Computer Science and Information Technology, besides basic Sciences, we have programs which are of applied nature related to Information Technologies.
                            These Programs are of Electronics, Telecommunication, Computer Science, Software Engineering, Computer Engineering Technology and Chemistry where we offer BS, MSc, MS and Ph.D degree programs. The rapid development in the means of communication and digital revolution has changed the world into a global village in a real sense. The economies are globalized and internationalized, irrespective of the I.T.O rules. Even the cultural exchanges are taking places without the exchange of people through international boundaries. In this era of internationalization, the importance of institutions of the higher education related to High Tech has increased to a wider range. At Sarhad University, we are very conscious of this fact. The globalization on one hand requires the professionalism of international standard in Technology use and on the other hand multicultural personality growth. At SUIT we care for all the above aspects and we designed our courses which provide opportunity for skill development futuristic to build upon and social grooming to care for humanity.I am sure that your choice of Faculty of Science in SUIT will be a success story of your future because knowledge and information are power. At Sarhad University of Science and Information Technology we will empower you with knowledge and keep you informed.I am confident that choice of your joining this Institution will make you a beacon of light to those interested in seeking quality technical education.</p>
                        <a href="#" class="btn btn-warning">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about section Ends -->

    <!-- services section Starts -->
    <section class="services section-padding" id="services">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-5">
                        <h2>Our Services</h2>
                        <p>This is the services ,  <br>which is provided to the users.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-white text-center bg-dark pb-2 ">
                        <div class="card-body">
                            <i class="bi bi-laptop"></i>
                            <h3 class="card-title">Enrollement</h3>
                            <p class="lead">Through Enrollement Form , Students can enroll in their fail or lower grade subjects</p>
                            <button class="btn bg-warning text-dark"><a href="admin_dashboard/enrollment_dashboard/enrollment_form.php" class="text-decoration-none">Apply</a></button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-white text-center bg-dark pb-2">
                        <div class="card-body">
                            <i class="bi bi-journal"></i>
                            <h3 class="card-title">Leave Application</h3>
                            <p class="lead">The students and faculty can submit thier application for leave/leaves.</p>
                            <button class="btn bg-warning text-dark"><a href="admin_dashboard/leave_dashboard/Leave.php" class="text-decoration-none">Application Form</a></button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-white text-center bg-dark pb-2">
                        <div class="card-body">
                            <i class="bi bi-intersect"></i>
                            <h3 class="card-title">GPA Calculation</h3>
                            <p class="lead">The students can calculate thier gpa for improving thier total gpa.</p>
                            <button class="btn bg-warning text-dark"><a href="../GPA_Predictions/GPA_Predictions.html" class="text-decoration-none">Predict Your GPA Here</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- services section Ends -->

    <!-- programs starts -->
    <section id="programs" class="program section-padding">
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
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-light text-center bg-white pb-2">
                        <div class="card-body text-dark">
                            <div class="img-area mb-4">
                                <img src="img/Bs_ComputerScience.jpg" class="img-fluid" alt="">
                            </div>
                            <h3 class="card-title">Bachelor of Science in Computer Science</h3>
                            <p class="lead">Detail about this program,click on learn more</p>
                            <button class="btn bg-warning text-dark">Learn More</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-light text-center bg-white pb-2">
                        <div class="card-body text-dark">
                            <div class="img-area mb-4">
                                <img src="img/Bs_SoftwareEngineering.jpg" class="img-fluid" alt="">
                            </div>
                            <h3 class="card-title">Bachelor of Science in Software Engineering</h3>
                            <p class="lead">Detail about this program,click on learn more</p>
                            <button class="btn bg-warning text-dark">learn More</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-light text-center bg-white pb-2">
                        <div class="card-body text-dark">
                            <div class="img-area mb-4">
                                <img src="img/Bs_ArtificialIntelligence.jpg" class="img-fluid" alt="">
                            </div>
                            <h3 class="card-title">Bachelor of Science in Artificial Intelligence</h3>
                            <p class="lead">Detail about this program,click on learn more</p>
                            <button class="btn bg-warning text-dark">Learn More</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-light text-center bg-white pb-2">
                        <div class="card-body text-dark">
                            <div class="img-area mb-4">
                                <img src="img/Bs_DateScience.jpg" class="img-fluid" alt="">
                            </div>
                            <h3 class="card-title">Bachelor of Science in Data Science</h3>
                            <p class="lead">Detail about this program,click on learn more</p>
                            <button class="btn bg-warning text-dark">Learn More</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-light text-center bg-white pb-2">
                        <div class="card-body text-dark">
                            <div class="img-area mb-4">
                                <img src="img/Bs_CyberSecurity.jpg" class="img-fluid" alt="">
                            </div>
                            <h3 class="card-title">Bachelor of Science in Cyber Security</h3>
                            <p class="lead">Detail about this program,click on learn more</p>
                            <button class="btn bg-warning text-dark">Learn More</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-light text-center bg-white pb-2">
                        <div class="card-body text-dark">
                            <div class="img-area mb-4">
                                <img src="img/Bs_Electronics.jpg" class="img-fluid" alt="">
                            </div>
                            <h3 class="card-title">Bachelor of Science in Electronics</h3>
                            <p class="lead">Detail about this program,click on learn more</p>
                            <button class="btn bg-warning text-dark">Learn More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- programs ends -->

    <!-- team starts -->
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
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="img/Dr.Jahangir Khan.jpg" alt="" class="img-fluid rounded-circle">
                            <h3 class="card-title py-2">Dr.Jahangir Khan</h3>
                            <h6>Associate Professor/Head</h6><br>
                            <p class="card-text">PhD(IT)& PostDoc,China Agricultural Uni,Beijing & Engineering Academy of Serbia</p>
<br>

                            <p class="socials">
                                <i class="bi bi-twitter text-dark mx-1"></i>
                                <i class="bi bi-facebook text-dark mx-1"></i>
                                <i class="bi bi-linkedin text-dark mx-1"></i>
                                <i class="bi bi-instagram text-dark mx-1"></i>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="img/Engr_Mudassir-Aman.jpg" alt="" class="img-fluid rounded-circle">
                            <h3 class="card-title py-2">Engr.Mudassir Aman</h3>
                            <h6>Assistant Professor/Assistant Coordinator</h6>
                            <p class="card-text">MSc Electrical & Electronics Engineering, <br>UET Peshawar.</p>
                           <br> <p class="socials">
                                <i class="bi bi-twitter text-dark mx-1"></i>
                                <i class="bi bi-facebook text-dark mx-1"></i>
                                <i class="bi bi-linkedin text-dark mx-1"></i>
                                <i class="bi bi-instagram text-dark mx-1"></i>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="img/Dr_Asad-Ali.jpg" alt="" class="img-fluid rounded-circle">
                            <h3 class="card-title py-2">Dr.Asad Ali</h3>
                            <h6>Assistant Professor</h6><br>
                            <p class="card-text">PhD (Computer Science and Information Engineering), University of
                                Salerno, Italy</p><br><br>
                            <p class="socials">
                                <i class="bi bi-twitter text-dark mx-1"></i>
                                <i class="bi bi-facebook text-dark mx-1"></i>
                                <i class="bi bi-linkedin text-dark mx-1"></i>
                                <i class="bi bi-instagram text-dark mx-1"></i>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="img/Mr_Abu-Bakar-Nauman.jpg" alt="" class="img-fluid rounded-circle">
                            <h3 class="card-title py-2">Mr.Abu Bakar Nauman</h3>
                            <h6>Assistant Professor</h6><br>
                            <p class="card-text">MS Computer Science, BZU Multan</p><br><br>
                            <p class="socials">
                                <i class="bi bi-twitter text-dark mx-1"></i>
                                <i class="bi bi-facebook text-dark mx-1"></i>
                                <i class="bi bi-linkedin text-dark mx-1"></i>
                                <i class="bi bi-instagram text-dark mx-1"></i>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="img/Dr-Shahid-Latif.jpg" alt="" class="img-fluid rounded-circle">
                            <h3 class="card-title py-2">Dr. Shahid Latif</h3>
                            <h6>Associate Professor</h6><br>
                            <p class="card-text">PhD (Computer Networks), University of Peshawar</p><br><br>
                            <p class="socials">
                                <i class="bi bi-twitter text-dark mx-1"></i>
                                <i class="bi bi-facebook text-dark mx-1"></i>
                                <i class="bi bi-linkedin text-dark mx-1"></i>
                                <i class="bi bi-instagram text-dark mx-1"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- team ends -->
    
    <!-- Contact starts -->
    <section id="contact" class="contact section-padding">
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-5">
                        <h2>Contact Us</h2>
                        <p>If you have any doubt, contact us through;<br>mdarshadkhan344@gmail.com</p>
                    </div>
                </div>
            </div>
            <div class="row m-0">
                <div class="col-md-12 p-0 pt-4 pb-4">
                    <form action="#" class="bg-light p-4 m-auto">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input class="form-control" placeholder="Full Name" required="" type="text">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input class="form-control" placeholder="Email" required="" type="email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <textarea class="form-control" placeholder="Message" required=""
                                        rows="3"></textarea>
                                </div>
                            </div><button class="btn btn-warning btn-lg btn-block mt-3" type="button">Send Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- contact ends -->
    <!-- footer starts -->
    <footer class="bg-dark p-2 text-center">
        <div class="container">
            <p class="text-white">All Right Reserved By @www.suitcs/it.com</p>
        </div>
    </footer>
    <!-- footer ends -->



    <!-- All Js -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>


