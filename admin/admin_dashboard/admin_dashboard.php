<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="container">
        <aside>

            <div class="top">
                <div class="logo" style="color:blue;" >
                    <h2>Csit Department </h2>
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

                <a href="#" class="active">
                    <span class="material-symbols-sharp">person_outline </span>
                    <h3>chatbot</h3>
                </a>

                <a href="../../login/login_dashboard/users_dashboard.php">
                    <span class="material-symbols-sharp">person_outline </span>
                    <h3>users</h3>
                </a>

                
                <a href="../../enrollment_form/enrollment_dashboard/enrollment_dash.php">
                    <span class="material-symbols-sharp">receipt_long </span>
                    <h3>Enrollement System</h3>
                </a>

                <a href="../../leave_application/leave_dashboard/leave_dash.php">
                    <span class="material-symbols-sharp">receipt_long </span>
                    <h3>Leave System</h3>
                </a>
                <a href="../../landing_page/mainpage_settings.php">
                    <span class="material-symbols-sharp">settings </span>
                    <h3>Main Page settings</h3>
                </a>

                <a href="#">
                    <span class="material-symbols-sharp">mail_outline </span>
                    <h3>Messages</h3>
                    <span class="msg_count">14</span>
                </a>
                <a href="#">
                    <span class="material-symbols-sharp">report_gmailerrorred </span>
                    <h3>Reports</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-sharp">settings </span>
                    <h3>settings</h3>
                </a>
                <!-- <a href="#">
                    <span class="material-symbols-sharp">add </span>
                    <h3>Add Product</h3>
                </a> -->
                <a href="../../landing_page/main.php">
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
            <h1>Admin Dashboard</h1>

           

            <!-- <div class="insights"> -->

                <!-- start seling -->
                <!-- <div class="sales">
                    <span class="material-symbols-sharp">person_outline</span>
                    <div class="middle">

                        <div class="left">
                            <h3>Total Faculty Members</h3>
                            <h1>40</h1>
                        </div> -->
                        <!-- <div class="progress">
                            <svg>
                                <circle r="30" cy="40" cx="40"></circle>
                            </svg>
                            <div class="number">
                                <p>80%</p>
                            </div>
                        </div> -->

                    <!-- </div> -->
                    <!-- <small>Last Month</small> -->
                <!-- </div> -->
                <!-- end seling -->


                

                <!-- start expenses -->
                <!-- <div class="expenses">
                    <span class="material-symbols-sharp">person_outline</span>
                    <div class="middle">

                        <div class="left">
                            <h3>Total Student</h3>
                            <h1>400</h1>
                        </div> -->
                        <!-- <div class="progress">
                            <svg>
                                <circle r="25" cy="40" cx="40"></circle>
                            </svg>
                            <div class="number">
                                <p>90%</p>
                            </div>
                        </div> -->

                    <!-- </div> -->
                    <!-- <small>Last Month</small> -->
                <!-- </div> -->
                <!-- end seling -->

                 <!-- start seling -->
                 <!-- <div class="sales">
                    <span class="material-symbols-sharp">person_outline</span>
                    <div class="middle">

                        <div class="left">
                            <h3>Total Enrollement Forms</h3>
                            <h1>60</h1>
                        </div> -->
                        <!-- <div class="progress">
                            <svg>
                                <circle r="30" cy="40" cx="40"></circle>
                            </svg>
                            <div class="number">
                                <p>80%</p>
                            </div>
                        </div> -->

                    <!-- </div> -->
                    <!-- <small>Last Month</small> -->
                <!-- </div> -->
                <!-- end seling -->

                <!-- start seling -->
                <!-- <div class="income">
                    <span class="material-symbols-sharp">mail_outline</span>
                    <div class="middle">

                        <div class="left">
                            <h3>Total Leaves</h3>
                            <h1>20</h1>
                        </div> -->
                        <!-- <div class="progress">
                            <svg>
                                <circle r="35" cy="40" cx="40"></circle>
                            </svg>
                            <div class="number">
                                <p>100%</p>
                            </div>
                        </div> -->

                    <!-- </div>
                    <small>Last Month</small>
                </div> -->
                <!-- end seling -->

            <!-- </div> -->
            <!-- end insights -->
            <!-- <div class="recent_order">
                <h2>Recent Applications</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Applicaion Name</th>
                            <th>Application Type</th>
                            <th>Others</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>leave</td>
                            <td>multiple day</td>
                            <td>other</td>
                            <td class="warning">Pending</td>
                            <td class="primary">Details</td>
                        </tr>
                        <tr>
                            <td>Enrollement</td>
                            <td>summer</td>
                            <td>Others</td>
                            <td class="warning">Pending</td>
                            <td class="primary">Details</td>
                        </tr>
                        <tr>
                            <td>leave</td>
                            <td>single day</td>
                            <td>other</td>
                            <td class="warning">Pending</td>
                            <td class="primary">Details</td>
                        </tr>
                        <tr>
                            <td>Enrollement</td>
                            <td>summer</td>
                            <td>Others</td>
                            <td class="warning">Pending</td>
                            <td class="primary">Details</td>
                        </tr>
                    </tbody>
                </table>
                <a href="#">Show All</a>
            </div> -->

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
                <!-- <div class="profile">
                    <div class="info">
                        <p><b>Arshad</b></p>
                        <p>Khan</p>
                        <small class="text-muted"></small>
                    </div>
                    <div class="profile-photo">
                        <img src="img/about.jpg" alt="" />
                    </div>
                </div> -->
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