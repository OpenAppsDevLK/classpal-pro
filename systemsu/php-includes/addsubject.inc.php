<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

                
// Select the user and assign permission...        
$stmt1133 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1133" ); 
$stmt1133->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1133->execute();

while ($stmt1133->fetch()){ 
    
}

            
//linked with addsubject.fn.php
$ADDSubject = addsubject();


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
            Add Subject
            <small>You can add subject details...</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Subject  Details</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                    
                    <form id="form_addstudent" style="" role="form" action="" method="post" enctype="multipart/form-data" >
                    <!-- text input -->

                    <div class="form-group">
                      <label>Subject Name*</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-book"></i>
                        </div>                       
                           <input type="text" name="txt_subj_name" value="" class="form-control" required>
                       </div>
                    </div>

                     <div class="form-group">
                          <label>Subjcet Fee*</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-money"></i>
                        </div>
                        <input type="text" name="txt_subj_fee" class="form-control" required>
                       </div>

                    </div>
                  
             
           <div class="box-footer">
              
                <div class= "col-lg-6 col-md-12 col-xs-1">
                <input  style="margin-top: 5px;" class="btn  btn-success btn-lg" name="btn_AddSubj_submit" type="submit" onclick="" value="Add this Subject">                    
                <input style="margin-top: 5px;" class="btn  btn-primary" type="reset" value="New">
                <a style="margin-top: 5px;" href="index.php?page=SubNPay&PageNo=1" class="btn  btn-danger">View All Subjects </a>
                
                </div>
            
                    
            </div><!-- /.box-footer-->   
                     
            </form>      
            </div><!-- /.box-body -->


        </section><!-- /.content -->
<?php   

 }  

$db->close();

?>        
      </div><!-- /.content-wrapper -->

 <?php

 
   
// If session isn't meet, user will redirect to login page
} else { 
    header('Location: login.php');
}

 ?>