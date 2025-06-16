<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

// Select the user and assign permission...          
$stmt1114 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1114" ); 
$stmt1114->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1114->execute();

while ($stmt1114->fetch()){ 
    
}


//linked with updatestudentdetils.fn.php
$UPDSTESTUDENT = upadtestudent();


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
            Update Student Details
            <small>You can update students details form here...</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Students</a></li>
            <li><a href="#">View All Students</a></li>
            <li class="active">Update Students</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update Student</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
             
           <!-- general form elements disabled -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Student Registration Details</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form id="form_addstudent" role="form" action="<?php $UPDSTESTUDENT;  ?>" method="post" enctype="multipart/form-data" >
 
                      <?php
 
                      //We will get the studentID from GET request, to find the values in database, and display that values on the forms...

                    if(isset($_GET['StudentID'])){
                       $StudentID = $_GET['StudentID']; 
                       
                     $PNo = $_GET["PageNo"];  
                    
                    //This variable comming from studentreg.fn.php
                    global $UploadName;  
                       
                        $stmt = $db->prepare("SELECT stu_ID, stu_studentID, stu_regdate, stu_studentname, stu_address, stu_sex, stu_bday, stu_con_home, stu_con_mobile1, stu_con_mobile2, stu_email, stu_schoolName, stu_notes, stu_passGrade, stu_image_name, stu_accesskey, stu_barcode FROM `cp_students` WHERE stu_studentID= $StudentID") ;
                        $stmt->bind_result($varID, $varStudentID, $varStuRegDate, $varStuName, $varStuAddress, $varStuSex, $varStuBDay, $varStuConHome, $varStuConMob01, $varStuConMob02, $varStuEmail, $varStuSchoolName, $varStuNotes, $varStuPassGrade, $UploadName, $stu_accesskey, $Stu_Barcode);
                        $stmt->execute();
                    
                        while ($stmt->fetch()){
                            
                            $varID = htmlentities($varID, ENT_QUOTES, "UTF-8");
                            $varStudentID = htmlentities($varStudentID, ENT_QUOTES, "UTF-8");
                            $varStuRegDate = htmlentities($varStuRegDate, ENT_QUOTES, "UTF-8");
                            $varStuName = htmlentities($varStuName, ENT_QUOTES, "UTF-8");
                            $varStuAddress = htmlentities($varStuAddress, ENT_QUOTES, "UTF-8");
                            $varStuSex = htmlentities($varStuSex, ENT_QUOTES, "UTF-8");
                            $varStuConHome = htmlentities($varStuConHome, ENT_QUOTES, "UTF-8");
                            $varStuConMob01 = htmlentities($varStuConMob01, ENT_QUOTES, "UTF-8");
                            $varStuConMob02 = htmlentities($varStuConMob02, ENT_QUOTES, "UTF-8");
                            $varStuEmail = htmlentities($varStuEmail, ENT_QUOTES, "UTF-8");
                            $varStuNotes = htmlentities($varStuNotes, ENT_QUOTES, "UTF-8");
                            $stu_accesskey = htmlentities($stu_accesskey, ENT_QUOTES, "UTF-8");
                            $Stu_Barcode = htmlentities($Stu_Barcode, ENT_QUOTES, "UTF-8");
                            
                            
                            
                        }
                    
                    
                    
                    }
                    
                    
                    ?>
                      
  <div class="row">                    
      <div class="col-md-3">                  
                      
                <div class="form-group">
                           <img  src="<?php echo $UploadName; ?>"  class="img-responsive " id="Uploadimg" name="Uploadimg" style=" margin: 0; width:300px;height:250px; border-radius: 10px;">
                           <h4 class=""><?php echo $varStuName; ?> | <?php echo $varStudentID; ?></h4> 
                       
                           
                </div> 
      
      </div>                

      </div>               
                      
                
                      
                      
                      
                      
                      
                      
                      <!-- text input -->
                    <div class="form-group">
                      <label>ID</label>
                      <input type="text" value="<?php echo $varID; ?>" name="txt_AutoID" class="form-control" placeholder="AUTO" readonly>
                    </div>
                    
                    
                    
                    
                    <div class="form-group">
                      <label>Student ID</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                        </div>                       
                           <input type="text" value="<?php echo $varStudentID; ?>" name="txt_student_id" value="<?php echo $AS_Student_ID; ?>" class="form-control" readonly>
                       </div>
                    </div>
                      
                    <div class="form-group">
                      <label>Barcode (Please enter only 10 digit barcode)</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                        </div>                       
                            <textarea class="form-control" name="txt_student_barcode" rows="1"><?php echo $Stu_Barcode; ?></textarea>                       </div>
                    </div>
                      
                      <div class="form-group">
                        <label>Student Photo link (Please COPY and PAST your photo Direct link here. Size 320x240)</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>                       
                            <textarea class="form-control" name="txt_student_Photo" rows="1"><?php echo $UploadName; ?></textarea>                       </div>
                            <button style=" margin-top: 10px;" type="button" class="btn btn-info" onclick="javascript:void window.open('https://postimages.org/','1473862735520','width=700,height=965,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;" >Upload Student Photo</button>
      
                      </div>

                      
                  <div class="form-group">
                    <label>Registration Date [Mob:(D:M:Y) | PC:(M:D:Y)]</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                        <input type="date" value="<?php echo $varStuRegDate; ?>" name="txt_regDate" class="form-control pull-right ">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

                     <div class="form-group">
                          <label>Student Name</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>
                        <input type="text" value="<?php echo $varStuName; ?>" name="txt_student_name" class="form-control">
                       </div>

                    </div>
                  
                                    
                    <div class="form-group">
                      <label>Address</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-align-justify"></i>
                        </div>
                      <textarea class="form-control" name="txt_student_address" rows="3"><?php echo $varStuAddress; ?></textarea>
                       </div>
                    </div>
                    
                    
              
                    <div class="form-group">
                      <label>Sex</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-venus-mars"></i>
                      </div>                       
                      <select name="txt_student_sex" class="form-control">
                        <option><?php echo $varStuSex; ?></option>
                        <option>Male</option>
                        <option>Female</option>
                      </select>
                      </div>
                    </div>
                  
                  <div class="form-group">
                    <label>Birth Date (M:D:Y)</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                        <input type="text" value="<?php echo $varStuBDay; ?>" name="txt_BDate" class="form-control pull-right ">
                    </div><!-- /.input group -->
                  </div><!-- /.form group --> 
                  
                                      
                     <div class="form-group">
                    <label>Home Phone Number</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                      </div>
                        <input type="text" value="<?php echo $varStuConHome; ?>" class="form-control" name="txt_student_hmphone">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->               
                  
                  
                  <div class="form-group">
                    <label>Mobile Number 01</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-mobile"></i>
                      </div>
                        <input type="text" value="<?php echo $varStuConMob01; ?>" name="txt_student_Mno01" class="form-control">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  
                  <div class="form-group">
                    <label>Mobile Number 02</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-mobile "></i>
                      </div>
                      <input type="text" class="form-control" value="<?php echo $varStuConMob02; ?>" name="txt_student_Mnub02">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

                  <div class="form-group">
                    <label>Email</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-envelope"></i>
                      </div>
                        <input type="email" value="<?php echo $varStuEmail; ?>" name="txt_student_email" class="form-control" >
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  
                  <div class="form-group">
                    <label>School Name</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-university"></i>
                      </div>
                        <input type="text" value="<?php echo $varStuSchoolName; ?>"  name="txt_student_school" class="form-control" >
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                                  
                   <div class="form-group">
                      <label>Notes</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-pencil "></i>
                      </div>                       
                      <textarea class="form-control" name="txt_student_notes" rows="4"><?php echo $varStuNotes; ?></textarea>
                      </div>
                   </div>
                  
                  <div class="form-group">
                    <label>Pass Grade</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-star"></i>
                      </div>
                        <input type="text" value="<?php echo $varStuPassGrade; ?>" name="txt_student_passgrade" class="form-control" >
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

                  <div class="form-group">
                    <label>Access Key</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                      </div>
                        <input type="text" value="<?php echo $stu_accesskey; ?>" name="txt_student_accesskey" class="form-control">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

                  
           <div class="box-footer">
              
               <?php
               
               if(isset($_GET["SearchKey"])){
                   $LINK = "index.php?page=ViewAllStudents&SearchKey={$_GET['SearchKey']}";
                   $ButText = "Go Back to Search";
               }  else {
                   $LINK = "index.php?page=ViewAllStudents&PageNo=$PNo";
                   $ButText = "View All Students";
               }
               
               ?>
                <div class= "col-lg-6 col-md-12 col-xs-1">
                <input  style="margin-top: 5px;" class="btn  btn-success btn-lg" type="submit" onclick="" value="Update this Student">
                <a style="margin-top: 5px;" href="<?php echo $LINK; ?>" class="btn  btn-primary"><?php echo $ButText; ?> </a>
                </div>
            

               
               
            </div><!-- /.box-footer-->   
                     
            </form>      
            </div><!-- /.box-body -->
            

          </div><!-- /.box -->

        </section><!-- /.content -->
         <?php   
         
               }  
         ?> 
      </div><!-- /.content-wrapper -->

       <?php
    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: login.php');
}

      
      ?>