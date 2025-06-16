<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

// Select the user and assign permission...       
$stmt1126 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1126" ); 
$stmt1126->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1126->execute();

while ($stmt1126->fetch()){ 
    
}

//linked with adddailycalssses.fn.php
$ADDDAILYCLASS = adddailyclass();


?>


<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">  
<?php
    if ($cp_userpermission_OnOff == 0){

//        $Message = "<p class='text-center'>";
//        $Message .= "<img src='Upload/ad.png'>";
        $Message .= "<h1>Access Denied</h1>";
//        $Message .= "Access Denied";
//        $Message .= "</p>";
        echo $Message;
        
    } else {
            
            
?>
            
          <h1>
            Daily Classes
            <small>You can edit Daily Classes of the institute form here...</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Subjects</a></li>
            <li class="active">Daily Classes</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
         
            <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Daily Class</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
             
           <!-- general form elements disabled -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Class Details</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <!-- text input -->
                              
         
                    <form id="form_addstudent" role="form" action="<?php $ADDDAILYCLASS;  ?>" method="post" enctype="multipart/form-data" >
                              
                   
                    <div class="form-group">
                      <label>ID</label>
                      <input type="text" name="txt_AutoID" value="" class="form-control" placeholder="AUTO" readonly>
                    </div>
                    
                 <div class="form-group">
                  <label>Class Name</label>
                   <div class="input-group">
                    <div class="input-group-addon">
                    <i class="fa fa-key"></i>
                    </div>                       
                       <input type="text" name="txt_class_name" class="form-control" required autofocus>
                   </div>
                </div> 
                    
                  <?php 

                    //This will show the subject details
                    $stmt5 = $db->prepare("SELECT subj_id, subj_name, subj_classfee FROM `cp_subjects`");
                    $stmt5->bind_result($Subj_id, $Subj_Name, $subj_Fee);
                    $stmt5->execute();

                  ?>
                    
                    <label style="color: red;">Select Subject Name</label>
                    <div class="input-group has-error">
                    <div class="input-group-addon">
                    <i class="fa fa-book"></i>
                    </div>                  
                      <select class="form-control" name="txt_subj_name" >
                         <option value="" disabled selected><?php echo $_GET['SubjID'] . " ". $_GET['SubjName'] ?></option>
                          <?php
                          
                          if (isset($_GET['SubjID'])){
                              $Subj_id1 = $_GET['SubjID'];
                              $Subj_Name2 = $_GET['SubjName'];
                              
                          }
                          
                          
                          while ($stmt5->fetch()){
                              
                          
                         ?>
                         <option value="<?php echo $Subj_id  ?>"> <?php echo $Subj_Name; ?></option>

                        <?php
                        }
                        ?>
                      </select>
                          
                    
                        
                        
                    </div>

                  <?php 

                    //This will show the subject details
                    $stmt6 = $db->prepare("SELECT lec_id, lec_name FROM `cp_lecturers`");
                    $stmt6->bind_result($lec_id, $lec_name);
                    $stmt6->execute();

                  ?>
                    
                    <label style="color: red;">Select Lecturer Name</label>
                    <div class="input-group has-error">
                    <div class="input-group-addon">
                    <i class="fa fa-book"></i>
                    </div>   
                      <select class="form-control" name="txt_lect_name">
                         <option value="" disabled selected><?php echo $_GET['LecturerID'] . " ". $_GET['LecturerName'] ?></option>
                          <?php
                          
                          if (isset($_GET['LecturerID'])){
                              $Lecturer_id = $_GET['LecturerID'];
                              $LecturerName = $_GET['LecturerName'];
                              
                              $Subj_id1 = $_GET['SubjID'];
                              $Subj_Name2 = $_GET['SubjName'];
                              
                          }
                          
                          
                          while ($stmt6->fetch()){
                              
                          
                         ?>
                         <option value="<?php echo $lec_id;  ?>"> <?php echo $lec_name; ?></option>

                        <?php
                        }
                        ?>
                      </select>
                              
                      
                    </div>



                  <?php 

                    //This will show the subject details
                    $stmt6 = $db->prepare("SELECT lec_id, lec_name FROM `cp_lecturers`");
                    $stmt6->bind_result($lec_id, $lec_name);
                    $stmt6->execute();

                  ?>
                    
                    <label style="color: red;">Confirm Lecturer Name</label>
                    <div class="input-group has-error">
                    <div class="input-group-addon">
                    <i class="fa fa-book"></i>
                    </div>   
                      <select class="form-control" name="txt_lect_name_confirm">
                         <option value="" disabled selected><?php echo $_GET['LecturerID'] . " ". $_GET['LecturerName'] ?></option>
                          <?php
                          
                          if (isset($_GET['LecturerID'])){
                              $Lecturer_id = $_GET['LecturerID'];
                              $LecturerName = $_GET['LecturerName'];
                              
                              $Subj_id1 = $_GET['SubjID'];
                              $Subj_Name2 = $_GET['SubjName'];
                              
                          }
                          
                          
                          while ($stmt6->fetch()){
                              
                          
                         ?>
                         <option value="<?php echo $lec_name;  ?>"> <?php echo $lec_name; ?></option>

                        <?php
                        }
                        ?>
                      </select>
                              
                      
                    </div>
                    
                 <div class="form-group">
                  <label>Class Time</label>
                   <div class="input-group">
                    <div class="input-group-addon">
                    <i class="fa fa-key"></i>
                    </div>                       
                       <input type="text" name="txt_class_time" class="form-control" required>
                   </div>
                </div> 

   
           
       
             
           <div class="box-footer">
              
            <div class= "col-lg-6 col-md-12 col-xs-1">
            <input  style="margin-top: 5px;" class="btn  btn-success btn-lg" type="submit" onclick="" name="btn_submit" value="Add This Class" <?php echo $buttonState; ?>>                    
            </div>
               
             </form>  
               
            </div><!-- /.box-footer-->   
                          
            </div><!-- /.box-body -->
              

          </div><!-- /.box -->

        </section><!-- /.content -->
        
        
        
                <!-- Annousments content -->
        <section class="content">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">View All Daily Classes</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
             
           <!-- general form elements disabled -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Classes List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
 
            
             
                              <!-- general form elements disabled -->
              <div class="" id="pagination_controls"><?php echo $paginationCtrls; ?> </div>                     
                <div class="box-body table-responsive no-padding">
                <table id="vas_table" class="table table-hover table-bordered">

                    <thead>
                      <tr>
                          
                        <th>Class Name</th>
                        <th>Class Time</th>
                        <th>Action</th>
                        
                        
                      </tr>
                    </thead>
                    <tbody>

                        <?php
                        
                        $stmt_Select_classes = $db->prepare("SELECT dc_id, dc_class_name, dc_subj_id, dc_lec_id, dc_class_time  FROM `cp_dailyclasses`") ;
                        $stmt_Select_classes->bind_result($dc_id, $dc_class_name, $dc_subj_id, $dc_lec_id, $dc_class_time);
                        $stmt_Select_classes->execute();

                        while ($stmt_Select_classes->fetch()){

                             
                    
                      
                        
                        ?>
                                   
                      <tr>
                        <td >
                            <?php echo $dc_class_name; ?>
                        </td>
                        <td><?php echo $dc_class_time; ?></td>
                        <td>   
                            <button style="margin-top: 5px;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#<?php echo $dc_id; ?>"><span class="fa fa-remove"></span></button> 
                        </td>

                      </tr>

      <!-- Modal -->
<div class="modal fade modal-danger" id="<?php echo $dc_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Remove Class</h4>
      </div>
      <div class="modal-body">
          Do you want to delete this Class from Daily Classes... ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">No</button>
        <a  href="actions/deletedailyclasses.php?DailyClassID=<?php echo $dc_id; ?>" class='btn btn-success btn-flat'>Yes</a>
      </div>
    </div>
  </div>
</div>
                    
                   <?php
                   
                   }
                   
                   ?>
                      
                    </tbody>
                    <tfoot>
                      <tr>
                          
                        <th>Class Name</th>
                        <th>Class Time</th>
                        <th>Action</th>
                        
                      </tr>
                    </tfoot>
 
                  </table>
                   
            </div><!-- /.box-body -->
            

 
            
          </div><!-- /.box -->

        </section><!-- /.content -->
        
 <?php   
 
                    }  
                    
                // Close your database connection and Other Connections...
//               $stmt1126->close();
//               $stmtAnnouncementID->close();
//               $stmt->close();
               $db->close();
               //mysqli_close($db);
 
 ?> 
     
      </div><!-- /.content-wrapper -->
      
<?php
    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: login.php');
}
?>
