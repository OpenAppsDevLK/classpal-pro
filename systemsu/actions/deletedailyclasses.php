<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
        
//linked with viewallstudents.inc.php

//include
include_once '../../php-includes/connect.inc.php'; 

if (isset($_GET['DailyClassID'])) {    // GET instead of POST for value in the URL
   $VarDailyClassID = $_GET['DailyClassID']; // only id is needed - delete other variable assignments
    
   }
   

        $stmt = $db->prepare("DELETE FROM `cp_dailyclasses` WHERE `dc_id` = ?");
        $stmt->bind_param('i', $VarDailyClassID);
        $stmt->execute(); 
        $stmt->close();
        
       //Jump to the same page after deleteing the image
        header('Location: ../index.php?page=DailyClasses'); 
        
        
 
 // If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}

    
    ?>
