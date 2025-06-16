<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
        
//linked with viewallstudents.inc.php

//include
include_once '../../php-includes/connect.inc.php'; 

if (isset($_GET['AnnouncementID'])) {    // GET instead of POST for value in the URL
   $VarAnnouncementID = $_GET['AnnouncementID']; // only id is needed - delete other variable assignments
    
   }
   

        $stmt = $db->prepare("DELETE FROM `cp_announcements` WHERE `id` = ?");
        $stmt->bind_param('i', $VarAnnouncementID);
        $stmt->execute(); 
        $stmt->close();


  
        
       //Jump to the same page after deleteing the image
        header('Location: ../index.php?page=AddAnnouncement'); 
        
        
 
 // If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}

    
    ?>
