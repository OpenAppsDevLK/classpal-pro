<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

// Select the user and assign permission...          
$stmt1116 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1116" ); 
$stmt1116->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1116->execute();

while ($stmt1116->fetch()){ 
    
}



?>





<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

<?php
    if ($cp_userpermission_OnOff == 0){

        //$Message = "<p class='text-center'>";
        //$Message .= "<img src='Upload/ad.png'>";
        $Message .= "<h1>Access Denied</h1>";
        //$Message .= "Access Denied";
        //$Message .= "</p>";
        echo $Message;
        
    } else {
            
            
?>
          <h1>
            Classes Dashboard
            <small>You can mark daily students attendance and payments form here...</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Students</a></li>
            <li class="active">Classes Dashboard</li>
          </ol>
        </section>

        <!-- Main content Add attendance -->
        <section class="content">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Daily Classes</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
             
             <!-- general form elements disabled -->
             
             
<?php

$stmt_Select_classes = $db->prepare("SELECT dc_id, dc_class_name, dc_subj_id, dc_lec_id, dc_class_time, dc_lec_name  FROM `cp_dailyclasses`") ;
$stmt_Select_classes->bind_result($dc_id, $dc_class_name, $dc_subj_id, $dc_lec_id, $dc_class_time, $dc_lec_name);
$stmt_Select_classes->execute();

while ($stmt_Select_classes->fetch()){





?>
<div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
                <h4><?php echo $dc_lec_name; ?></h4>
              <h2><?php echo $dc_class_name; ?></h2>
              <h3><?php echo $dc_class_time; ?></h3>
              
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
              
            <a title="Add Attendance"  href="actions/atten.php?SubjectID=<?php echo $dc_subj_id; ?>&LecID=<?php echo $dc_lec_id; ?>&LecName=<?php echo $dc_lec_name; ?>&DailyClassID=<?php echo $dc_id; ?>&ClassName=<?php echo $dc_class_name; ?>" class="btn btn-success btn-flat" onclick="javascript:void window.open('actions/atten.php?SubjectID=<?php echo $dc_subj_id; ?>&LecID=<?php echo $dc_lec_id; ?>&LecName=<?php echo $dc_lec_name; ?>&DailyClassID=<?php echo $dc_id; ?>&ClassName=<?php echo $dc_class_name; ?>','1473862735520','width=1000,height=700,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=250,top=200');return false;" class="small-box-footer">
                Mark Attendance <i class="fa fa-arrow-circle-right"></i></a>
              
                <a title="Add Payment"  href="actions/pay.php?SubjectID=<?php echo $dc_subj_id; ?>&LecID=<?php echo $dc_lec_id; ?>&LecName=<?php echo $dc_lec_name; ?>&DailyClassID=<?php echo $dc_id; ?>&ClassName=<?php echo $dc_class_name; ?>" class="btn bg-maroon btn-flat margin" onclick="javascript:void window.open('actions/pay.php?SubjectID=<?php echo $dc_subj_id; ?>&LecID=<?php echo $dc_lec_id; ?>&LecName=<?php echo $dc_lec_name; ?>&DailyClassID=<?php echo $dc_id; ?>&ClassName=<?php echo $dc_class_name; ?>','1473862735520','width=700,height=800,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=250,top=100');return false;" class="small-box-footer">
              Add Payment <i class="fa fa-arrow-circle-right"></i>
              
            </a>
          </div>
        </div>             
 
                 <?php
                   
                   }
                   
                 ?>
             
        </div>
      </div>
        </section><!-- /.content End Add attendance -->
         
        
      
        
        
        
      </div><!-- /.content-wrapper -->


        


      
    
<?php

}

    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: login123.php');
}

      
?>

