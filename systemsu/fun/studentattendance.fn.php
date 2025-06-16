<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
        
//Call in studentattendance.inc.php

include_once '../../php-includes/connect.inc.php'; 

function addattendance(){
    
if (isset($_POST['txt-sa_LecturerID'])){

 if (isset($_POST['txt_attenID'])) {
        $varATTiD = $_POST['txt_attenID'];
    }

    if (isset($_POST['txt_attendate'])) {
       $varAttdate =  $_POST['txt_attendate'];
    }
    
    
    if (isset($_POST['txt_sa_student_id'])) {
    $varStudentID = $_POST['txt_sa_student_id'];
    }
    
    if (isset($_POST['txt-sa_SubjectID'])) {
    $varSubjID = $_POST['txt-sa_SubjectID'];
    }
    
    if (isset($_POST['txt-sa_LecturerID'])) {
    $varLecturerID = $_POST['txt-sa_LecturerID'];
    }
    
    if (isset($_POST['txt-sa_LecturerName'])) {
    $varLecturerIDName = $_POST['txt-sa_LecturerName'];
    }
    
 
//TimeZone Configerations...
$date = new DateTime('',new DateTimeZone('Asia/Colombo'));
$date->setTimezone(new DateTimeZone('Asia/Colombo'));

  global $db;

            $stmt5 = $db->prepare("SELECT stu_studentID FROM `cp_students` WHERE stu_studentID LIKE '%{$varStudentID}%'");
            $stmt5->bind_result($Student_id);
            $stmt5->execute(); 

             while ($stmt5->fetch()){

             }
    

if ($Student_id == $varStudentID){
    

        
                global $db;
    
                //Used a prepared statment to add attendenace to the database..)
             $stmt = $db->prepare("INSERT INTO `cp_attendance` (id, date, student_id, subj_id, att_time, lec_id, lec_name) VALUES (?, ?, ?, ?, ?, ?, ?)" );
             //i - integer / d - double / s - string / b - BLOB                            [Time Zone]
             $stmt->bind_param('isiisis', $varATTiD, $varAttdate, $varStudentID, $varSubjID, $date->format('H:i:s'), $varLecturerID, $varLecturerIDName );
             $stmt->execute();
             $stmt->close(); 

              //This is inside a function, So we need to return the value to run this function...
             return($stmt);
             
       //Get the student
    $stmt_select_student = $db->prepare("SELECT stu_con_mobile1 FROM `cp_students` WHERE stu_studentID = $varStudentID");
    $stmt_select_student->bind_result($var_AS_MobNo01);
    $stmt_select_student->execute();

    while ($stmt_select_student->fetch()){ 

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
    
            
   }  else {
             
             echo "<script>sweetAlert('Oops...', 'No student under this ID..!! Check and Try Again', 'error');</script>";
    }  
         
            
        
    
    
    

    

    
    
    
   }
} 
// If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}

    
?>
