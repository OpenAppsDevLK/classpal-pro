<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

// Select the user and assign permission...        
$stmt1113 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1113" ); 
$stmt1113->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1113->execute();

while ($stmt1113->fetch()){ 
    
}


//linked with addpayment.fn.php
$ADDPAYMENT = addpayment();


?>

<script language="javascript" type="text/javascript" >
//This code will runs, select menu to select customs...

function jumpto(x){

if (document.form1.jumpmenu.value != "null") {
	document.location.href = x
	}
}

</script>


<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            
<?php
    if ($cp_userpermission_OnOff == 0){
// If the User not accssign the permission the access will be denied...
//        $Message = "<p class='text-center'>";
//        $Message .= "<img src='Upload/ad.png'>";
        $Message .= "<h1>Access Denied</h1>";
//        $Message .= "Access Denied";
//        $Message .= "</p>";
        echo $Message;
        
    } else {
            
            
?>
            
          <h1>
           Add Payment
            <small>You can add students payments form here...</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Students</a></li>
            <li><a href="#">View All Students</a></li>
            <li class="active">Add Payment</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Student Payment</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
             
           <!-- general form elements disabled -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Student Payment Details</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    
                    <form id="form_studentpayment" name="form_studentpayment" role="form" action="<?php $ADDPAYMENT;  ?>" method="post" enctype="multipart/form-data" >      
                      <!-- text input -->

                      
                    <div class="form-group has-error">
                      <label>Lecturer Name</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-home"></i>
                      </div>                       

                    <input type="text" value="<?php echo $_GET['LecturerID'] . $_GET['LecturerName']; ?>" name="txt_Lecturer_id" class="form-control" placeholder="AUTO" readonly>

                      </div>
                    </div> 
                    <div class="form-group">
                      <label>Receipt No</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-star "></i>
                     </div>
                      <input type="text" value="<?php echo $_GET['ReceiptNo']; ?>" name="txt_RecpID" class="form-control" placeholder="AUTO" readonly>
                      </div>
                      
                    
                    <div class="form-group">
                      <label>Student ID</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                        </div>                       
                           <input type="text" value="<?php echo $_GET['StudentID'] ?>" name="txt_student_id" class="form-control" readonly>
                       </div>
                    </div>
                      
                      
                    <div class="form-group ">
                          <label>Student Name</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>
                            <input type="text"  value="<?php echo $_GET['StudentName']; ?>" name="txt_student_name" class="form-control" readonly>
                       </div>

                    </div>
                      
                    <div class="form-group">
                      <label>Subject ID</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-file-text-o"></i>
                        </div>                       
                           <input type="text" value="<?php echo $_GET['SubjectID']; ?>" name="txt_subject_id" value="<?php echo $AS_Student_ID; ?>" class="form-control" readonly>
                       </div>
                    </div>     
                      
                    <div class="form-group">
                      <label>Subject Name</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-file-text-o"></i>
                        </div>                       
                           <input type="text" value="<?php echo $_GET['SubjectName']; ?>" name="txt_subject_Name" value="<?php echo $AS_Student_ID; ?>" class="form-control" readonly>
                       </div>
                    </div>                                        
                      
                  
                 <div class="form-group has-error">
                    <label>Payment Date [Mob:(D:M:Y) | PC:(M:D:Y)]</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" name="txt_payDate" class="form-control ">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  
                                    
                    <div class="form-group has-error">
                      <label>Payment Month (Ex: 201501)</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-align-justify"></i>
                        </div>
                           <input type="number" value="<?php echo date('Ym'); ?>" class="form-control" name="txt_student_paymonth" autofocus>                       
                       </div>
                    </div>
                  
          
                     <div class="form-group">
                    <label>Subject Fee</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-money"></i>
                      </div>
                
                <?php 
                     
                     $suj_ID = $_GET['SubjectID'];
                     

                    //Select the database Subject Fee
                   $stmt_select_subjfee = $db->prepare("SELECT subj_id, subj_name, subj_classfee FROM `cp_subjects` WHERE `subj_id`=$suj_ID");
                   $stmt_select_subjfee->bind_result($Subj_id, $Subj_Name, $subj_Fee);
                   $stmt_select_subjfee->execute();

 
                        
                   ?>
                       
                            <input type="number" value="<?php  while ($stmt_select_subjfee->fetch()){ echo $subj_Fee; };   ?>" class="form-control" name="txt_student_subjfee" data-cell="A1" data-format=" 0,0[.]00" placeholder="0.00">

                  <?php
                            
                  

                  ?> 
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->               
                  
                  
                  <div class="form-group">
                    <label>Admission</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-money"></i>
                      </div>
                        <input type="number" value="" name="txt_student_admission" class="form-control" data-cell="A2" data-format=" 0,0[.]00" placeholder="0.00">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  
                  <div class="form-group">
                    <label>Total</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-money "></i>
                      </div>
                        <input type="number" class="form-control" value="" name="txt_student_total" data-formula="A1+A2"  placeholder="0.00">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

                         <!-- This code is for calulate forms values.  -->
                           <script type="text/javascript">
                                $('#form_studentpayment').calx();
                            </script>   
                            
                  
        </form>      
           <div class="box-footer">
                <?php
                   //To generate payment ID
                   $ReceiptNo =  rand();
                   
                   if (isset($_GET['PageNo'])){
                       $GotoPage = "index.php?page=ViewAllStudents&PageNo={$_GET['PageNo']}";
                   }  else {
                       
                       $GotoPage = "index.php?page=ViewAllStudents&PageNo=1";
                        
                   }
                ?>

                <div class= "col-lg-6 col-md-12 col-xs-1">
                <input  style="margin-top: 5px;" class="btn  btn-success btn-lg" type="submit" onclick="" value="Add Payment [F2]">
                <a style="margin-top: 5px;" target="_blank" href="output/receipt.php?StudentID=<?php echo $_GET['StudentID']; ?>&StudentName=<?php echo $_GET['StudentName']; ?>&ReceiptNo=<?php echo $_GET['ReceiptNo']; ?>&SubjID=<?php echo $_GET['SubjID']; ?>&SubjName=<?php echo $_GET['SubjName']; ?>" class="btn  btn-primary">Print Receipt</a>
                <a style="margin-top: 5px;" href="index.php?page=AddPayment&StudentID=<?php echo $_GET['StudentID']; ?>&StudentName=<?php echo $_GET['StudentName']; ?>&ReceiptNo=<?php echo $ReceiptNo; ?>&SubjectID=<?php echo $_GET['SubjectID']; ?>&LecturerID=<?php echo $_GET['LecturerID']; ?>&LecturerName=<?php echo $_GET['LecturerName']; ?>&SubjectName=<?php echo $_GET['SubjectName']; ?>&PageNo=<?php echo $_GET['PageNo']; ?>" class="btn  btn-primary">New Payment</a>
                <a style="margin-top: 5px;" href="<?php echo $GotoPage; ?>"  class="btn btn-danger">View All Students</a>
                <!-- <button style="margin-top: 5px;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">View All Students</button> -->
                </div>
            

<script>

//If Javascript to run the Keypress
$(function(){
    //Yes! use keydown 'cus some keys is fired only in this trigger,
    //such arrows keys
    $("body").keydown(function(e){
         //now we caught the key code, yabadabadoo!!
         var keyCode = e.keyCode || e.which;

            if ((e.which || e.keyCode) == 113) {
                
                    //well you need keep on mind that your browser use some keys 
                    //to call some function, so we'll prevent this
                    e.preventDefault();
                    
                    //Triger the submit form after press the key
                    document.form_studentpayment.submit();
                        
                        //Window will reload after sumit
                        window.onload = function() {
                        setTimeout(function () {
                            location.reload()
                        }, 1000);
                     };
        }
         //your keyCode contains the key code, F1 to F12 
         //is among 112 and 123. Just it.
         console.log(keyCode); //You can see the ouput log on browser console  
    });
});


</script>

          
            </div><!-- /.box-footer-->   
                     
            </form>      
            </div><!-- /.box-body -->
            

          </div><!-- /.box -->
          Only Show 10 Payments. 
  <div class="box-body table-responsive no-padding">
                  
                   
                   <table id="vas_table" class="table table-hover table-bordered table-responsive">
                         
                         
                    <thead>
                      <tr>
                        <th>Pay ID</th>
                        <th>Subject Name</th>
                        <th>Payment Date</th>
                        <th>Payment Month</th>
                        <th>Amount</th>
                        

                      </tr>
                    </thead>
                    <tbody>

                        <?php
                        
                        $Student_ID = $_GET['StudentID'];
                        $SubjID = $_GET['SubjectID'];
                        $SubjName = $_GET['SubjectName'];

                        $stmt = $db->prepare("SELECT pay_id, Pay_stu_studentID, pay_student_name, pay_subj_id, pay_paymentdate, pay_paymentmonth, pay_cos_fee, pay_cos_admi, pay_cos_total FROM `cp_payments` WHERE Pay_stu_studentID= $Student_ID AND pay_subj_id=$SubjID ORDER BY pay_paymentmonth DESC LIMIT 10") ;
                        $stmt->bind_result($adp_pay_id, $adp_Pay_stu_studentID, $adp_pay_student_name, $adp_pay_subj_id, $adp_pay_paymentdate, $adp_pay_paymentmonth, $adp_pay_cos_fee, $adp_pay_cos_admi, $adp_pay_cos_total);
                        $stmt->execute();

                        while ($stmt->fetch()){
  
  
      
                
                        ?>
                    
                        
                      <tr>
                        
                         <td><?php echo $adp_pay_id;  ?></td>
                         <td><?php  echo $SubjName; ?></td>
                         <td><?php echo $adp_pay_paymentdate;  ?></td>
                         <td><?php echo $adp_pay_paymentmonth;  ?></td>
                         <td><?php echo $adp_pay_cos_total;  ?></td>
                         
                      

                      </tr>
                      <?php } ?>
                      
                   </tbody>
                   
                     <tfoot>
                      <tr>
                        <th>Pay ID</th>
                        <th>Subject Name</th>
                        <th>Payment Date</th>
                        <th>Payment Month</th>
                        <th>Amount</th>
                        
                        
                      </tr>
                                    
                    </tfoot>
                     
                  </table> 
               

               
              
               
               
            </div><!-- /.box-footer-->  
            
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