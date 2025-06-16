<?php

session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

// Select the user and assign permission...
$stmt1125 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1125" ); 
$stmt1125->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1125->execute();

while ($stmt1125->fetch()){ 
    
}


$PNo = $_GET['PageNo'];
$UserName = $_GET['UserName'];


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
            Assign Permissions
            <small>You can Assign Permissions to users...</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Assign Permissions to <b><?php echo $_GET['UserName']; ?></b></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
             
           <!-- general form elements disabled -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Permissions</h3>
                </div><!-- /.box-header -->
                
                  <form id="form_addstudent" role="form" action="<?php //$ASSIGNPERMISSION;  ?>" method="post" enctype="multipart/form-data" >

  <?php
                    $TabNo = $_GET['tab'];
                    //Tab will change accouring to URL request....
                    if ($TabNo == 1){
                        $aciveTab1 = "active";
                        $TabID = "tab_1";
                    } else {
                        $aciveTab1 = "";
                        $TabID = "tab_1";  
                    }
                    
                   
                    if ($TabNo == 2){
                        $aciveTab2 = "active";
                        $TabID2 = "tab_2";
                    } else {
                        
                        $aciveTab2 = "";
                        $TabID2 = "tab_2";
                    }
                    
                    if ($TabNo == 3){
                        $aciveTab3 = "active";
                        $TabID3 = "tab_3";
                    } else {
                        
                        $aciveTab3 = "";
                        $TabID3 = "tab_3";
                    }
                    
                    if ($TabNo == 4){
                        $aciveTab4 = "active";
                        $TabID4 = "tab_4";
                    } else {
                        
                        $aciveTab4 = "";
                        $TabID4 = "tab_4";
                    }
                    
                    
                    if ($TabNo == 5){
                        $aciveTab5 = "active";
                        $TabID5 = "tab_5";
                    } else {
                        
                        $aciveTab5 = "";
                        $TabID5 = "tab_5";
                    }
                    
                     if ($TabNo == 6){
                        $aciveTab6 = "active";
                        $TabID6 = "tab_6";
                    } else {
                        
                        $aciveTab6 = "";
                        $TabID6 = "tab_6";
                    }                   
                    
 ?>
                     
                      
<div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="<?php echo $aciveTab1; ?>"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Student</a></li>
                  <li class="<?php echo $aciveTab2; ?>"><a href="#tab_2" data-toggle="tab" aria-expanded="false">Subject &AMP; Lecturers</a></li>
                  <li class="<?php echo $aciveTab3; ?>"><a href="#tab_3" data-toggle="tab" aria-expanded="false">Reports &AMP; Dash</a></li>
                  <li class="<?php echo $aciveTab4; ?>"><a href="#tab_4" data-toggle="tab" aria-expanded="false">Users</a></li>
                  <li class="<?php echo $aciveTab5; ?>"><a href="#tab_5" data-toggle="tab" aria-expanded="false">Tools</a></li>
                  <li class="<?php echo $aciveTab6; ?>"><a href="#tab_6" data-toggle="tab" aria-expanded="false">Menus</a></li>
                </ul>
                <div class="tab-content">

                    
                    
<div class="tab-pane <?php echo $aciveTab1; ?>" id="<?php echo $TabID; ?>">
                    
 <!-- Start: Assign Permissions: PM 1111 -->
 <?php
 
    $UserID = $_GET['UserID'];
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1111 ");
    $stmt->bind_result($On_OFF);
    $stmt->execute();
   
    while ($stmt->fetch()){
        

     }
    
   
    
             if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>
 
<dl class="dl-horizontal">
    <dt>Add Student</dt>
  <dd>
      
  <a href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1111&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=1" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
  <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1111&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=1" class="btn btn-success btn-flat" >OFF</a>       
  
     
  </dd>
  
</dl>


<!-- END: Assign Permissions: PM 1111 -->

         
<!-- Start: Assign Permissions: PM 1112 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt1 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1112 ");
    $stmt1->bind_result($On_OFF);
    $stmt1->execute();
   
    while ($stmt1->fetch()){
        

     }
    
   
    
             if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>

<dl class="dl-horizontal">
  <dt>View All Students</dt>
  <dd>
      
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1112&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=1" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1112&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=1" class="btn btn-success btn-flat" >OFF</a>       

  </dd>
</dl>


<!-- END: Assign Permissions: PM 1112 -->

 

