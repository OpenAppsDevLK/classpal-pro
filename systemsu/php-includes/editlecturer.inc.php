<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

                
// Select the user and assign permission...        
//$stmt1111 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1111" ); 
//$stmt1111->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
//$stmt1111->execute();
//
//while ($stmt1111->fetch()){ 
//    
//}

            
//linked with updatelecturerdetails.fn.php
$updateLecturer = updatelecturer();

if (isset($_GET['LecturerID'])){
    $LecturerID = $_GET['LecturerID'];
    
?>

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
<?php
     //   if ($cp_userpermission_OnOff == 0){
        
// If the User not accssign the permission the access will be denied...
//        $Message = "<p class='text-center'>";
//        $Message .= "<img src='Upload/ad.png'>";
    //            $Message .= "<h1>Access Denied</h1>";
//        $Message .= "Access Denied";
//        $Message .= "</p>";
//        echo $Message;
        
    //    } else {
            
            
            ?>
          <h1>
            Edit Lecturer
            <small>You can edit lecturer details...</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Lecturer</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
 
                      <?php
                    
                    
                        $stmt = $db->prepare("SELECT id, lec_id, lec_regdate, lec_name, lec_address, lec_sex, lec_mob, lec_notes FROM `cp_lecturers` WHERE `lec_id`= $LecturerID ");
                        $stmt->bind_result($id, $lec_id, $lec_regdate, $lec_name, $lec_address, $lec_sex, $lec_mob, $lec_notes);
                        $stmt->execute();



                        while ($stmt->fetch()){ 

                        }        
        

                                   
                    ?>
                    
                    <form id="form_addstudent" style="" role="form" action="" method="post" enctype="multipart/form-data" >
                    <!-- text input -->
                    <div class="form-group">
                      <label>ID</label>
                      <input type="text" name="txt_AutoID" value="<?php echo $id; ?>" class="form-control" placeholder="AUTO" readonly>
                    </div>

                    <div class="form-group">
                      <label>Lecturer ID</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                        </div>                       
                           <input type="text" name="txt_Lecturer_id" value="<?php echo $lec_id; ?>" class="form-control" readonly>
                       </div>
                    </div>

                  <div class="form-group">
                    <label>Registration Date* (M:D:Y)</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                        <input type="date" name="txt_Lecturer_regDate" value="<?php echo $lec_regdate; ?>" class="form-control pull-right" required>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

                     <div class="form-group">
                          <label>Lecturer Name*</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>
                        <input type="text" name="txt_Lecturer_name" value="<?php echo $lec_name; ?>" class="form-control" required>
                       </div>

                    </div>
                  
                                    
                    <div class="form-group">
                      <label>Address</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-align-justify"></i>
                        </div>
                      <textarea class="form-control" name="txt_Lecturer_address"  rows="3"><?php echo $lec_address; ?></textarea>
                       </div>
                    </div>
                    
                    
              
                    <div class="form-group">
                      <label>Sex</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-venus-mars"></i>
                      </div>                       
                      <select name="txt_Lecturer_sex" class="form-control">
                        <option><?php echo $lec_sex; ?></option>  
                        <option>Male</option>
                        <option>Female</option>
                      </select>
                      </div>
                    </div>
                  
                  <div class="form-group">
                    <label>Mobile Number*</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-mobile"></i>
                      </div>
                        <input type="text" name="txt_Lecturer_Mno01" value="<?php echo $lec_mob; ?>" class="form-control" required>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  
              
                  
                  
                   <div class="form-group">
                      <label>Notes</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-pencil "></i>
                      </div>                       
                      <textarea class="form-control" name="txt_Lecturer_notes" rows="4"><?php echo $lec_notes; ?></textarea>
                      </div>
                   </div>
                  
                  


             
           <div class="box-footer">
              
                <div class= "col-lg-6 col-md-12 col-xs-1">
                <input  style="margin-top: 5px;" class="btn  btn-success btn-lg" name="btn_AddLec_submit" type="submit" onclick="" value="Update this Lecturer Details">                    
                <a style="margin-top: 5px;" href="index.php?page=ViewAllLecturers&PageNo=1" class="btn  btn-danger">View All Lecturers </a>
                
                </div>
            
                    
            </div><!-- /.box-footer-->   
                     
            </form>      
            </div><!-- /.box-body -->


        </section><!-- /.content -->
<?php   

 //}  

$db->close();

}

?>        
      </div><!-- /.content-wrapper -->

 <?php

 
   
// If session isn't meet, user will redirect to login page
} else { 
    header('Location: login.php');
}

 ?>