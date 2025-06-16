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
            <title>Add Payment</title>

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

            <!-- Jq Calx plugin, this is for calulate from input values, call in additem.inc.php (name="txt-br-bundle-price") (data-cell) (data-format)-->
            <script src="https://code.jquery.com/jquery-latest.min.js"></script>
            <script type="text/javascript" src="../plugins/calx/jquery-calx-2.2.3.min.js"></script>

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
        <body style="background-color: burlywood;">


            <div class="container">
                <div class="row col-md-8">

    <?php
    $ReceiptNo = rand();
    ?>     
                    <hr>
                    <h1>Add Payment</h1>
                    <p>Note: If you add payment, attendance is also automatically updated.</p>
                    <hr>
                    <h2 style="color: red; font-weight: bold;" >Class: <?php echo $_GET['ClassName']; ?></h2>

                    <form action="" method="post" id="form_studentpayment">
                        <div class="form-group ">
                            <label for="autorank">Receipt No</label>
                            <input type="text" class="form-control" id="autorank" name="pay_recp_no" value="<?php echo $ReceiptNo; ?>" placeholder="" readonly>
                        </div>

                        <div class="form-group ">
                            <label for="autorank">Daily Class ID</label>
                            <input type="text" class="form-control" id="autorank" name="pay_daily_class_id" value="<?php echo $_GET['DailyClassID']; ?>" placeholder="" readonly>
                        </div>  

                        <div class="form-group">
                            <label for="act_B_R">Subject ID</label>
                            <input type="text" class="form-control" value="<?php echo $_GET['SubjectID']; ?>" name="pay_subj_id" id="act_B_R"  readonly>
                        </div>

                        <div class="form-group">
                            <label for="act_B_R">Lecturer ID</label>
                            <input type="text" class="form-control" value="<?php echo $_GET['LecID']; ?>" name="pay_lec_id" id="act_B_R"  readonly>
                        </div> 

                        <div class="form-group">
                            <label for="act_B_R">Lecturer Name</label>
                            <input type="text" class="form-control" value="<?php echo $_GET['LecName']; ?>" name="pay_lec_name" id="act_B_R"  readonly>
                        </div>          

                        <div class="form-group ">
                            <label for="autorank">Payment Date</label>
                            <input type="text" class="form-control" id="autorank" name="pay_date" value="<?php echo date('Y-m-d'); ?>" placeholder="" readonly>
                        </div> 

                        <div class="form-group ">
                            <label for="autorank">Payment Month</label>
                            <input type="text" class="form-control" id="autorank" name="pay_month" value="<?php echo date('Ym'); ?>" >
                        </div>       

    <?php
    $Select_subj_id = $_GET['SubjectID'];

    //Select Subject Fee**
    $stmt7_select_subj_fee = $db->prepare("SELECT subj_classfee FROM `cp_subjects` WHERE subj_id LIKE '%{$Select_subj_id}%' LIMIT 1");
    $stmt7_select_subj_fee->bind_result($subj_fee);
    $stmt7_select_subj_fee->execute();
    ?>
                        <div class="form-group ">
                            <label for="autorank">Subject Fee</label>
                            <input type="text" style="background-color: green; color: white;" class="form-control" id="autorank" name="pay_subj_fee" value="<?php while ($stmt7_select_subj_fee->fetch()) {
                        echo $subj_fee;
                    } ?>" data-cell="A1" data-format=" 0,0[.]00" placeholder="0.00" required>
                        </div> 
                        <div class="form-group ">
                            <label for="autorank">Admission</label>
                            <input type="text" style="background-color: green; color: white;" class="form-control" id="autorank" name="pay_subj_admission" value="" data-cell="A2" data-format=" 0,0[.]00" placeholder="0.00">
                        </div>    
                        <div class="form-group ">
                            <label for="autorank">Total</label>
                            <input type="text" style="background-color: green; color: white;" class="form-control" id="autorank" name="pay_subj_total" value="<?php while ($stmt7_select_subj_fee->fetch()) {
                        echo $subj_fee;
                    } ?>" data-formula="A1+A2"  placeholder="0.00" required>
                        </div> 
                        <div class="form-group">
                            <label for="act_B_R">Student ID Or Barcode</label>
                            <input type="text" class="form-control" value="" name="pay_student_id" id="act_B_R" placeholder="Scan Student Barcode"  required autofocus>
                        </div>

                        <!-- This code is for calulate forms values.  -->
                        <script type="text/javascript">
                            $('#form_studentpayment').calx();
                        </script>        

                        <button type="submit" name="submit_pay_dash" class="btn btn-success">Add Payment</button>
                        <a style="" href="#" onclick="window.top.close();" class="btn btn-primary" >Close [ CTRL + W ]</a>
                    </form>


                </div>
            </div>



    <?php
    if (isset($_POST['submit_pay_dash'])) {


        $pay_recp_no = $_POST['pay_recp_no'];

        //Student ID*
        //Student Name*

        $pay_subj_id = $_POST['pay_subj_id'];

        //Subject Name**

        $pay_lec_id = $_POST['pay_lec_id'];

        $pay_date = $_POST['pay_date'];

        $pay_month = $_POST['pay_month'];

        $pay_subj_fee = $_POST['pay_subj_fee'];

        $pay_subj_admission = $_POST['pay_subj_admission'];

        $pay_subj_total = $_POST['pay_subj_total'];

        $pay_student_id = $_POST['pay_student_id'];

        $pay_lec_name = $_POST['pay_lec_name'];

        $pay_daily_class_id = $_POST['pay_daily_class_id'];

        global $db;

        //Select Subject Name**
        $stmt7_select_subj_name = $db->prepare("SELECT subj_name FROM `cp_subjects` WHERE subj_id LIKE '%{$pay_subj_id}%' LIMIT 1");
        $stmt7_select_subj_name->bind_result($subj_name);
        $stmt7_select_subj_name->execute();

        while ($stmt7_select_subj_name->fetch()) {
            
        }



        //Select Student ID and Name*
        $stmt7_select_stuid_name = $db->prepare("SELECT stu_studentID, stu_studentname FROM `cp_students` WHERE stu_studentID LIKE '%{$pay_student_id}%' OR stu_barcode LIKE '%{$pay_student_id}%' LIMIT 1");
        $stmt7_select_stuid_name->bind_result($Student_ID, $stu_studentname);
        $stmt7_select_stuid_name->execute();

        while ($stmt7_select_stuid_name->fetch()) {
            
        }


        //Used a prepared statment to add payment to the database..)
        $stmt = $db->prepare("INSERT INTO `cp_payments` (pay_id, Pay_stu_studentID, pay_student_name, pay_subj_id, pay_subj_Name, pay_lec_id, pay_paymentdate, pay_paymentmonth, pay_cos_fee, pay_cos_admi, pay_cos_total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ? ,? ,?)");
        //i - integer / d - double / s - string / b - BLOB
        $stmt->bind_param('iisisisiddd', $pay_recp_no, $Student_ID, $stu_studentname, $pay_subj_id, $subj_name, $pay_lec_id, $pay_date, $pay_month, $pay_subj_fee, $pay_subj_admission, $pay_subj_total);
        $stmt->execute();
        $stmt->close();

        //TimeZone Configerations...
        $date = new DateTime('', new DateTimeZone('Asia/Colombo'));
        $date->setTimezone(new DateTimeZone('Asia/Colombo'));

        //Used a prepared statment to add Attendence to the database..)
        $stmt = $db->prepare("INSERT INTO `cp_attendance` (date, student_id, subj_id, att_time, lec_id, lec_name, daily_class_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        //i - integer / d - double / s - string / b - BLOB
        $stmt->bind_param('siisisi', $pay_date, $Student_ID, $pay_subj_id, $date->format('H:i:s'), $pay_lec_id, $pay_lec_name, $pay_daily_class_id);
        $stmt->execute();
        $stmt->close();

        //Get the student
        $stmt_select_student = $db->prepare("SELECT stu_con_mobile1 FROM `cp_students` WHERE stu_studentID = $Student_ID");
        $stmt_select_student->bind_result($var_AS_MobNo01);
        $stmt_select_student->execute();

        while ($stmt_select_student->fetch()) {
            
        }



        //--Run SMS--------------------------
        //This will select SMS gateway code and token form db and send the message...
        $stmt_select_sms_gway_settings = $db->prepare("SELECT setting_id, sms_gway_dcode, sms_gway_token, sms_sender, sms_send_pay FROM `cp_settings` WHERE `setting_id`=2 ");
        $stmt_select_sms_gway_settings->bind_result($setting_id, $sms_gway_dcode, $sms_gway_token, $sms_sender, $sms_send_pay);
        $stmt_select_sms_gway_settings->execute();

        while ($stmt_select_sms_gway_settings->fetch()) {


            // Check if the field is empty
            if (empty($sms_send_pay)) {
                
            } else {


                // Code to run if the field is not empty
                $user = $sms_gway_dcode;
                $password = $sms_gway_token;
                $text = urlencode($sms_send_pay . " - " . $sms_sender);
                $to = $var_AS_MobNo01;

                $baseurl = "http://www.textit.biz/sendmsg";
                $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text";
                $ret = file($url);
            }
        }

        //---------------------------- 
        //
        //          
        //echo "<script>sweetAlert('Success', 'Actual Batch Rank Updated', 'success');</script>";

        echo "<script>swal({   title: 'Payment & Attendance Updated ',   text: 'Successfully.',   timer: 2000,   showConfirmButton: false }); </script>";

        //Auto refresh the page when the window close...
        //echo "<script> window.top.close(); </script>";
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