<!-- Start: Assign Permissions: PM 1113 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt2 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1113 ");
    $stmt2->bind_result($On_OFF);
    $stmt2->execute();
   
    while ($stmt2->fetch()){
        

     }
    
   
    
             if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>

<dl class="dl-horizontal">
  <dt>Add Payment</dt>
  <dd>
      
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1113&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=1" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1113&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=1" class="btn btn-success btn-flat" >OFF</a>       

  </dd>
</dl>


<!-- END: Assign Permissions: PM 1113 -->

<!-- Start: Assign Permissions: PM 1114 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt3 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1114 ");
    $stmt3->bind_result($On_OFF);
    $stmt3->execute();
   
    while ($stmt3->fetch()){
        

     }
    
   
    
             if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>

<dl class="dl-horizontal">
  <dt>Edit Students Details</dt>
  <dd>
      
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1114&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=1" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1114&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=1" class="btn btn-success btn-flat" >OFF</a>       

  </dd>
</dl>


<!-- END: Assign Permissions: PM 1114 -->

<!-- Start: Assign Permissions: PM 1115 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt4 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1115 ");
    $stmt4->bind_result($On_OFF);
    $stmt4->execute();
   
    while ($stmt4->fetch()){
        

     }
    
   
    
             if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>

<dl class="dl-horizontal">
  <dt>Delete Students Details</dt>
  <dd>
      
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1115&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=1" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1115&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=1" class="btn btn-success btn-flat" >OFF</a>       

  </dd>
</dl>


<!-- END: Assign Permissions: PM 1115 -->

<!-- Start: Assign Permissions: PM 1116 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt5 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1116 ");
    $stmt5->bind_result($On_OFF);
    $stmt5->execute();
   
    while ($stmt5->fetch()){
        

     }
    
   
    
             if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>

<dl class="dl-horizontal">
  <dt>Student Attendance</dt>
  <dd>
      
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1116&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=1" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1116&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=1" class="btn btn-success btn-flat" >OFF</a>       

  </dd>
</dl>


<!-- END: Assign Permissions: PM 1116 -->

<!-- Start: Assign Permissions: PM 1130 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt19 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1130 ");
    $stmt19->bind_result($On_OFF);
    $stmt19->execute();
   
    while ($stmt19->fetch()){
        

     }
    
   
    
             if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>

<dl class="dl-horizontal">
  <dt>Removed Students</dt>
  <dd>
      
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1130&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=1" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1130&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=1" class="btn btn-success btn-flat" >OFF</a>       

  </dd>
</dl>


<!-- END: Assign Permissions: PM 1130 -->



                  </div><!-- /.tab-pane1 -->
                         
                                   
<div class="tab-pane <?php echo $aciveTab2; ?>" id="<?php echo $TabID2; ?>">
<!-- Start: Assign Permissions: PM 1117 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt6 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1117 ");
    $stmt6->bind_result($On_OFF);
    $stmt6->execute();
   
    while ($stmt6->fetch()){
        

     }
    
   
    
             if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>
 
<dl class="dl-horizontal">
  <dt>Student Allocation</dt>
  <dd>
      
  <a href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1117&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=2" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
  <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1117&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=2" class="btn btn-success btn-flat" >OFF</a>       
 
  </dd>
</dl>


<!-- END: Assign Permissions: PM 1117 -->

         
<!-- Start: Assign Permissions: PM 1118 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt7 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1118 ");
    $stmt7->bind_result($On_OFF);
    $stmt7->execute();
   
    while ($stmt7->fetch()){
        

     }
    
   
    
             if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>

<dl class="dl-horizontal">
  <dt>View Allocated Students</dt>
  <dd>
      
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1118&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=2" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1118&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=2" class="btn btn-success btn-flat" >OFF</a>       

  </dd>
</dl>


<!-- END: Assign Permissions: PM 1118 -->

 

<!-- Start: Assign Permissions: PM 1119 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt8 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1119 ");
    $stmt8->bind_result($On_OFF);
    $stmt8->execute();
   
    while ($stmt8->fetch()){
        

     }
    
   
    
             if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>

<dl class="dl-horizontal">
  <dt>View Payments</dt>
  <dd>
      
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1119&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=2" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1119&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=2" class="btn btn-success btn-flat" >OFF</a>       

  </dd>
</dl>


<!-- END: Assign Permissions: PM 1119 -->

