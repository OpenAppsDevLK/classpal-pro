<?php

// Browser Session Start here
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];

//Call in addstudents.inc.php

    include_once '../../php-includes/connect.inc.php';

    function addstudent() {

        if (isset($_POST['btn_AddStu_submit'])) {

            global $db;

            if (isset($_POST['txt_AutoID'])) {
                $var_AS_ID = $_POST['txt_AutoID'];
            }

            if (isset($_POST['txt_student_id'])) {
                $var_AS_StudentID = $_POST['txt_student_id'];
            }

            if (isset($_POST['txt_regDate'])) {
                $var_AS_StuRegDate = $_POST['txt_regDate'];
            }

            if (isset($_POST['txt_student_name'])) {
                $var_AS_StuName = $_POST['txt_student_name'];
            }

            if (isset($_POST['txt_student_address'])) {
                $var_AS_StuAddress = $_POST['txt_student_address'];
            }

            if (isset($_POST['txt_student_sex'])) {
                $var_AS_StuSex = $_POST['txt_student_sex'];
            }

            if (isset($_POST['txt_BDate'])) {

                $var_AS_StuBday = $_POST['txt_BDate'];

                if (!empty($var_AS_StuBday)) {
                    $var_AS_StuBday = mysqli_real_escape_string($db, $_POST['txt_BDate']);
                } else {
                    $var_AS_StuBday = "0000-00-00";
                }
            }


            if (isset($_POST['txt_student_hmphone'])) {
                $var_AS_HomePhone = $_POST['txt_student_hmphone'];
            }


            if (isset($_POST['txt_student_Mno01'])) {
                $var_AS_MobNo01 = $_POST['txt_student_Mno01'];
            }

            if (isset($_POST['txt_student_Mnub02'])) {
                $var_AS_MobNo02 = $_POST['txt_student_Mnub02'];
            }

            if (isset($_POST['txt_student_email'])) {
                $var_AS_StuEmail = $_POST['txt_student_email'];
            }

            if (isset($_POST['txt_student_school'])) {
                $varStuScchoolName = $_POST['txt_student_school'];
            }

            if (isset($_POST['txt_student_notes'])) {
                $var_AS_StuNotes = $_POST['txt_student_notes'];
            }

            if (empty($_POST['txt_student_Photo'])) {
                $varStudent_photo = "http://www.mediafire.com/convkey/1cd4/c2cveumcnvodxgtzg.jpg";
            } else {
                $varStudent_photo = $_POST['txt_student_Photo'];
            }


            if (isset($_POST['txt_student_accesskey'])) {
                $varStuAccessKey = $_POST['txt_student_accesskey'];
            }

            if (isset($_POST['txt_student_barcode'])) {
                $varStuBarCode = $_POST['txt_student_barcode'];
            }




            global $db;

            $stmt2 = $db->prepare("INSERT INTO `cp_students` (stu_ID, stu_studentID, stu_regdate, stu_studentname, stu_address, stu_sex, stu_bday, stu_con_home, stu_con_mobile1, stu_con_mobile2, stu_email, stu_schoolName, stu_notes, stu_image_name, stu_accesskey, stu_barcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            //i - integer / d - double / s - string / b - BLOB
            $stmt2->bind_param('iissssssssssssii', $var_AS_ID, $var_AS_StudentID, $var_AS_StuRegDate, $var_AS_StuName, $var_AS_StuAddress, $var_AS_StuSex, $var_AS_StuBday, $var_AS_HomePhone, $var_AS_MobNo01, $var_AS_MobNo02, $var_AS_StuEmail, $varStuScchoolName, $var_AS_StuNotes, $varStudent_photo, $varStuAccessKey, $varStuBarCode);
            $stmt2->execute();
            $stmt2->close();

            //--Run SMS--------------------------
            //This will select SMS gateway code and token form db and send the message...
            $stmt_select_sms_gway_settings = $db->prepare("SELECT setting_id, sms_gway_dcode, sms_gway_token, sms_sender, sms_send_reg FROM `cp_settings` WHERE `setting_id`=2 ");
            $stmt_select_sms_gway_settings->bind_result($setting_id, $sms_gway_dcode, $sms_gway_token, $sms_sender, $sms_send_reg);
            $stmt_select_sms_gway_settings->execute();

            while ($stmt_select_sms_gway_settings->fetch()) {


                // Check if the field is empty
                if (empty($sms_send_reg)) {
                    
                } else {


                    // Code to run if the field is not empty
                    $user = $sms_gway_dcode;
                    $password = $sms_gway_token;
                    $text = urlencode($sms_send_reg . " - " . $sms_sender);
                    $to = $var_AS_MobNo01;

                    $baseurl = "http://www.textit.biz/sendmsg";
                    $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text";
                    $ret = file($url);
                }
            }

            //----------------------------
            //Redirect to the page after inset 
            echo "<script>location='index.php?page=SubjectAllocation&StudentID=$var_AS_StudentID&StudentName=$var_AS_StuName'</script>";

            return($stmt3);
        }
    }

// If session isn't meet, user will redirect to login page
} else {
    header('Location: ../login.php');
}
?>