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
                <div class="logo" style="color:blue;">
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
                <a href="../leave_application/Leave.php" >
                    <span class="material-symbols-sharp">receipt_long </span>
                    <h3>Leave Application</h3>
                </a>

                
                <!-- <a href="include/leave_records.php">
                    <span class="material-symbols-sharp">receipt_long </span>
                    <h3>My Leave's Record</h3>
                </a> -->

                <!-- <a href="#">
                    <span class="material-symbols-sharp">receipt_long </span>
                    <h3>My Subjects</h3>
                </a> -->
                <!-- <a href="#">
                    <span class="material-symbols-sharp">receipt_long </span>
                    <h3>Student Attendance per subject</h3>
                </a> -->

               
                <a href="../gpa_calculation/GPA_Predictions.html">
                    <span class="material-symbols-sharp">receipt_long </span>
                    <h3>Calculate GPA</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-sharp">report_gmailerrorred </span>
                    <h3>Reports</h3>
                </a>
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

          

           
<br><br>
          
        </div>


    </div>



    <script src="assets/script.js"></script>
</body>

</html>