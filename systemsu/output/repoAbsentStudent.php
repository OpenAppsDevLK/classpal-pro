<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

include_once '../../php-includes/connect.inc.php'; 

    $date = $_GET['Date'];
    $BatchNo = $_GET['BatchNo'];
    $SubjID = $_GET['SubjectID'];
    $LecturerID = $_GET['LecturerID'];


?>




<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Attend and Absent Students</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <!-- onload="window.print();" -->
  <body>
    <div class="wrapper">
      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-users"></i> Report: Attend and Absent Students <br> Date: <?php echo $date; ?> | Batch No: <?php echo $BatchNo; ?>
              <small class="pull-right">Report Created Date: <?php echo date('Y-m-d'); ?></small>
            </h2>
          </div><!-- /.col -->
        </div>
        <!-- info row -->
        <?php
       
        //This will show the Student details
        $stmt = $db->prepare("SELECT cp_subj_allo.sa_stu_student_id, cp_subj_allo.sa_stu_student_Name, cp_subj_allo.sa_subj_id, cp_subj_allo.sa_batch_no, cp_attendance.date  FROM `cp_subj_allo` left join `cp_attendance` ON cp_attendance.student_id = cp_subj_allo.sa_stu_student_id AND cp_attendance.date = '$date'  WHERE cp_subj_allo.sa_batch_no='$BatchNo' ORDER BY cp_attendance.date DESC");
        $stmt->bind_result($sa_stu_student_id, $sa_stu_student_Name, $sa_subj_id, $sa_batch_no, $StuAttendate);
        $stmt->execute();

        ?>
        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table id="vas_table" class="table table-hover table-bordered table-responsive">

                         
                    <thead>
                      <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Batch No</th>
                        <th>Attendance Date</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>


                    <?php
                     while ($stmt->fetch()){
                    ?>
                        
                        
                      <tr>


                        
                        <td><?php echo $sa_stu_student_id; ?></td>
                        <td><?php echo $sa_stu_student_Name;  ?></td>
                        <td><?php echo $sa_batch_no; ?></td>
                        <td><?php echo $StuAttendate; ?></td>
                         <td>
                         <?php
                         
                          

                          
                   
                              if ($date == $StuAttendate ){  
                              
                                   echo "<span class='glyphicon glyphicon-ok'></span>";
                               
                               }  else {
                            
                        ?>          
                                   
                                  <span class='glyphicon glyphicon-remove'></span>
                                  <a title="Add Absent" style="<?php echo $DisPlayStyle2; ?>" href="../actions/abs.php?SubjectID=<?php echo $SubjID; ?>&Date=<?php echo $date; ?>&StudentID=<?php echo $sa_stu_student_id; ?>&LecturerID=<?php echo $LecturerID; ?>" class="btn btn-success btn-flat" onclick="javascript:void window.open('../actions/abs.php?SubjectID=<?php echo $SubjID; ?>&Date=<?php echo $date; ?>&StudentID=<?php echo $sa_stu_student_id; ?>&LecturerID=<?php echo $LecturerID; ?>','1473862735520','width=700,height=450,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=250,top=200');return false;" ><i class="fa fa-user-plus" aria-hidden="true"></i></i></a>
                                  <input name="" type="checkbox" style="width:15px; height: 15px; border-radius: 0px;" id="check_list" value="" />

                                    
                        
                        <?php
                            
                               }
                            
                         
                         ?>
                      
                        </td>
                         
                      

                      </tr>
                   <?php
                     }  
                   
                   ?>
                      
                   </tbody>
                   
                     <tfoot>
                      <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Batch No</th>
                        <th>Attendance Date</th>
                        <th>Status</th>
                      </tr>
                                    
                    </tfoot>
                     
                  </table> 
              
              
          </div><!-- /.col -->
        </div><!-- /.row -->
        
        <div class="row">      
          <div class="col-xs-6">
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- ./wrapper -->

    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
  </body>
</html>

<?php
// If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


?>