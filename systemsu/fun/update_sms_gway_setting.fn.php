<?php

 // Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];  
        
        
//Call in settings.inc.php

include_once '../php-includes/connect.inc.php';  


function Update_sms_gway_settings(){
 
    if(isset($_POST['btn_sms_gway_save'])){
        
 
            global $db;
            
            
    if (isset($_POST['txt_sms_gway_dcode'])) {
        $var_txt_sms_gway_dcode = mysqli_real_escape_string($db, $_POST['txt_sms_gway_dcode']);
    }
    
    
    if (isset($_POST['txt_sms_gway_token'])) {
        $var_txt_sms_gway_token = mysqli_real_escape_string($db, $_POST['txt_sms_gway_token']);
    }
    
    if (isset($_POST['txt_sms_sender'])) {
        $var_txt_sms_sender = mysqli_real_escape_string($db, $_POST['txt_sms_sender']);
    }
    
    
    
    
        if (isset($_POST['sms_send_reg'])) {
        $var_sms_send_reg = mysqli_real_escape_string($db, $_POST['sms_send_reg']);
    }
    
        if (isset($_POST['sms_send_pay'])) {
        $var_sms_send_pay = mysqli_real_escape_string($db, $_POST['sms_send_pay']);
    }
    
        if (isset($_POST['sms_send_atten'])) {
        $var_sms_send_atten = mysqli_real_escape_string($db, $_POST['sms_send_atten']);
    }
    
    
       global $db;

    $stmt = $db->prepare("UPDATE cp_settings SET sms_gway_dcode=?, sms_gway_token=?, sms_sender=?, sms_send_reg=?, sms_send_pay=?, sms_send_atten=? WHERE `setting_id`=2" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt->bind_param('ssssss', $var_txt_sms_gway_dcode, $var_txt_sms_gway_token, $var_txt_sms_sender, $var_sms_send_reg, $var_sms_send_pay, $var_sms_send_atten);
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