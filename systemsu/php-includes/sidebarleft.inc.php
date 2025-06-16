<?php
// Browser Session Start here
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];
    ?>



    <?php
    // If page name is set on URL, Nav bar will forcus on the to the page....
    if (isset($_GET['page'])) {
        $setpage = $_GET['page'];

        if ($setpage == "AddStudents") {
            $active1 = "active";
        }
        if ($setpage == "ViewAllStudents") {
            $active2 = "active";
        }

        if ($setpage == "ViewAllAttendance") {
            $active_ViewAllAttendance = "active";
        }
        
        if ($setpage == "AddAbsents") {
            $active_AddAbsents = "active";
        }

        if ($setpage == "SubjectAllocation") {
            $active4 = "active";
        }

        if ($setpage == "SubNPay") {
            $active5 = "active";
        }

        if ($setpage == "ViewSubjectAllocations") {
            $active6 = "active";
        }

        if ($setpage == "AddUser") {
            $active7 = "active";
        }

        if ($setpage == "ViewAllUsers") {
            $active8 = "active";
        }

        if ($setpage == "AddAnnouncement") {
            $active9 = "active";
        }

        if ($setpage == "Reports") {
            $active11 = "active";
        }

        if ($setpage == "AddLecturer") {
            $active12 = "active";
        }

        if ($setpage == "SendSMS") {
            $active13 = "active";
        }

        if ($setpage == "ViewAllLecturers") {
            $active14 = "active";
        }

        if ($setpage == "AddSubject") {
            $active15 = "active";
        }

        if ($setpage == "DailyClasses") {
            $active16 = "active";
        }

        if ($setpage == "AtteDash") {
            $active17 = "active";
        }

        if ($setpage == "SystemSettings") {
            $active18 = "active";
        }
    }
    ?>



    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="dist/img/user1.png" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">

    <?php
    $stmt = $db->prepare("SELECT id, firstname, lastname FROM `cp_users` WHERE id= {$_SESSION['user_id']}");
    $stmt->bind_result($id, $FirstName, $LastName);
    $stmt->execute();
    while ($stmt->fetch()) {
        
    }
    ?>
                    <p><?php echo $FirstName . " " . $LastName; ?></p>
                </div>
            </div>
            <!-- search form -->
            <form action="index.php" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="hidden" name="page" value="UpdateStudentDetails">
                    <input type="text" name="StudentID" class="form-control" placeholder="Search Students...">
                    <span class="input-group-btn">
                        <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li class="treeview">
                    <a href="dash.php">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>


                <li  style="<?php echo $display_none_Lectrer; ?>" class="treeview <?php echo $active17 . $active16; ?>">
                    <a href="#">
                        <i class="fa fa-check-square-o "></i>
                        <span>Classes</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul style="<?php //echo $Message;  ?>" class="treeview-menu">
                        <li class="<?php echo $active17; ?>"><a href="index.php?page=AtteDash"><i class="fa fa-angle-double-right"></i>Classes Dashboard</a></li>
                        <li class="<?php echo $active16; ?>"><a href="index.php?page=DailyClasses&PageNo=1"><i class="fa fa-angle-double-right"></i>Daily Classes</a></li>
                    </ul>
                </li>  



    <?php
// Select the user and assign permission...        
    $stmt1992 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1992");
    $stmt1992->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
    $stmt1992->execute();

    while ($stmt1992->fetch()) {

        if ($cp_userpermission_OnOff == 0) {
            $display_none_Student = "display: none";
        } else {
            $display_none_Student = "";
        }
    }
    ?>
                <li  style="<?php echo $display_none_Student; ?>" class="treeview <?php echo $active1 . $active2 . $active_ViewAllAttendance . $active_AddAbsents ?>">
                    <a href="#">
                        <i class="fa fa-users"></i>
                        <span>Students</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul style="<?php //echo $Message; ?>" class="treeview-menu">
                        <li class="<?php echo $active1; ?>"><a href="index.php?page=AddStudents"><i class="fa fa-angle-double-right"></i>Add Student</a></li>
                        <li class="<?php echo $active2; ?>"><a href="index.php?page=ViewAllStudents&PageNo=1"><i class="fa fa-angle-double-right"></i> View All Students</a></li>
                        <li class="<?php echo $active_ViewAllAttendance; ?>"><a href="index.php?page=ViewAllAttendance"><i class="fa fa-angle-double-right"></i> View All Attendants</a></li>
                        <li class="<?php echo $active_AddAbsents; ?>"><a href="index.php?page=AddAbsents"><i class="fa fa-angle-double-right"></i>Add Absents</a></li>

                    </ul>
                </li>


    <?php
// Select the user and assign permission...        
    $stmt1993 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1993");
    $stmt1993->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
    $stmt1993->execute();

    while ($stmt1993->fetch()) {


        if ($cp_userpermission_OnOff == 0) {
            $display_none_Lectrer = "display: none";
        } else {
            $display_none_Lectrer = "";
        }
    }
    ?>

                <li  style="<?php echo $display_none_Lectrer; ?>" class="treeview <?php echo $active12 . $active14; ?>">
                    <a href="#">
                        <i class="fa fa-male"></i>
                        <span>Lecturers</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul style="<?php //echo $Message; ?>" class="treeview-menu">
                        <li class="<?php echo $active12; ?>"><a href="index.php?page=AddLecturer"><i class="fa fa-angle-double-right"></i>Add Lecturer</a></li>
                        <li class="<?php echo $active14; ?>"><a href="index.php?page=ViewAllLecturers&PageNo=1"><i class="fa fa-angle-double-right"></i> View All Lecturers</a></li>
                    </ul>
                </li>           


                <?php
