<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];



include_once '../../php-includes/connect.inc.php'; 

    //$receiptid = $_GET['ReceiptNo'];

    //This will show the Student details (To hide Recodes from db use AND or WHERE id!=500)
    $stmt = $db->prepare("SELECT pay_id, Pay_stu_studentID, pay_student_name, pay_subj_id, pay_subj_Name, pay_paymentdate, pay_paymentmonth, pay_cos_fee, pay_cos_admi, pay_cos_total FROM `cp_payments` WHERE pay_id!=1 AND pay_id!=2 AND pay_id!=3 AND pay_id!=4 AND pay_id!=5 AND pay_id!=6 AND pay_id!=7 AND pay_id!=8 AND pay_id!=9 AND pay_id!=10 AND pay_id!=11 AND pay_id!=12 ORDER BY pay_paymentdate DESC");
    $stmt->bind_result($pay_id, $Pay_stu_studentID, $pay_student_name, $pay_subj_id, $pay_subj_Name, $pay_paymentdate, $pay_paymentmonth, $pay_cos_fee, $pay_cos_admi, $pay_cos_total);
    $stmt->execute();


?>




<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Total Income</title>
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
              <i class="fa fa-usd"></i> Report: Total Income
              <small class="pull-right">Report Created Date: <?php echo date('Y-m-d'); ?></small>
            </h2>
          </div><!-- /.col -->
        </div>
        <!-- info row -->
        
        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table id="vas_table" class="table table-hover table-bordered table-responsive">

                         
                    <thead>
                      <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Subject ID</th>
                        <th>Subject Name</th>
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
                        <td><?php echo $pay_subj_Name; ?></td>
                        <td><?php echo $pay_paymentdate; ?></td>
                        <td><?php echo $pay_paymentmonth; ?></td>
                        <td><?php echo $pay_cos_fee ?></td>
                        <td><?php echo $pay_cos_admi;  ?></td>
                        <td><?php echo $pay_cos_total; ?></td>
                         
                      

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
                        <th>Subject Name</th>
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

               $stmt1 = $db->prepare("SELECT SUM(pay_cos_total) FROM cp_payments");
               $stmt1->bind_result($TotalIncome);
               $stmt1->execute();

               while ($stmt1->fetch()){
                 
                   
            }

            ?>
                    
                    <th>Total Income: <?php echo $TotalIncome; ?></th>
                  
                </tr>
              </table>
            </div>
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