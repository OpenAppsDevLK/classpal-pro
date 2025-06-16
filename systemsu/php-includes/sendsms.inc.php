<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

//// Select the user and assign permission...        
$stmt1132 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1132" ); 
$stmt1132->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1132->execute();

while ($stmt1132->fetch()){ 
    
}

//linked with sendsms.fn.php
$SENDSMS = SendSMS();


?>

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
 <?php
    if ($cp_userpermission_OnOff == 0){
        $Message .= "<h1>Access Denied</h1>";
        echo $Message;
        
    } else {
            
            
?>               
            
          <h1>
            Send SMS to Students
            <small>You can send SMS...</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Send SMS</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
<?php

if (isset($_GET['Status'])){
    $StatusMsg = $_GET['Status'];
}

if (isset($_GET['PhoneNub'])){
    $PhoneNub = $_GET['PhoneNub'];
}

?>
           <!-- general form elements disabled -->
              <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo "Your Message Status: " . "<span style=color:red;>" . $StatusMsg . "</span>" ?> </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form id="form_addstudent" role="form" action="" method="post" enctype="multipart/form-data" >
                    <!-- text input -->
                   
                  
                    <div class="form-group">
                      <label>Telephone Numbers:  (Seperated by commas, Maximum 500 Telephone Numbers, Ex: 077xxxxxxx,071xxxxxxx)</label>
                      <input type="text" name="txt_sms_telenumbers" value="<?php echo $PhoneNub; ?>" class="form-control"  required>
                    </div>

                    <div class="form-group">
                      <label>Message (Maximum Characters 480)</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>                       
                           <textarea type="text" name="txt_sms_Message" maxlength="480" value="" class="form-control" required> </textarea>
                       </div>
                    </div>

                     
           
           
             
           <div class="box-footer">
              
                <div class= "col-lg-6 col-md-12 col-xs-1">
                 <button style="margin-top: 5px;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#changeMsg">SEND</button>                
                <a style="margin-top: 5px;" href="index.php?page=SendSMS" class="btn btn-success">New SMS</a>
                
                </div>
            
 <!-- Modal Window for Delete User-->
<div class="modal fade modal-danger" id="changeMsg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Send</h4>
      </div>
      <div class="modal-body">
          Do you want to Send this SMS... ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">No</button>
        <input  style="" class="btn  btn-success btn-flat" type="submit" onclick="" name="btn_submitsms" value="SEND NOW">
      </div>
    </div>
  </div>
</div>
 
            </div><!-- /.box-footer-->   
                     
            </form>      
            </div><!-- /.box-body -->
            

          </div><!-- /.box -->

        </section><!-- /.content -->
         <?php   }  ?>  
      </div><!-- /.content-wrapper -->

 <?php
    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: login.php');
}

?>