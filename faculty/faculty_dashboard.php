<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="container">
        <aside>

            <div class="top">
                <div class="logo">
                    <h2>Csit <span class="danger">Department</span> </h2>
                </div>
                <div class="close" id="close_btn">
                    <span class="material-symbols-sharp">
                        close
                    </span>
                </div>
            </div>
            <!-- end top -->
            <div class="sidebar">

                <a href="#">
                    <span class="material-symbols-sharp">grid_view </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="../leave_application/Leave.php" class="active">
                    <span class="material-symbols-sharp">person_outline </span>
                    <h3>Leave Application</h3>
                </a>

                
                <a href="include/leave_records.php">
                    <span class="material-symbols-sharp">receipt_long </span>
                    <h3>My Leave's Record</h3>
                </a>

                <a href="#">
                    <span class="material-symbols-sharp">receipt_long </span>
                    <h3>My Subjects</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-sharp">receipt_long </span>
                    <h3>Student Attendance per subject</h3>
                </a>

                <!-- <a href="#">
                    <span class="material-symbols-sharp">mail_outline </span>
                    <h3>subject's Results</h3>
                    <span class="msg_count">14</span>
                </a> -->
                <!-- <a href="#">
                    <span class="material-symbols-sharp">report_gmailerrorred </span>
                    <h3>Reports</h3>
                </a> -->
                <a href="#">
                    <span class="material-symbols-sharp">settings </span>
                    <h3>settings</h3>
                </a>
                
                <a href="../landing_page/main.php">
                    <span class="material-symbols-sharp">logout </span>
                    <h3>logout</h3>
                </a>



            </div>

        </aside>
        <!-- --------------
        end asid
      -------------------- -->

        <!-- --------------
        start main part
      --------------- -->

        <main>
            <h1>Faculty Dashboard</h1>

           

            <div class="insights">

                <!-- start seling -->
                <div class="sales">
                    <span class="material-symbols-sharp">receipt_long</span>
                    <div class="middle">

                        <div class="left">
                            <h3>Total Subjects</h3>
                            <h1>6</h1>
                        </div>
                        <!-- <div class="progress">
                            <svg>
                                <circle r="30" cy="40" cx="40"></circle>
                            </svg>
                            <div class="number">
                                <p>80%</p>
                            </div>
                        </div> -->

                    </div>
                    <!-- <small>Last Month</small> -->
                </div>
                <!-- end seling -->


                

                <!-- start expenses -->
                <!-- <div class="expenses">
                    <span class="material-symbols-sharp">person_outline</span>
                    <div class="middle">

                        <div class="left">
                            <h3>My leaves</h3>
                            <h1>8</h1>
                        </div>

                    </div>
                    <small>per Month</small>
                </div> -->
                <!-- end seling -->

                 <!-- start seling -->
                 <!-- <div class="sales">
                    <span class="material-symbols-sharp">receipt_long</span>
                    <div class="middle">

                        <div class="left">
                            <h3>Total Assignments</h3>
                            <h1>10</h1>
                        </div>
                        

                    </div>
                </div> -->
                <!-- end seling -->

                <!-- start seling -->
                <div class="income">
                    <span class="material-symbols-sharp">mail_outline</span>
                    <div class="middle">

                        <div class="left">
                            <h3>Total Leaves</h3>
                            <h1>2</h1>
                        </div>
                    </div>
                    <small>Last Month</small>
                </div>
                <!-- end seling -->

            </div>
            <!-- end insights -->
            

        </main>
        <!------------------
         end main
        ------------------->

        <!----------------
        start right main 
      ---------------------->
        <div class="right">

            <div class="top">
                <button id="menu_bar">
                    <span class="material-symbols-sharp">menu</span>
                </button>

                <div class="theme-toggler">
                    <span class="material-symbols-sharp active">light_mode</span>
                    <span class="material-symbols-sharp">dark_mode</span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p><b>Arshad</b></p>
                        <p>Khan</p>
                        <small class="text-muted"></small>
                    </div>
                    <div class="profile-photo">
                        <img src="img/about.jpg" alt="" />
                    </div>
                </div>
            </div>

            <!-- <div class="recent_updates">
                <h2>Recent Update</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="assets/profile_four.jpg" alt="" />
                        </div>
                        <div class="message">
                            <p><b>Junaid</b> Recieved his email of Enrollment</p>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="assets/profile_three.jpg" alt="" />
                        </div>
                        <div class="message">
                            <p><b>shah</b> Recieved his message of leave</p>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="assets/profile_two.jpg" alt="" />
                        </div>
                        <div class="message">
                            <p><b>azmat</b> Recieved his email of aprroved leave</p>
                        </div>
                    </div>
                </div>
            </div> -->


            <!-- <div class="sales-analytics">
                <h2>Sales Analytics</h2>

                <div class="item onlion">
                    <div class="icon">
                        <span class="material-symbols-sharp">shopping_cart</span>
                    </div>
                    <div class="right_text">
                        <div class="info">
                            <h3>Onlion Orders</h3>
                            <small class="text-muted">Last seen 2 Hours</small>
                        </div>
                        <h5 class="danger">-17%</h5>
                        <h3>3849</h3>
                    </div>
                </div>
                <div class="item onlion">
                    <div class="icon">
                        <span class="material-symbols-sharp">shopping_cart</span>
                    </div>
                    <div class="right_text">
                        <div class="info">
                            <h3>Onlion Orders</h3>
                            <small class="text-muted">Last seen 2 Hours</small>
                        </div>
                        <h5 class="success">-17%</h5>
                        <h3>3849</h3>
                    </div>
                </div>
                <div class="item onlion">
                    <div class="icon">
                        <span class="material-symbols-sharp">shopping_cart</span>
                    </div>
                    <div class="right_text">
                        <div class="info">
                            <h3>Onlion Orders</h3>
                            <small class="text-muted">Last seen 2 Hours</small>
                        </div>
                        <h5 class="danger">-17%</h5>
                        <h3>3849</h3>
                    </div>
                </div>



            </div> -->
<br><br>
            <!-- <div class="item add_product">
                <div>
                    <span class="material-symbols-sharp">add</span>
                </div>
            </div> -->
        </div>


    </div>



    <script src="assets/script.js"></script>
</body>

</html>