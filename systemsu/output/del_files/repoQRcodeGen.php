<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

    //QR Code Generator
    include('../../output/phpqrcode/qrlib.php'); 
    include('../../output/phpqrcode/qrconfig.php'); 


include_once '../../php-includes/connect.inc.php'; 

if (isset($_GET['SubjectID'])) {
     $Subj_ID = $_GET['SubjectID'];
     
     $BatchNo = $_GET['SearchKey'];
    
?>




<!DOCTYPE html>
<html>
  <head>
    <title>QR Code Generator</title>
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
                  <i class="fa fa-users"></i> Report: QR code Generator <br> Subject Name: 
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
         
                     while ($stmt->fetch()){
     
                         $ResNumber = rand();
                         
                        // how to save PNG codes to server 

                           $tempDir = $sa_stu_student_id; 

                           $codeContents1 = "http://maxweem.com/apps/classpal/index.php?page=AddPayment&StudentID=$sa_stu_student_id&StudentName=$sa_stu_student_Name&ReceiptNo=$ResNumber"; 
                           $codeContents2 = "http://maxweem.com/apps/classpal/index.php?page=StudentAttendance&StudentID=$sa_stu_student_id"; 

                           // generating 
                           QRcode::png($codeContents1, $tempDir.'006_L.png', QR_ECLEVEL_L); 
                           QRcode::png($codeContents2, $tempDir.'006_M.png', QR_ECLEVEL_M); 


                           // end displaying 
                       
                       echo '<div align="center">';
                       echo '<table border="1" cellpadding="1" cellspacing="1" style="width:150px;" >';
                       echo '<tbody>';
                       echo '<tr>';
                       echo '<td style="text-align: center;">';
                                   
                                   echo '<p align="center">';
                                   echo '<img src="'.$sa_stu_student_id.'006_L.png" />';
                                   echo '<br>';
                                   echo "$sa_stu_student_id";
                                   echo '<br>';
                                   echo "$sa_stu_student_Name"."(*)";
                                   echo '</p>';
                                   
           

                     echo '</td>';

                     echo '<td style="text-align: center;">';
                            
                                   echo '<p align="center">';
                                    echo '<img src="'.$sa_stu_student_id.'006_M.png" />'; 
                                   echo '<br>';
                                   echo "$sa_stu_student_id";
                                   echo '<br>';
                                   echo "$sa_stu_student_Name"."(a)";
                                   echo '</p>';
                                  
                                   
                       echo '</td>';
                       
                       echo '</tr>';
                       echo '</tbody>';
                       echo ' </table>';
                                      
                       echo '</div>';
                           
                       echo '<br>';
                       echo '<br>';
                       echo '<br>';

                     
                   
                     }  
                   
                   ?>
                      
              
              
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
