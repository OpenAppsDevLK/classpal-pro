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
   
            $stmt = $db->prepare("DELETE FROM cp_subj_allo WHERE sa_id='" . $_POST["checkbox"][$i] . "'");
            $stmt->execute(); 
            $stmt->close();

            }
            

// We get page number to redirect the user to the same records page that the user entered..
$SUBJECT_ID = $_GET["SubjectID"];

//Jump to the same page after delete
header('Location: ../index.php?page=ViewSubjectAllocatedStudents&SubjectID=' . $SUBJECT_ID); 

//if NOT, 
 } else {
     
$rowCount = count($_POST["checkbox"]);

            for($i=0;$i<$rowCount;$i++) {

            $stmt = $db->prepare("DELETE FROM cp_subj_allo WHERE sa_id='" . $_POST["checkbox"][$i] . "'");
            $stmt->execute(); 
            $stmt->close();

            }
            

// We get page number to redirect the user to the same records page that the user entered..
                        $PNo = $_GET["PageNo"]; 
                        $SUBJECT_ID = $_GET['SubjectID'];

//Jump to the same page after delete
header('Location: ../index.php?page=ViewSubjectAllocatedStudents&SubjectID='. $SUBJECT_ID . '&PageNo=' . $PNo); 

     
 }


        
    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}



?>