<!-- Start: Assign Permissions: PM 1120 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt9 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1120 ");
    $stmt9->bind_result($On_OFF);
    $stmt9->execute();
   
    while ($stmt9->fetch()){
        

     }
    
   
    
             if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>

<dl class="dl-horizontal">
  <dt>Edit Subjects</dt>
  <dd>
      
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1120&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=2" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1120&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=2" class="btn btn-success btn-flat" >OFF</a>       

  </dd>
</dl>


<!-- END: Assign Permissions: PM 1120 -->

<!-- Start: Assign Permissions: PM 1129 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt18 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1129 ");
    $stmt18->bind_result($On_OFF);
    $stmt18->execute();
   
    while ($stmt18->fetch()){
        

     }
    
   
    
             if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>

<dl class="dl-horizontal">
  <dt>Main Subject Level</dt>
  <dd>
      
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1129&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=2" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1129&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=2" class="btn btn-success btn-flat" >OFF</a>       

  </dd>
</dl>


<!-- END: Assign Permissions: PM 1129 -->


<!-- Start: Assign Permissions: PM 1133 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmtAddSubj = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1133 ");
    $stmtAddSubj->bind_result($On_OFF);
    $stmtAddSubj->execute();
   
    while ($stmtAddSubj->fetch()){
        

     }
    
   
    
             if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>

<dl class="dl-horizontal">
    <dt>Add Subject</dt>
  <dd>
      
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1133&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=2" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1133&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=2" class="btn btn-success btn-flat" >OFF</a>       
         
  </dd>
</dl>


<!-- END: Assign Permissions: PM 1133 -->


<!-- Start: Assign Permissions: PM 1134 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmtAddLec = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1134 ");
    $stmtAddLec->bind_result($On_OFF);
    $stmtAddLec->execute();
   
    while ($stmtAddLec->fetch()){
        

     }
    
   
    
             if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>

<dl class="dl-horizontal">
    <dt>Add Lecturers</dt>
  <dd>
      
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1134&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=2" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1134&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=2" class="btn btn-success btn-flat" >OFF</a>       
        
  </dd>
</dl>


<!-- END: Assign Permissions: PM 1134 -->


<!-- Start: Assign Permissions: PM 1135 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmtViewLec = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1135");
    $stmtViewLec->bind_result($On_OFF);
    $stmtViewLec->execute();
   
    while ($stmtViewLec->fetch()){
        

     }
    
   
    
             if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>

<dl class="dl-horizontal">
  <dt>View all Lecturers</dt>
  <dd>
      
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1135&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=2" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1135&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=2" class="btn btn-success btn-flat" >OFF</a>       

  </dd>
</dl>


<!-- END: Assign Permissions: PM 1135 -->


</div><!-- /.tab-pane2 -->
                             
                  
<div class="tab-pane <?php echo $aciveTab3; ?>" id="<?php echo $TabID3; ?>">
    <!-- Start: Assign Permissions: PM 1121 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt10 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1121 ");
    $stmt10->bind_result($On_OFF);
    $stmt10->execute();
   
    while ($stmt10->fetch()){
        

     }
    
   
    
        if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>
 
<dl class="dl-horizontal">
  <dt>Main Dashboard</dt>
  <dd>
      
  <a href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1121&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=3" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
  <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1121&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=3" class="btn btn-success btn-flat" >OFF</a>       
 
  </dd>
</dl>


<!-- END: Assign Permissions: PM 1121 -->

         
<!-- Start: Assign Permissions: PM 1122 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt11 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1122 ");
    $stmt11->bind_result($On_OFF);
    $stmt11->execute();
   
    while ($stmt11->fetch()){
        

     }
    
   
    
             if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>

<dl class="dl-horizontal">
    <dt>Reports Dashboard</dt>
  <dd>
      
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1122&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=3" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1122&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=3" class="btn btn-success btn-flat" >OFF</a>       
         
  </dd>
</dl>


<!-- END: Assign Permissions: PM 1122 -->

                  </div><!-- /.tab-pane3 -->
                  
                  
<div class="tab-pane <?php echo $aciveTab4; ?>" id="<?php echo $TabID4; ?>">
    <!-- Start: Assign Permissions: PM 1123 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt12 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1123 ");
    $stmt12->bind_result($On_OFF);
    $stmt12->execute();
   
    while ($stmt12->fetch()){
        

     }
    
   
    
        if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>
 