// Select the user and assign permission...        
                $stmt1994 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1994");
                $stmt1994->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
                $stmt1994->execute();

                while ($stmt1994->fetch()) {


                    if ($cp_userpermission_OnOff == 0) {
                        $display_none_Subjects = "display: none";
                    } else {
                        $display_none_Subjects = "";
                    }
                }
                ?>

                <li style="<?php echo $display_none_Subjects; ?>" class="treeview <?php echo $active5 . $active4 . $active15; ?>">
                    <a href="#">
                        <i class="fa fa-usd"></i>
                        <span>Subjects</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php echo $active15; ?>"><a href="index.php?page=AddSubject"><i class="fa fa-angle-double-right"></i>Add Subject</a></li>                  
                        <li class="<?php echo $active4; ?>"><a href="index.php?page=SubjectAllocation"><i class="fa fa-angle-double-right"></i>Subject Allocation</a></li>
                        <li class="<?php echo $active5; ?>"><a href="index.php?page=SubNPay&PageNo=1"><i class="fa fa-angle-double-right"></i>Subjects &AMP; Payments</a></li>



                    </ul>
                </li>

                <?php
// Select the user and assign permission...          
                $stmt1995 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1995");
                $stmt1995->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
                $stmt1995->execute();

                while ($stmt1995->fetch()) {

                    if ($cp_userpermission_OnOff == 0) {
                        $display_none_Reports = "display: none";
                    } else {
                        $display_none_Reports = "";
                    }
                }
                ?>
                <li style="<?php echo $display_none_Reports; ?>"class="<?php echo $active11 ?>">
                    <a href="index.php?page=Reports">
                        <i class="fa fa-file-text"></i> <span>Reports</span>
                    </a>
                </li>



                <?php
// Select the user and assign permission...          
                $stmt1996 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1996");
                $stmt1996->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
                $stmt1996->execute();

                while ($stmt1996->fetch()) {

                    if ($cp_userpermission_OnOff == 0) {
                        $display_none_Tools = "display: none";
                    } else {
                        $display_none_Tools = "";
                    }
                }
                ?>            


                <li style="<?php echo $display_none_Tools; ?>" class="treeview <?php echo $active9 . $active10 . $active13 . $active18; ?>">
                    <a href="#">
                        <i class="fa fa-cogs"></i>
                        <span>Tools</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php echo $active9; ?>"><a href="index.php?page=AddAnnouncement"><i class="fa fa-angle-double-right"></i>Announcements</a></li>
                        <li class="<?php echo $active13; ?>"><a href="index.php?page=SendSMS"><i class="fa fa-angle-double-right"></i>Send SMS</a></li>  
                        <li class="<?php echo $active18; ?>"><a href="index.php?page=SystemSettings"><i class="fa fa-angle-double-right"></i>System Settings</a></li>  
                    </ul>
                </li>

                <?php
                // Select the user and assign permission...          
                $stmt1997 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1997");
                $stmt1997->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
                $stmt1997->execute();

                while ($stmt1997->fetch()) {

                    if ($cp_userpermission_OnOff == 0) {
                        $display_none_Users = "display: none";
                    } else {
                        $display_none_Users = "";
                    }
                }
                ?> 


                <li style="<?php echo $display_none_Users; ?>" class="treeview <?php echo $active7 . $active8; ?>">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>Users</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php echo $active7; ?>"><a href="index.php?page=AddUser"><i class="fa fa-angle-double-right"></i>Add User</a></li>
                        <li class="<?php echo $active8; ?>"><a href="index.php?page=ViewAllUsers&PageNo=1"><i class="fa fa-angle-double-right"></i>View All Users</a></li>
                    </ul>
                </li>

           <li class="<?php echo $active19 ?>">
              <a href="index.php?page=Help">
                <i class="fa fa-info-circle"></i> <span>Help</span>
              </a>
            </li>

                <!-- Lecturer Dashboard  -->

                <?php
// Select the user and assign permission...          
//                $stmt1998 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1998");
//                $stmt1998->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
//                $stmt1998->execute();
//
//                while ($stmt1998->fetch()) {
//
//                    if ($cp_userpermission_OnOff == 0) {
//                        $display_none_LecDash = "display: none";
//                    } else {
//                        $display_none_LecDash = "";
//                    }
//                }
                ?> 


<!--                <li style="<?php //echo $display_none_LecDash; ?>" class="treeview <?php //echo $active7 . $active8;  ?>">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>Lecturer Dash</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php //echo $active7;  ?>"><a href="index.php?page=LecturerDash"><i class="fa fa-angle-double-right"></i>Dashboard</a></li>
                        <li class="<?php //echo $active8;  ?>"><a href="index.php?page=ViewLecturerStudents&UserID=<?php //echo $_SESSION['user_id']; ?>&PageNo=1"><i class="fa fa-angle-double-right"></i>View All Students</a></li>
                        <li class="<?php //echo $active8;  ?>"><a href="index.php?page=ViewLecturerPayments&UserID=<?php //echo $_SESSION['user_id']; ?>&PageNo=1"><i class="fa fa-angle-double-right"></i>View All Payments</a></li>
                    </ul>
                </li>            -->

                <!-- Lecturer Dashboard End -->      



                <li>
                    <a href="logout.php">
                        <i class="fa fa-sign-out"></i> <span>Sign Out</span>
                    </a>
                </li>

        </section>

        <!-- /.sidebar -->
    </aside>
                <?php
                // If session isn't meet, user will redirect to login page
            } else {
                header('Location: login.php');
            }
            ?>