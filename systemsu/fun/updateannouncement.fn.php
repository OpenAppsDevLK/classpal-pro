<?php

 // Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];  
        
        
//Call in announcement.inc.php

include_once '../../php-includes/connect.inc.php'; 


function updateannouncement(){
 
    if(isset($_POST['btn_Update_submit'])){
        
    
    if (isset($_POST['txt_AutoID'])) {
        $var_AutoID = $_POST['txt_AutoID'];
    }

    if (isset($_POST['txt_AutoDate'])) {
        $var_Announcement_date = $_POST['txt_AutoDate'];
    }
    
    
    if (isset($_POST['txt_Announcement_title'])) {
        $var_Announcement_title = $_POST['txt_Announcement_title'];
    }
    
    if (isset($_POST['txt_Announcement_description'])) {
        $var_Announcement_description = $_POST['txt_Announcement_description'];
    }
  

    
       global $db;

    $stmt = $db->prepare("UPDATE cp_announcements SET id=?, an_date=?, an_title=?, an_des=? WHERE `id`='$var_AutoID'" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt->bind_param('isss', $var_AutoID, $var_Announcement_date, $var_Announcement_title, $var_Announcement_description);
    $stmt->execute();
    $stmt->close(); 
    

    
    return($stmt);
    
    
      }
      
   }
    
  
    
    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
    
?>