<dl class="dl-horizontal">
  <dt>Add User</dt>
  <dd>
      
  <a href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1123&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=4" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
  <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1123&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=4" class="btn btn-success btn-flat" >OFF</a>       
 
  </dd>
</dl>


<!-- END: Assign Permissions: PM 1123 -->

         
<!-- Start: Assign Permissions: PM 1124 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt13 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1124 ");
    $stmt13->bind_result($On_OFF);
    $stmt13->execute();
   
    while ($stmt13->fetch()){
        

     }
    
   
    
             if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>

<dl class="dl-horizontal">
  <dt>View All Users</dt>
  <dd>
      
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1124&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=4" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1124&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=4" class="btn btn-success btn-flat" >OFF</a>       

  </dd>
</dl>


<!-- END: Assign Permissions: PM 1124 -->

<!-- Start: Assign Permissions: PM 1125 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt14 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1125 ");
    $stmt14->bind_result($On_OFF);
    $stmt14->execute();
   
    while ($stmt14->fetch()){
        

     }
    
   
    
        if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>

<dl class="dl-horizontal">
  <dt>Assign Permission</dt>
  <dd>
      
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1125&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=4" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1125&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=4" class="btn btn-success btn-flat" >OFF</a>       

  </dd>
</dl>


<!-- END: Assign Permissions: PM 1125 -->

<!-- Start: Assign Permissions: PM 1128 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt17 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1128 ");
    $stmt17->bind_result($On_OFF);
    $stmt17->execute();
   
    while ($stmt17->fetch()){
        

     }
    
   
    
        if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>

<dl class="dl-horizontal">
  <dt>Edit User</dt>
  <dd>
      
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1128&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=4" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1128&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=4" class="btn btn-success btn-flat" >OFF</a>       

  </dd>
</dl>


<!-- END: Assign Permissions: PM 1128 -->



                  </div><!-- /.tab-pane4 -->
                  

<div class="tab-pane <?php echo $aciveTab5; ?>" id="<?php echo $TabID5; ?>">
    <!-- Start: Assign Permissions: PM 1126 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt15 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1126 ");
    $stmt15->bind_result($On_OFF);
    $stmt15->execute();
   
    while ($stmt15->fetch()){
        

     }
    
   
    
        if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>
 
<dl class="dl-horizontal">
  <dt>Announcements</dt>
  <dd>
      
  <a href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1126&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=5" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
  <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1126&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=5" class="btn btn-success btn-flat" >OFF</a>       
 
  </dd>
</dl>


<!-- END: Assign Permissions: PM 1126 -->


<!-- Start: Assign Permissions: PM 1132 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt21 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1132 ");
    $stmt21->bind_result($On_OFF);
    $stmt21->execute();
   
    while ($stmt21->fetch()){
        

     }
    
   
    
             if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>

<dl class="dl-horizontal">
  <dt>Send SMS</dt>
  <dd>
      
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1132&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=5" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1132&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=5" class="btn btn-success btn-flat" >OFF</a>       

  </dd>
</dl>


<!-- END: Assign Permissions: PM 1132 -->


                  </div><!-- /.tab-pane5 -->

<div class="tab-pane <?php echo $aciveTab6; ?>" id="<?php echo $TabID6; ?>"> <!-- /.tab-pane6 -->
    <!-- Start: Assign Permissions: PM 1992 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt10 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1992 ");
    $stmt10->bind_result($On_OFF);
    $stmt10->execute();
   
    while ($stmt10->fetch()){
        

     }
    
   
    
        if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>
 
<dl class="dl-horizontal">
  <dt>Disable Student Menu</dt>
  <dd>
      
  <a href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1992&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=6" class="btn <?php echo $btn_colour; ?> btn-flat" >Enable</a>
  <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1992&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=6" class="btn btn-success btn-flat" >Disable</a>       
 
  </dd>
</dl>


<!-- END: Assign Permissions: PM 1992 -->

         
<!-- Start: Assign Permissions: PM 1993 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt11 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1993 ");
    $stmt11->bind_result($On_OFF);
    $stmt11->execute();
   
    while ($stmt11->fetch()){
        

     }
    
   
    
             if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>

<dl class="dl-horizontal">
    <dt>Disable Lecturer Menu</dt>
  <dd>
      
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1993&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=6" class="btn <?php echo $btn_colour; ?> btn-flat" >Enable</a>
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1993&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=6" class="btn btn-success btn-flat" >Disable</a>       
         
  </dd>
</dl>


