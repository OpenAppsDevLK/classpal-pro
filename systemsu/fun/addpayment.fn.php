<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
//Call in addpayments.inc.php

include_once '../../php-includes/connect.inc.php'; 

function addpayment(){
    


 if (isset($_POST['txt_RecpID'])) {
        $varPayID = $_POST['txt_RecpID'];
    }

    if (isset($_POST['txt_student_id'])) {
       $varPayStuID =  $_POST['txt_student_id'];
    }
    
    
    if (isset($_POST['txt_student_name'])) {
    $varPayStuName = $_POST['txt_student_name'];
    }
    
    
    if (isset($_POST['txt_subject_id'])) {
    $varPaySubjID = $_POST['txt_subject_id'];
    }
 
    if (isset($_POST['txt_subject_Name'])) {
    $varPaySubjName = $_POST['txt_subject_Name'];
    }
    
    if (isset($_POST['txt_Lecturer_id'])) {
    $varPayLecturerID = $_POST['txt_Lecturer_id'];
    }
    
    
    if (isset($_POST['txt_payDate'])) {
    $varPayDate = $_POST['txt_payDate'];
    }
    
    
    if (isset($_POST['txt_student_paymonth'])) {
    $varPayMonth = $_POST['txt_student_paymonth'];
    }
    
     if (isset($_POST['txt_student_subjfee'])) {
    $varPayCosFee = $_POST['txt_student_subjfee'];
    }
 
    if (isset($_POST['txt_student_admission'])) {
    $varPayCosAdmi = $_POST['txt_student_admission'];
    }
  
    if (isset($_POST['txt_student_total'])) {
    $varPayCosTotal = $_POST['txt_student_total'];

    }
    
    if (isset($_POST['txt_student_mobile_nub'])) {
            $var_AS_MobNo01 = $_POST['txt_student_mobile_nub'];
    }
    

        
                global $db;
    
             $stmt = $db->prepare("INSERT INTO `cp_payments` (pay_id, Pay_stu_studentID, pay_student_name, pay_subj_id, pay_subj_Name, pay_lec_id, pay_paymentdate, pay_paymentmonth, pay_cos_fee, pay_cos_admi, pay_cos_total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)" );
             //i - integer / d - double / s - string / b - BLOB
             $stmt->bind_param('iisisisiddd', $varPayID, $varPayStuID, $varPayStuName, $varPaySubjID, $varPaySubjName, $varPayLecturerID, $varPayDate, $varPayMonth, $varPayCosFee, $varPayCosAdmi, $varPayCosTotal);
             $stmt->execute();
             $stmt->close(); 
          
             
             
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
                return($stmt);
   }
    
        // If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
?>
