<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
        
//Call in addlecturer.inc.php

include_once '../../php-includes/connect.inc.php'; 

function addlecturer(){

if(isset($_POST['btn_AddLec_submit'])){
    
    global $db;
 
    
    if (isset($_POST['txt_AutoID'])) {
           $var_ID = $_POST['txt_AutoID'];     
    }


    if (isset($_POST['txt_Lecturer_id'])) {
        $var_LecturerID =  $_POST['txt_Lecturer_id'];
    }
    
    if (isset($_POST['txt_Lecturer_regDate'])) {
    $var_LecturerRegDate = $_POST['txt_Lecturer_regDate'];
    }
    
    if (isset($_POST['txt_Lecturer_name'])) {
    $var_LecturerName = $_POST['txt_Lecturer_name'];
    }
    
    if (isset($_POST['txt_Lecturer_address'])) {
    $var_LecturerAddress = $_POST['txt_Lecturer_address'];
    }
    
    if (isset($_POST['txt_Lecturer_sex'])) {
    $var_LecturerSex = $_POST['txt_Lecturer_sex'];
    }
    
    if (isset($_POST['txt_Lecturer_Mno01'])) {
    $var_LecturerMnub = $_POST['txt_Lecturer_Mno01'];
    }
     
   
    if (isset($_POST['txt_Lecturer_notes'])) {
    $var_Lecturer_notes = $_POST['txt_Lecturer_notes'];

    }
    

       global $db;
    

    $stmt2 = $db->prepare("INSERT INTO `cp_lecturers` (id, lec_id, lec_regdate, lec_name, lec_address, lec_sex, lec_mob, lec_notes) VALUES (?, ?, ?, ?, ?, ?, ?, ? )" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt2->bind_param('iissssss', $var_ID, $var_LecturerID, $var_LecturerRegDate, $var_LecturerName, $var_LecturerAddress, $var_LecturerSex, $var_LecturerMnub, $var_Lecturer_notes);
    $stmt2->execute();
    $stmt2->close(); 
     
    $stmt3 = $stmt2;
    
       //Redirect to the page after inset 
   echo "<script>location='index.php?page=AddLecturer'</script>";
   
    return($stmt3);
    
   }
    
  }  
    
    
// If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
?>