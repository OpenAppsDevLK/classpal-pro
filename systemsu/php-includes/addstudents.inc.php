<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

//Check the total students to limite the entry...
$limiteStudents = $db->prepare("SELECT count(stu_ID) FROM cp_students");
$limiteStudents->bind_result($rowcount);
$limiteStudents->execute();

while ($limiteStudents->fetch()){

 }
                
// Select the user and assign permission...        
$stmt1111 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1111" ); 
$stmt1111->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1111->execute();

while ($stmt1111->fetch()){ 
    
}

            
//linked with addstudent.fn.php
$ADDSTUDENT = addstudent();


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
            Add Student
            <small>You can add students details form here...</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Student Registration Details</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">

                    
                    <form id="form_addstudent" style="" role="form" action="<?php $ADDSTUDENT;  ?>" method="post" enctype="multipart/form-data" >
                    <!-- text input -->
                    <div class="form-group">
                      <label>ID</label>
                      <input type="text" name="txt_AutoID" class="form-control" placeholder="AUTO" readonly>
                    </div>
                    
                    
                    <?php
                                $a = mt_rand(100000,1000000); 
                                $AutoNuber = $a + 159357;
                    ?>
                    
                    
                    <div class="form-group">
                      <label>Student ID</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                        </div>                       
                           <input type="text" name="txt_student_id" value="<?php echo $AutoNuber; ?>" class="form-control ">
                       </div>
                    </div>
                    
                    <div class="form-group">
                      <label>Barcode</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                        </div>                       
                            <textarea class="form-control" name="txt_student_barcode" rows="1"></textarea>                       </div>
                    </div>
                    
                     <div class="form-group">
                         <label>Student Photo link (Please COPY and PAST your photo <span style="color: red;">DIRECT LINK</span> here. Size 320x240)</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>                       
                            <textarea class="form-control" name="txt_student_Photo" rows="1"></textarea></div>
                            <button style=" margin-top: 10px;" type="button" class="btn btn-info" onclick="javascript:void window.open('https://postimages.org/','1473862735520','width=700,height=965,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;" >Upload Student Photo</button>

                    </div>                    
                  <div class="form-group">
                    <label>Registration Date* (M:D:Y)</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                        <input type="date" name="txt_regDate" value="<?php echo date('Y-m-d') ?>" class="form-control pull-right" required>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

                     <div class="form-group">
                          <label>Student Name*</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>
                        <input type="text" name="txt_student_name" class="form-control" required>
                       </div>

                    </div>
                  
                                    
                    <div class="form-group">
                      <label>Address</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-align-justify"></i>
                        </div>
                      <textarea class="form-control" name="txt_student_address" rows="3"></textarea>
                       </div>
                    </div>
                    
                    
              
                    <div class="form-group">
                      <label>Sex</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-venus-mars"></i>
                      </div>                       
                      <select name="txt_student_sex" class="form-control">
                        <option>Male</option>
                        <option>Female</option>
                      </select>
                      </div>
                    </div>
                  
                  <div class="form-group">
                    <label>Birth Date (2020-07-22)</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                        <input type="text" name="txt_BDate" class="form-control">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->                
                                      
                     <div class="form-group">
                    <label>Home Phone Number</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                      </div>
                        <input type="text" class="form-control" name="txt_student_hmphone">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->               
                  
                  
                  <div class="form-group">
                    <label>Mobile Number 01*</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-mobile"></i>
                      </div>
                        <input type="text" name="txt_student_Mno01" class="form-control" required>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  
                  <div class="form-group">
                    <label>Mobile Number 02</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-mobile "></i>
                      </div>
                      <input type="text" class="form-control" name="txt_student_Mnub02">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

                  <div class="form-group">
                    <label>Email</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-envelope"></i>
                      </div>
                        <input type="email" name="txt_student_email" class="form-control" >
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  
                  <div class="form-group">
                    <label>School Name</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-university"></i>
                      </div>
                        <input type="text" name="txt_student_school" class="form-control" >
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  
                 
                   <div class="form-group">
                      <label>Notes</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-pencil "></i>
                      </div>                       
                      <textarea class="form-control" name="txt_student_notes" rows="4"></textarea>
                      </div>
                   </div>
 
                  <?php
                  $b = mt_rand(10000,100000); 
                  ?>
                  <div class="form-group">
                    <label>Access Key</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                      </div>
                        <input type="text" value="<?php echo $b; ?>" name="txt_student_accesskey" class="form-control" readonly>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->   
           <div class="box-footer">
              
                <div class= "col-lg-6 col-md-12 col-xs-1">
                <input  style="margin-top: 5px;" class="btn  btn-success btn-lg" name="btn_AddStu_submit" type="submit" onclick="" value="Register this Student">                    
                <input style="margin-top: 5px;" class="btn  btn-primary" type="reset" value="New">
                <a style="margin-top: 5px;" href="index.php?page=ViewAllStudents" class="btn  btn-danger">View All Students </a>
                
                </div>                     
            </form>      
            </div><!-- /.box-body -->
            

          </div><!-- /.box -->

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