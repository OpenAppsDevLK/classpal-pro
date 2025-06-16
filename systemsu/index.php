<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];




//includes Files
include_once '../php-includes/connect.inc.php';
include_once 'php-includes/header.inc.php';
include_once 'php-includes/topnav.inc.php';
include_once 'php-includes/get-var.inc.php';
include_once 'php-includes/sidebarleft.inc.php'; 


// Function Files
include_once 'fun/addstudent.fn.php';
include_once 'fun/updatestudentdetils.fn.php';
include_once 'fun/addpayment.fn.php';
include_once 'fun/studentattendance.fn.php';
include_once 'fun/subjectallocation.fn.php';
include_once 'fun/updatesubject.fn.php';
include_once 'fun/adduser.fn.php';
include_once 'fun/updateuser.fn.php';
include_once 'fun/announcement.fn.php';
include_once 'fun/updateannouncement.fn.php';
include_once 'fun/changebnumber.fn.php';
include_once 'fun/updateins.fn.php';
include_once 'fun/sendsms.fn.php';
include_once 'fun/addlecturer.fn.php';
include_once 'fun/updatelecturerdetails.fn.php';
include_once 'fun/addsubject.fn.php';
include_once 'fun/studentabsents.fn.php';
include_once 'fun/adddailyclassses.fn.php';
include_once 'fun/update_sms_gway_setting.fn.php';



if ($page == "AddStudents"){
     require_once 'php-includes/addstudents.inc.php'; 
}  else {
    if ($page == "ViewAllStudents"){
     require_once 'php-includes/viewallstudents.inc.php'; 
} else {
     if ($page == "UpdateStudentDetails"){
     require_once 'php-includes/updatestudentdetails.inc.php'; 
} else {
     if ($page == "AddPayment"){
     require_once 'php-includes/addpayment.inc.php'; 
} else {
     if ($page == "PrintReceipt"){
     require_once 'php-includes/receipt.inc.php'; 
} else {
     if ($page == "ViewAllPayments"){
     require_once 'php-includes/viewallpayments.inc.php';
} else {
     if ($page == "ViewSubjectAllocatedStudents"){
     require_once 'php-includes/viewsubjallostudents.inc.php';
} else {
     if ($page == "SubjectAllocation"){
     require_once 'php-includes/subjectallocation.inc.php';    
} else {
     if ($page == "SubNPay"){
     require_once 'php-includes/SubNPay.inc.php';  

} else {
     if ($page == "PaymentPending"){
     require_once 'php-includes/paypending.inc.php';
     
} else {
     if ($page == "EditSubject"){
     require_once 'php-includes/editsubject.inc.php';    
} else {
       if ($page == "Reports"){
     require_once 'php-includes/reportdash.inc.php';    
} else {
       if ($page == "AddUser"){
     require_once 'php-includes/adduser.inc.php';  
} else {
       if ($page == "ViewAllUsers"){
     require_once 'php-includes/viewallusers.inc.php'; 
     
} else {
       if ($page == "EditUser"){
     require_once 'php-includes/edituser.inc.php'; 
} else {
       if ($page == "AssignPermissions"){
     require_once 'php-includes/assignpermissions.inc.php';     
} else {
       if ($page == "AddAnnouncement"){
     require_once 'php-includes/announcement.inc.php'; 
}else {
    if ($page == "BConverter"){
     require_once 'php-includes/bconverter.inc.php'; 
} else {
     if ($page == "RemovedStudents"){
     require_once 'php-includes/removedstudents.inc.php'; 
} else {
      if ($page == "AddLecturer"){
     require_once 'php-includes/addlecturer.inc.php'; 
} else {
    if ($page == "SendSMS"){
     require_once 'php-includes/sendsms.inc.php';
} else {
    if ($page == "ViewAllLecturers"){
     require_once 'php-includes/viewallecturers.inc.php'; 
} else {
     if ($page == "EditLecturer"){
     require_once 'php-includes/editlecturer.inc.php';   
} else {
     if ($page == "AddSubject"){
     require_once 'php-includes/addsubject.inc.php'; 
} else {
      if ($page == "AddAbsents"){
     require_once 'php-includes/AddAbsents.inc.php'; 
} else {
      if ($page == "ViewAllAttendance"){
     require_once 'php-includes/viewallattendance.inc.php'; 
} else {
      if ($page == "StudentAllocation"){
     require_once 'php-includes/studentallocation.inc.php';    
} else {
      if ($page == "AddStudentPayment"){
     require_once 'php-includes/addstudentpayment.inc.php'; 
} else {
      if ($page == "LecturerDash"){
     require_once 'php-includes/lecturedash.inc.php';
} else {
      if ($page == "ViewLecturerStudents"){
     require_once 'php-includes/viewlecturerstudents.inc.php';
} else {
      if ($page == "ViewLecturerPayments"){
     require_once 'php-includes/viewlecturerpayments.inc.php';   
} else {
      if ($page == "DailyClasses"){
     require_once 'php-includes/dailyclasses.inc.php';
} else {
      if ($page == "AtteDash"){
     require_once 'php-includes/attedash.inc.php';    
} else {
       if ($page == "SystemSettings"){
     require_once 'php-includes/systemsettings.inc.php';    
} else {
       if ($page == "Help"){
     require_once 'php-includes/help.inc.php';      
}
}
}
}
}
}
}
}
}
}     
}
}
}
}
}     
}     
}    
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}




// If session isn't meet, user will redirect to login page
} else { 
    header('Location: login.php');
}


?>





<?php

include_once 'php-includes/footer.inc.php';

?>