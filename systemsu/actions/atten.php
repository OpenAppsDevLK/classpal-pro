<?php
// Browser Session Start here
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];

    include_once '../../php-includes/connect.inc.php';
    ?>


    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
            <title>Mark Student Attendance</title>

            <!-- Bootstrap -->
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

            <!-- Optional theme -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

            <!-- Latest compiled and minified JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

            <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->



            <!-- Sweet Alert Class-->
            <script src="../plugins/sweetalert/sweetalert-dev.js"></script>
            <link rel="stylesheet" href="../plugins/sweetalert/sweetalert.css">



            <script>

                // Window Maxmimize code
                function maximize() {
                    window.moveTo(0, 0);
                    window.resizeTo(screen.width, screen.height);
                }

                maximize();
            </script>



        </head>
        <body style="background-color: ivory;">


            <div class="container">
                <div class="row">



    <?php
    if (isset($_POST['atten_student_id'])) {
        $varStuiD = $_POST['atten_student_id'];

        $Date = date('Y-m-d');
        $DailyClassID_01 = $_GET['DailyClassID'];

        // To get Total attendance ...
        $stmt3 = $db->prepare("SELECT COUNT(id) FROM cp_attendance WHERE date LIKE '%{$Date}%' AND daily_class_id LIKE '%{$DailyClassID_01}%' ");
        $stmt3->bind_result($Total_atten);
        $stmt3->execute();

        while ($stmt3->fetch()) {
            
        }
        ?>


                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">

                                    <h1>Mark Student Attendance </h1>
                                    <h2 style="color: red; font-weight: bold;" >Class: <?php echo $_GET['ClassName']; ?></h2>
                                    <h2>Total Student: <?php echo $Total_atten; ?></h2>
                                    <form action="" method="post">
                                        <div class="form-group ">
                                            <label for="autorank">Atten ID</label>
                                            <input type="text" class="form-control" id="autorank" name="atten_id" value="AUTO" placeholder="" readonly>
                                        </div>  
                                        <div class="form-group ">
                                            <label for="autorank">Daily Class ID</label>
                                            <input type="text" class="form-control" id="autorank" name="daily_class_id" value="<?php echo $_GET['DailyClassID']; ?>" placeholder="" readonly>
                                        </div>        
                                        <div class="form-group ">
                                            <label for="autorank">Atten Date</label>
                                            <input type="text" class="form-control" id="autorank" name="atten_date" value="<?php echo date('Y-m-d'); ?>" placeholder="" readonly>
                                        </div>        

                                        <div class="form-group">
                                            <label for="act_B_R">Subject ID</label>
                                            <input type="text" class="form-control" value="<?php echo $_GET['SubjectID']; ?>" name="atten_subj_id" id="act_B_R"  readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="act_B_R">Lecturer ID</label>
                                            <input type="text" class="form-control" value="<?php echo $_GET['LecID']; ?>" name="atten_lec_id" id="act_B_R"  readonly>
                                        </div> 

                                        <div class="form-group">
                                            <label for="act_B_R">Lecturer Name</label>
                                            <input type="text" class="form-control" value="<?php echo $_GET['LecName']; ?>" name="atten_lec_name" id="act_B_R"  readonly>
                                        </div>       
        <?php
        $varget_student_id = $_POST['atten_student_id'];

        //This will show the Student Details
        $stmt7_get_student_id = $db->prepare("SELECT stu_studentID, stu_studentname, stu_image_name FROM `cp_students` WHERE stu_studentID LIKE '%{$varget_student_id}%' OR stu_barcode LIKE '%{$varget_student_id}%' LIMIT 1");
        $stmt7_get_student_id->bind_result($Student_ID, $stu_studentname, $imageNames);
        $stmt7_get_student_id->execute();

        // $No_student_image = "YourLogo.png";
        ?>
                                        <div class="form-group">
                                            <label for="act_B_R">Student ID Or Barcode</label>
                                            <input type="text" class="form-control" value="<?php while ($stmt7_get_student_id->fetch()) {
            echo $Student_ID;
        } ?>" name="atten_student_id"  id="act_B_R" placeholder="Scan Student Barcode" autofocus required>
                                        </div>


                                        <button type="submit" name="submit_Mark_atten" class="btn btn-success">Make Attendance</button>
                                        <a style="" href="#" onclick="window.top.close();" class="btn btn-primary" >Close</a>
                                    </form>      


                                </div>



                                <div class="col-lg-6">
                                    <h1>Student Details</h1>


        <?php
        //This will show the Student Details
        $stmt7 = $db->prepare("SELECT stu_studentID, stu_studentname, stu_image_name FROM `cp_students` WHERE stu_studentID LIKE '%{$varStuiD}%' OR stu_barcode LIKE '%{$varStuiD}%' LIMIT 1");
        $stmt7->bind_result($Student_ID, $stu_studentname, $imageNames);
        $stmt7->execute();

        // $No_student_image = "YourLogo.png";

        while ($stmt7->fetch()) {
            ?>      

                                        <img class="profile-user-img img-responsive img-circle" style="width:200px;height:200px;" src="<?php echo $imageNames; ?>"> 
                                        <hr>
                                        <h4>Student Name: <?php echo $stu_studentname; ?></h4> 
                                        <hr>

                                        <?php
                                    }
                                    ?>

                                    <h4 style="padding-top: 25px;">Student Payments</h4>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Student ID</th>
                                                <th scope="col">Payment Date</th>
                                                <th scope="col">Paid Month</th>
                                                <th scope="col">Paid Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>


        <?php
        $SubjID = $_GET['SubjectID'];

        //This will show the Student Atten Details
        $stmt10 = $db->prepare("SELECT cp_payments.Pay_stu_studentID, cp_payments.pay_paymentdate, cp_payments.pay_paymentmonth, cp_payments.pay_cos_total, cp_students.stu_studentname FROM `cp_payments` LEFT JOIN `cp_students` ON cp_payments.Pay_stu_studentID = cp_students.stu_studentID WHERE (cp_payments.Pay_stu_studentID = $varStuiD OR cp_students.stu_barcode = $varStuiD) AND cp_payments.pay_subj_id=$SubjID ORDER BY cp_payments.pay_paymentmonth DESC LIMIT 5");
        $stmt10->bind_result($Pay_stu_studentID, $pay_paymentdate, $pay_paymentmonth, $pay_cos_total, $Student_Name);
        $stmt10->execute();

        $Pay_stu_studentID = htmlentities($Pay_stu_studentID, ENT_QUOTES, "UTF-8");
        $pay_paymentdate = htmlentities($pay_paymentdate, ENT_QUOTES, "UTF-8");
        $pay_paymentmonth = htmlentities($pay_paymentmonth, ENT_QUOTES, "UTF-8");
        $pay_cos_total = htmlentities($pay_cos_total, ENT_QUOTES, "UTF-8");

        while ($stmt10->fetch()) {


            $PaidMonth = date('Ym');

            //if student paid for the current month, table row highlight with red, if not blue...
            if ($PaidMonth == $pay_paymentmonth) {

                $bg_color = "#D73E2C";
            } else {
                $bg_color = "#3c8dbc";
            }
            ?>

                                                <tr>
                                                    <td><?php echo $Pay_stu_studentID; ?></td>
                                                    <td><?php echo $pay_paymentdate; ?></td>
                                                    <td bgcolor="<?php echo $bg_color; ?>" style="color: floralwhite;"><?php echo $pay_paymentmonth; ?></td>
                                                    <td><?php echo $pay_cos_total; ?></td>
                                                </tr>


                                                <?php
                                            }
                                            ?>

                                        <p style="font-size: 10px;">Display, only 5 records.</p>
                                        </tbody>

                                    </table>




                                    <h4 style="padding-top: 25px;">Student Attendance</h4>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Student ID</th>
                                                <th scope="col">Attend Date</th>
                                                <th scope="col">Attend Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>


        <?php
        //This will show the Student Atten Details
        $stmt6 = $db->prepare("SELECT cp_attendance.date, cp_attendance.student_id, cp_attendance.att_time, cp_students.stu_image_name FROM `cp_attendance` LEFT JOIN `cp_students` ON cp_attendance.student_id = cp_students.stu_studentID WHERE (cp_attendance.student_id = $varStuiD OR cp_students.stu_barcode = $varStuiD) AND cp_attendance.subj_id = $SubjID ORDER BY cp_attendance.date DESC LIMIT 5");
        $stmt6->bind_result($Stu_Att_Date, $Stu_Att_ID, $Stu_Att_time, $imageNames);
        $stmt6->execute();

        $Stu_Att_Date = htmlentities($Stu_Att_Date, ENT_QUOTES, "UTF-8");
        $Stu_Att_ID = htmlentities($Stu_Att_ID, ENT_QUOTES, "UTF-8");
        $Stu_Att_time = htmlentities($Stu_Att_time, ENT_QUOTES, "UTF-8");
        $imageNames = htmlentities($imageNames, ENT_QUOTES, "UTF-8");

        while ($stmt6->fetch()) {
            ?>

                                                <tr>
                                                    <td><?php echo $Stu_Att_ID; ?></td>
                                                    <td><?php echo $Stu_Att_Date; ?></td>
                                                    <td><?php echo $Stu_Att_time; ?></td>
                                                </tr>


                                                <?php
                                            }
                                            ?>

                                        <p style="font-size: 10px;">Display, only 5 records.</p>
                                        </tbody>

                                    </table>




                                    <h4 style="padding-top: 25px;">Student Absents</h4>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Student ID</th>
                                                <th scope="col">Absent Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php
                                            //This will show the Student Atten Details
                                            $stmt8 = $db->prepare("SELECT cp_absent.date, cp_absent.student_id FROM `cp_absent` LEFT JOIN `cp_students` ON cp_absent.student_id = cp_students.stu_studentID WHERE (cp_absent.student_id = $varStuiD OR cp_students.stu_barcode = $varStuiD) AND cp_absent.subj_id = $SubjID ORDER BY date DESC LIMIT 5");
                                            $stmt8->bind_result($Stu_Att_Date, $Stu_Stu_ID);
                                            $stmt8->execute();

                                            $Stu_Att_Date = htmlentities($Stu_Att_Date, ENT_QUOTES, "UTF-8");
                                            $Stu_Stu_ID = htmlentities($Stu_Stu_ID, ENT_QUOTES, "UTF-8");

                                            while ($stmt8->fetch()) {
                                                ?>

                                                <tr>
                                                    <td><?php echo $Stu_Stu_ID; ?></td>
                                                    <td><?php echo $Stu_Att_Date; ?></td>
                                                </tr>


            <?php
        }
        ?>

                                        <p style="font-size: 10px;">Display, only 5 records.</p>
                                        </tbody>

                                    </table>



                                </div>
                            </div>




                        </div>



                    </div>     
                </div>      









        <?php
    } else {



        $Date = date('Y-m-d');
        $DailyClassID_01 = $_GET['DailyClassID'];

        // To get Total attendance ...
        $stmt3 = $db->prepare("SELECT COUNT(id) FROM cp_attendance WHERE date LIKE '%{$Date}%' AND daily_class_id LIKE '%{$DailyClassID_01}%' ");
        $stmt3->bind_result($Total_atten);
        $stmt3->execute();

        while ($stmt3->fetch()) {
            
        }
        ?>
            <hr>
                <h1>Mark Student Attendance</h1>
                <hr>
                <h2 style="color: red; font-weight: bold;" >Class: <?php echo $_GET['ClassName']; ?></h2>
                <h2>Total Students Present Today: <?php echo $Total_atten; ?></h2>
                <form action="" method="post">
                    <div class="form-group ">
                        <label for="autorank">Atten ID</label>
                        <input type="text" class="form-control" id="autorank" name="atten_id" value="AUTO" placeholder="" readonly>
                    </div>  
                    <div class="form-group ">
                        <label for="autorank">Daily Class ID</label>
                        <input type="text" class="form-control" id="autorank" name="daily_class_id" value="<?php echo $_GET['DailyClassID']; ?>" placeholder="" readonly>
                    </div>        
                    <div class="form-group ">
                        <label for="autorank">Atten Date</label>
                        <input type="text" class="form-control" id="autorank" name="atten_date" value="<?php echo date('Y-m-d'); ?>" placeholder="" readonly>
                    </div>        

                    <div class="form-group">
                        <label for="act_B_R">Subject ID</label>
                        <input type="text" class="form-control" value="<?php echo $_GET['SubjectID']; ?>" name="atten_subj_id" id="act_B_R"  readonly>
                    </div>

                    <div class="form-group">
                        <label for="act_B_R">Lecturer ID</label>
                        <input type="text" class="form-control" value="<?php echo $_GET['LecID']; ?>" name="atten_lec_id" id="act_B_R"  readonly>
                    </div> 

                    <div class="form-group">
                        <label for="act_B_R">Lecturer Name</label>
                        <input type="text" class="form-control" value="<?php echo $_GET['LecName']; ?>" name="atten_lec_name" id="act_B_R"  readonly>
                    </div>       

                    <div class="form-group">
                        <label for="act_B_R">Student ID Or Barcode</label>
                        <input type="text" class="form-control" value="" name="atten_student_id" id="act_B_R" placeholder="Scan Student Barcode" autofocus required>
                    </div>


                    <button type="submit" name="submit_atten_dash" class="btn btn-success">Search Student</button>
                    <a style="" href="#" onclick="window.top.close();" class="btn btn-primary" >Close</a>
                </form>      

        <?php
    } // End of if Statment
    ?>




        </div>
    </div>



    <?php
    if (isset($_POST['submit_Mark_atten'])) {


        $atten_id = $_POST['atten_id'];
        $atten_date = $_POST['atten_date'];
        $atten_subj_id = $_POST['atten_subj_id'];
        $atten_lec_id = $_POST['atten_lec_id'];
        $atten_lec_name = $_POST['atten_lec_name'];
        $atten_student_id = $_POST['atten_student_id'];
        $DailyClassID = $_POST['daily_class_id'];

        global $db;

        //TimeZone Configerations...
        $date = new DateTime('', new DateTimeZone('Asia/Colombo'));
        $date->setTimezone(new DateTimeZone('Asia/Colombo'));

        //Used a prepared statment to add annousments to the database..)
        $stmt = $db->prepare("INSERT INTO `cp_attendance` (id, date, student_id, subj_id, att_time, lec_id, lec_name, daily_class_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        //i - integer / d - double / s - string / b - BLOB
        $stmt->bind_param('isiisisi', $atten_id, $atten_date, $atten_student_id, $atten_subj_id, $date->format('H:i:s'), $atten_lec_id, $atten_lec_name, $DailyClassID);
        $stmt->execute();
        $stmt->close();

        //Get the student
        $stmt_select_student = $db->prepare("SELECT stu_con_mobile1 FROM `cp_students` WHERE stu_studentID = $atten_student_id");
        $stmt_select_student->bind_result($var_AS_MobNo01);
        $stmt_select_student->execute();

        while ($stmt_select_student->fetch()) {
            
        }



        //--Run SMS--------------------------
        //This will select SMS gateway code and token form db and send the message...
        $stmt_select_sms_gway_settings = $db->prepare("SELECT setting_id, sms_gway_dcode, sms_gway_token, sms_sender, sms_send_atten FROM `cp_settings` WHERE `setting_id`=2 ");
        $stmt_select_sms_gway_settings->bind_result($setting_id, $sms_gway_dcode, $sms_gway_token, $sms_sender, $sms_send_atten);
        $stmt_select_sms_gway_settings->execute();

        while ($stmt_select_sms_gway_settings->fetch()) {


            // Check if the field is empty
            if (empty($sms_send_atten)) {
                
            } else {


                // Code to run if the field is not empty
                $user = $sms_gway_dcode;
                $password = $sms_gway_token;
                $text = urlencode($sms_send_atten . " - " . $sms_sender);
                $to = $var_AS_MobNo01;

                $baseurl = "http://www.textit.biz/sendmsg";
                $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text";
                $ret = file($url);
            }
        }

        //---------------------------- 

        echo "<script>swal({   title: 'Success',   text: 'Attendance Marked.',   timer: 2000,   showConfirmButton: false }); </script>";

    }
    ?>




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    </body>
    </html>



    <?php
// If session isn't meet, user will redirect to login page
} else {
    header('Location: ../login.php');
}
?>