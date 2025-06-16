<?php
// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
        
//linked with viewallstudents.inc.php
include_once '../../php-includes/connect.inc.php'; 

//Select multi recodes

 if(isset($_GET["SearchKey"])){
    
     $rowCount = count($_POST["checkbox"]);

            for($i=0;$i<$rowCount;$i++) {
                
            //Used a prepared statment to add students to new table call cp_oldstudents
            $stmt2 = $db->prepare("INSERT INTO cp_oldstudents SELECT * FROM cp_students WHERE stu_studentID='" . $_POST["checkbox"][$i] . "'");
            $stmt2->execute();
                

            //Delete Student
            $stmt = $db->prepare("DELETE FROM cp_students WHERE stu_studentID='" . $_POST["checkbox"][$i] . "'");
            $stmt->execute(); 
            
            
            //Delete Student Allocation
            $stmtSA = $db->prepare("DELETE FROM cp_subj_allo WHERE sa_stu_student_id='" . $_POST["checkbox"][$i] . "'");
            $stmtSA->execute(); 
            
            //Delete Student Attendence
            $stmtAtten = $db->prepare("DELETE FROM cp_attendance WHERE student_id='" . $_POST["checkbox"][$i] . "'");
            $stmtAtten->execute(); 
            
            $stmt->close();
            $stmtSA->close();
            $stmt2->close();
            $stmtAtten->close();




            }
            

// We get page number to redirect the user to the same records page that the user entered..
$SearchKey = $_GET["SearchKey"];

//Jump to the same page after deleteing the image
header('Location: ../index.php?page=ViewAllStudents&SearchKey=' . $SearchKey); 

 } else {
     
$rowCount = count($_POST["checkbox"]);

            for($i=0;$i<$rowCount;$i++) {
          
            //Delete form Student table
            $stmt = $db->prepare("DELETE FROM cp_students WHERE stu_studentID='" . $_POST["checkbox"][$i] . "'");
            $stmt->execute(); 
            

            //Delete Student Allocation
            $stmtSA = $db->prepare("DELETE FROM cp_subj_allo WHERE sa_stu_student_id='" . $_POST["checkbox"][$i] . "'");
            $stmtSA->execute(); 
            
            //Delete Student Attendence
            $stmtAtten = $db->prepare("DELETE FROM cp_attendance WHERE student_id='" . $_POST["checkbox"][$i] . "'");
            $stmtAtten->execute(); 
            
            $stmt->close();
            $stmtSA->close();
            //$stmt2->close();
            $stmtAtten->close();



            }
            

// We get page number to redirect the user to the same records page that the user entered..
$PNo = $_GET["PageNo"];

//Jump to the same page after deleteing the image
header('Location: ../index.php?page=ViewAllStudents&PageNo=' . $PNo); 

     
 }




// If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


?>