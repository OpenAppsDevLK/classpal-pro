<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
        
//linked with viewallstudents.inc.php
include_once '../../php-includes/connect.inc.php'; 

//Select multi recodes

// if search keyword is seet on URL....
 if(isset($_GET["SearchKey"])){
    
     
     
     $rowCount = count($_POST["checkbox"]);

            for($i=0;$i<$rowCount;$i++) {
                $stmt = $db->prepare("DELETE FROM cp_absent WHERE id='" . $_POST["checkbox"][$i] . "'");
                $stmt->execute(); 
                $stmt->close();
            }
            



//Jump to the same page after deleteing the image
header('Location: ../index.php?page=AddAbsents'); 

//if NOT, 
 } else {
     
$rowCount = count($_POST["checkbox"]);

            for($i=0;$i<$rowCount;$i++) {
                $stmt = $db->prepare("DELETE FROM cp_absent WHERE id='" . $_POST["checkbox"][$i] . "'");
                $stmt->execute(); 
                $stmt->close();
            }
            
                    

//Jump to the same page after deleteing the image
header('Location: ../index.php?page=AddAbsents'); 

     
 }


        
    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}



?>




