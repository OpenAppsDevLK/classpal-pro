<?php

 // Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];     


        
        
//Call in sendsms.inc.php

include_once '../../php-includes/connect.inc.php'; 


function SendSMS(){


global $db;
            

if (isset($_POST['btn_submitsms'])){
    

     if (isset($_POST["txt_sms_telenumbers"])){
          $recipient = $_POST["txt_sms_telenumbers"];
       
     }


     if (isset($_POST["txt_sms_Message"])){
          $message = $_POST["txt_sms_Message"];
       
     }

    //This will select SMS gateway code and token form db...
    $stmt_select_sms_gway_settings = $db->prepare("SELECT setting_id, sms_gway_dcode, sms_gway_token FROM `cp_settings` WHERE `setting_id`=2 ");
    $stmt_select_sms_gway_settings->bind_result($setting_id, $sms_gway_dcode, $sms_gway_token);
    $stmt_select_sms_gway_settings->execute();

        while ($stmt_select_sms_gway_settings->fetch()){ 
        
        } 
    


$user = $sms_gway_dcode;
$password = $sms_gway_token;
$text = urlencode($message);
$to = $recipient;


$baseurl ="http://www.textit.biz/sendmsg";
$url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text";
$ret = file($url);


$res= explode(":",$ret[0]);

if (trim($res[0])=="OK")
{
echo "<script>window.location.href = 'index.php?page=SendSMS&Status=Success';</script>";

}
else
{
echo "<script>window.location.href = 'index.php?page=SendSMS&Status=Error.$res[1]';</script> ";
}



 
   
  } 
  
 } 
   
// If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
    
?>