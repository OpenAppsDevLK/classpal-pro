<?php


 // Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];     


        
        
//Call in updatestudentdetails.inc.php

include_once '../../php-includes/connect.inc.php'; 

function upadtestudent(){
    

 

 if (isset($_POST['txt_AutoID'])) {
        $var_US_ID = $_POST['txt_AutoID'];
    }

    if (isset($_POST['txt_student_id'])) {
        $var_US_StudentID =  $_POST['txt_student_id'];
    }
    
    if (isset($_POST['txt_regDate'])) {
    $var_US_StuRegDate = $_POST['txt_regDate'];
    }
    
    if (isset($_POST['txt_student_name'])) {
    $var_US_StuName = $_POST['txt_student_name'];
    }
    
    if (isset($_POST['txt_student_address'])) {
    $var_US_StuAddress = $_POST['txt_student_address'];
    }
    
    if (isset($_POST['txt_student_sex'])) {
    $var_US_StuSex = $_POST['txt_student_sex'];
    }

    if (isset($_POST['txt_BDate'])) {
    $var_US_StuBday = $_POST['txt_BDate'];
    
    }
    
    if (isset($_POST['txt_student_hmphone'])) {
    $var_US_HomePhone = $_POST['txt_student_hmphone'];
    }
    
   
    if (isset($_POST['txt_student_Mno01'])) {
    $var_US_MobNo01 = $_POST['txt_student_Mno01'];

    }
    
    if (isset($_POST['txt_student_Mnub02'])) {
    $var_US_MobNo02 = $_POST['txt_student_Mnub02'];

    }
    
    if (isset($_POST['txt_student_email'])) {
    $var_US_StuEmail = $_POST['txt_student_email'];

    }
   
     if (isset($_POST['txt_student_school'])) {
    $varStuScchoolName = $_POST['txt_student_school'];

    }
    
    if (isset($_POST['txt_student_notes'])) {
    $var_US_StuNotes = $_POST['txt_student_notes'];

    }
    
    if (isset($_POST['txt_student_passgrade'])) {
    $var_US_StuPassGrade = $_POST['txt_student_passgrade'];

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
    $varStuBar_code = $_POST['txt_student_barcode'];

    }
    
       global $db;
    
    $stmt = $db->prepare("UPDATE cp_students SET stu_ID=?, stu_studentID=?, stu_regdate=?, stu_studentname=?, stu_address=?, stu_sex=?, stu_bday=?, stu_con_home=?, stu_con_mobile1=?, stu_con_mobile2=?, stu_email=?, stu_schoolName=?, stu_notes=?, stu_passGrade=?, stu_image_name=?, stu_accesskey=?, stu_barcode=? WHERE `stu_studentID`='$var_US_StudentID'" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt->bind_param('iisssssssssssssii', $var_US_ID, $var_US_StudentID, $var_US_StuRegDate, $var_US_StuName, $var_US_StuAddress, $var_US_StuSex, $var_US_StuBday, $var_US_HomePhone, $var_US_MobNo01, $var_US_MobNo02, $var_US_StuEmail, $varStuScchoolName, $var_US_StuNotes, $var_US_StuPassGrade, $varStudent_photo, $varStuAccessKey, $varStuBar_code);
    $stmt->execute();
    $stmt->close(); 
    
    return($stmt);
    
   }
    
  
    
// If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
    
?>