<!-- END: Assign Permissions: PM 1993 -->

<!-- Start: Assign Permissions: PM 1994 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt11 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1994 ");
    $stmt11->bind_result($On_OFF);
    $stmt11->execute();
   
    while ($stmt11->fetch()){
        

     }
    
   
    
             if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>

<dl class="dl-horizontal">
    <dt>Disable Subject Menu</dt>
  <dd>
      
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1994&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=6" class="btn <?php echo $btn_colour; ?> btn-flat" >Enable</a>
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1994&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=6" class="btn btn-success btn-flat" >Disable</a>       
         
  </dd>
</dl>


<!-- END: Assign Permissions: PM 1994 -->



<!-- Start: Assign Permissions: PM 1995 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt11 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1995 ");
    $stmt11->bind_result($On_OFF);
    $stmt11->execute();
   
    while ($stmt11->fetch()){
        

     }
    
   
    
             if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>

<dl class="dl-horizontal">
    <dt>Disable Report Menu</dt>
  <dd>
      
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1995&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=6" class="btn <?php echo $btn_colour; ?> btn-flat" >Enable</a>
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1995&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=6" class="btn btn-success btn-flat" >Disable</a>       
         
  </dd>
</dl>


<!-- END: Assign Permissions: PM 1995 -->


<!-- Start: Assign Permissions: PM 1996 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt11 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1996 ");
    $stmt11->bind_result($On_OFF);
    $stmt11->execute();
   
    while ($stmt11->fetch()){
        

     }
    
   
    
             if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>

<dl class="dl-horizontal">
    <dt>Disable Tools Menu</dt>
  <dd>
      
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1996&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=6" class="btn <?php echo $btn_colour; ?> btn-flat" >Enable</a>
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1996&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=6" class="btn btn-success btn-flat" >Disable</a>       
         
  </dd>
</dl>


<!-- END: Assign Permissions: PM 1996 -->


<!-- Start: Assign Permissions: PM 1997 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt11 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1997 ");
    $stmt11->bind_result($On_OFF);
    $stmt11->execute();
   
    while ($stmt11->fetch()){
        

     }
    
   
    
             if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>

<dl class="dl-horizontal">
    <dt>Disable User Menu</dt>
  <dd>
      
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1997&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=6" class="btn <?php echo $btn_colour; ?> btn-flat" >Enable</a>
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1997&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=6" class="btn btn-success btn-flat" >Disable</a>       
         
  </dd>
</dl>


<!-- END: Assign Permissions: PM 1997 -->



<!-- Start: Assign Permissions: PM 1998 -->
 <?php
 
   
    
 
     //This will select the settings value with database (1 or 0) under the setting_id                               
    $stmt11 = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1998 ");
    $stmt11->bind_result($On_OFF);
    $stmt11->execute();
   
    while ($stmt11->fetch()){
        

     }
    
   
    
        if($On_OFF =='1') {
            $btn_colour = "btn-danger";
        } else {
            
            $btn_colour = "btn-success";
        }
 
 ?>

<!--<dl class="dl-horizontal">
    <dt>Disable Lecturer Dash</dt>
  <dd>
      
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php //echo $UserID; ?>&UserName=<?php //echo $UserName; ?>&PMID=1998&ONOFF=1&PageNo=<?php //echo $PNo; ?>&tab=6" class="btn <?php //echo $btn_colour; ?> btn-flat" >Enable</a>
         <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php //echo $UserID; ?>&UserName=<?php //echo $UserName; ?>&PMID=1998&ONOFF=0&PageNo=<?php //echo $PNo; ?>&tab=6" class="btn btn-success btn-flat" >Disable</a>       
         
  </dd>
</dl>-->


<!-- END: Assign Permissions: PM 1998 -->

                  </div><!-- /.tab-pane6 -->                  
                  
                  
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div>
                      
                      





            <div class="box-footer">
              
                <div class= "col-lg-6 col-md-12 col-xs-1">
                <a style="margin-top: 5px;" href="index.php?page=ViewAllUsers&PageNo=<?php echo $PNo; ?>" class="btn  btn-danger">View All Users </a>
                
                </div>                 
                   
                     
            </form>      
            </div><!-- /.box-body -->
            

          <!-- /.box -->

        </section><!-- /.content -->
        <?php   
        
        }  
        
        ?>  
      </div><!-- /.content-wrapper -->

 <?php
 } else { 
    header('Location: login.php');
}

 
 ?>