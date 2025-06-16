<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

include_once '../../php-includes/connect.inc.php'; 


?>




<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lecturer Share </title>
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
        <?php
        
        if(!empty($_GET['SubjectID'])){
            
                $Lec_ID = $_GET['LecID'];
                $Lec_date01 = $_GET['Lecdate01'];
                $Lec_date02 = $_GET['lecdate02'];
                $Lec_Share = $_GET['share'];
                $Lec_Share_subjID = $_GET['SubjectID'];  

    
            //This will show the student ID
            $stmt5 = $db->prepare("SELECT lec_id, lec_name FROM `cp_lecturers` WHERE lec_id = $Lec_ID");
            $stmt5->bind_result($AS_Lec_ID, $AS_Lec_Name);
            $stmt5->execute();
            
             while ($stmt5->fetch()){
                  
                 

              } 
              
        ?>
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-usd"></i> Report: Lecturer Share <br> Lecturer Name: <?php echo $AS_Lec_Name; ?> <br> From <?php echo $Lec_date01; ?> To <?php echo $Lec_date02; ?>
              <small class="pull-right">Report Created Date: <?php echo date('Y-m-d'); ?></small>
            </h2>
          </div><!-- /.col -->
        </div>
        <!-- info row -->
        <?php
       
        //This will show the Student details
        $stmt = $db->prepare("SELECT Pay_stu_studentID, pay_student_name, pay_subj_id, pay_lec_id, pay_paymentdate, pay_paymentmonth, pay_cos_fee, pay_cos_admi, pay_cos_total FROM `cp_payments` WHERE pay_paymentdate BETWEEN '$Lec_date01' AND '$Lec_date02' AND pay_lec_id = $Lec_ID AND pay_subj_id = $Lec_Share_subjID ORDER BY pay_paymentdate DESC");
        $stmt->bind_result($Pay_stu_studentID, $pay_student_name, $pay_subj_id, $pay_lec_id, $pay_paymentdate, $pay_paymentmonth, $pay_cos_fee, $pay_cos_admi, $pay_cos_total);
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
                        <th>Subject ID</th>
                        <th>Payment Date</th>
                        <th>Payment Month</th>
                        <th>Subject Fee</th>
                        <th>Admission</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>


                    <?php
                     while ($stmt->fetch()){
                    ?>
                        
                        
                      <tr>


                        
                        <td><?php echo $Pay_stu_studentID; ?></td>
                        <td><?php echo $pay_student_name;  ?></td>
                        <td><?php echo $pay_subj_id; ?></td>
                        <td><?php echo $pay_paymentdate; ?></td>
                        <td><?php echo $pay_paymentmonth; ?></td>
                        <td>Rs <?php echo $pay_cos_fee ?></td>
                        <td>Rs <?php echo $pay_cos_admi;  ?></td>
                        <td>Rs <?php echo $pay_cos_total; ?></td>
                         
                      

                      </tr>
                   <?php
                     }  
                   
                   ?>
                      
                   </tbody>
                   
                     <tfoot>
                      <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Subject ID</th>
                        <th>Payment Date</th>
                        <th>Payment Month</th>
                        <th>Subject Fee</th>
                        <th>Admission</th>
                        <th>Total</th>
                      </tr>
                                    
                    </tfoot>
                     
                  </table> 
              
              
          </div><!-- /.col -->
        </div><!-- /.row -->
        
        <div class="row">      
          <div class="col-xs-6">
            <div class="table-responsive">
              <table class="table">
                <tr>
              <?php

               $stmt1 = $db->prepare("SELECT SUM(pay_cos_total) FROM cp_payments WHERE pay_paymentdate BETWEEN '$Lec_date01' AND '$Lec_date02' AND pay_lec_id = $Lec_ID AND pay_subj_id = $Lec_Share_subjID");
               $stmt1->bind_result($TotalIncome);
               $stmt1->execute();

               while ($stmt1->fetch()){
                 
                   
            }

            ?>
            </table>          
                    <h4>Total Income: Rs. <?php echo $TotalIncome; ?></h4>
                    <h4>Share: <?php echo $Lec_Share; ?>% </h4>
                    <?php
                    
                        $a = ($TotalIncome * $Lec_Share) / 100;
                    
                    ?>
                    
                    <h4>Lecturer's Share: Rs. <?php echo $a; ?></h4>
              
             
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
        
             <?php
             
                    } else {
                      
            ?>
                       
            <?php 

                $Lec_ID = $_GET['LecID'];
                $Lec_date01 = $_GET['Lecdate01'];
                $Lec_date02 = $_GET['lecdate02'];
                $Lec_Share = $_GET['share'];
                //$Lec_Share_subjID = $_GET['SubjectID'];  
                
            
            //This will show the student ID
            $stmtempty1 = $db->prepare("SELECT lec_id, lec_name FROM `cp_lecturers` WHERE lec_id = $Lec_ID");
            $stmtempty1->bind_result($AS_Lec_ID, $AS_Lec_Name);
            $stmtempty1->execute();
            
             while ($stmtempty1->fetch()){

              } 
              
        		?>
        		
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-usd"></i> Report: Lecturer Share <br> Lecturer Name: <?php echo $AS_Lec_Name; ?> <br> From <?php echo $Lec_date01; ?> To <?php echo $Lec_date02; ?>
              <small class="pull-right">Report Created Date: <?php echo date('Y-m-d'); ?></small>
            </h2>
          </div><!-- /.col -->
        </div>
        <!-- info row -->
        <?php
       
        //This will show the Student details
        $stmtempty2 = $db->prepare("SELECT Pay_stu_studentID, pay_student_name, pay_subj_id, pay_lec_id, pay_paymentdate, pay_paymentmonth, pay_cos_fee, pay_cos_admi, pay_cos_total FROM `cp_payments` WHERE pay_paymentdate BETWEEN '$Lec_date01' AND '$Lec_date02' AND pay_lec_id = $Lec_ID ORDER BY pay_paymentdate DESC");
        $stmtempty2->bind_result($Pay_stu_studentID, $pay_student_name, $pay_subj_id, $pay_lec_id, $pay_paymentdate, $pay_paymentmonth, $pay_cos_fee, $pay_cos_admi, $pay_cos_total);
        $stmtempty2->execute();
    
        
        
        ?>
        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table id="vas_table" class="table table-hover table-bordered table-responsive">

                         
                    <thead>
                      <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Subject ID</th>
                        <th>Payment Date</th>
                        <th>Payment Month</th>
                        <th>Subject Fee</th>
                        <th>Admission</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>


                    <?php
                     while ($stmtempty2->fetch()){
                    ?>
                        
                        
                      <tr>


                        
                        <td><?php echo $Pay_stu_studentID; ?></td>
                        <td><?php echo $pay_student_name;  ?></td>
                        <td><?php echo $pay_subj_id; ?></td>
                        <td><?php echo $pay_paymentdate; ?></td>
                        <td><?php echo $pay_paymentmonth; ?></td>
                        <td>Rs <?php echo $pay_cos_fee ?></td>
                        <td>Rs <?php echo $pay_cos_admi;  ?></td>
                        <td>Rs <?php echo $pay_cos_total; ?></td>
                         
                      

                      </tr>
                   <?php
                     }  
                   
                   ?>
                      
                   </tbody>
                   
                     <tfoot>
                      <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Subject ID</th>
                        <th>Payment Date</th>
                        <th>Payment Month</th>
                        <th>Subject Fee</th>
                        <th>Admission</th>
                        <th>Total</th>
                      </tr>
                                    
                    </tfoot>
                     
                  </table> 
              
              
          </div><!-- /.col -->
        </div><!-- /.row -->
        
        <div class="row">      
          <div class="col-xs-6">
            <div class="table-responsive">
              <table class="table">
                <tr>
              <?php

               $stmtempty3 = $db->prepare("SELECT SUM(pay_cos_total) FROM cp_payments WHERE pay_paymentdate BETWEEN '$Lec_date01' AND '$Lec_date02' AND pay_lec_id = $Lec_ID");
               $stmtempty3->bind_result($TotalIncome);
               $stmtempty3->execute();

               while ($stmtempty3->fetch()){
                 
                   
            }

            ?>
            </table>          
                    <h4>Total Income: Rs. <?php echo $TotalIncome; ?></h4>
                    <h4>Share: <?php echo $Lec_Share; ?>% </h4>
                    <?php
                    
                        $a = ($TotalIncome * $Lec_Share) / 100;
                    
                    ?>
                    
                    <h4>Lecturer's Share: Rs. <?php echo $a; ?></h4>
              
             
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->                        
                    
                        
                        
                        
            <?php            
                        
                    }

     
            ?> 
        
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