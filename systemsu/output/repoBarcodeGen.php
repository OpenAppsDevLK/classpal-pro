<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

include_once '../../php-includes/connect.inc.php'; 

if (isset($_GET['SubjectID'])) {
     $Subj_ID = $_GET['SubjectID'];
     
     $BatchNo = $_GET['SearchKey'];
    
?>




<!DOCTYPE html>
<html>
  <head>
    <title>Barcode Generator</title>
  </head>
  
  <!-- onload="window.print();" -->
  <body>
    <div class="wrapper">
      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
              
              <?php
              
              
             //This will show the student ID
            $stmt5 = $db->prepare("SELECT subj_id, subj_name FROM `cp_subjects` WHERE subj_id = $Subj_ID");
            $stmt5->bind_result($AS_Subj_ID, $AS_Sunj_Name);
            $stmt5->execute();
            
             while ($stmt5->fetch()){
                  
                 

              }  
              
              ?>
              
              <h2 align="center" class="page-header">
                  <i class="fa fa-users"></i> Report: Barcode Generator <br> Subject Name: 
              <?php 
              
              echo $AS_Sunj_Name;
              
              ?> <br> Batch : <?php echo $BatchNo; ?>
              
             
            </h2>
          </div><!-- /.col -->
        </div>
        <!-- info row -->
        <?php

   
     $SearchKey = $_GET['SearchKey'];
     
    //This will show the Student details
    $stmt = $db->prepare("SELECT sa_stu_student_id, sa_stu_student_Name, sa_subj_id, sa_subj_fee, sa_batch_no, sa_notes FROM `cp_subj_allo` WHERE (sa_batch_no LIKE '%{$SearchKey}%') AND sa_subj_id = $Subj_ID ORDER BY sa_stu_student_id ASC");
    $stmt->bind_result($sa_stu_student_id, $sa_stu_student_Name, $sa_subj_id, $sa_subj_fee, $sa_batch_no, $sa_notes);
    $stmt->execute();
        
        
        ?>
        <!-- Table row -->
        <div class="row">
          <div align="center"  class="col-xs-12 table-responsive">



                    <?php
                   
                     while ($stmt->fetch()){
                    ?>
                    <br>
                        <p style="padding:0; margin: 0;">+-----------------------------------------+</p>
                            <div>
                              <img alt="<?php echo $sa_stu_student_id; ?>" src="../../output/barcode/barcode.php?text=<?php echo $sa_stu_student_id; ?>" />  
                              <?php echo $sa_stu_student_id; ?> <br> <?php echo $sa_stu_student_Name; ?>  
                            
                            </div>
                    
                       

                   <?php
                     
                   
                     }  
                   
                   ?>
                      
              
              
          </div><!-- /.col -->
        </div><!-- /.row -->
        
        <div class="row">      
          <div align="center" class="col-xs-6">
            <div class="table-responsive">
              <hr>  
              <table class="table">
                <tr>
              <?php

               $stmt1 = $db->prepare("SELECT COUNT(sa_stu_student_id) FROM cp_subj_allo WHERE (sa_batch_no LIKE '%{$SearchKey}%') AND sa_subj_id = $Subj_ID");
               $stmt1->bind_result($TotalStudents);
               $stmt1->execute();

               while ($stmt1->fetch()){
                 
                   
            }

            ?>
                    
                    <th>Total Students: <?php echo $TotalStudents; ?></th>
                  
                </tr>
              </table>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- ./wrapper -->
<?php
}

// If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}

?>
  </body>
</html>

