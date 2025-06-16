<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
include_once '../../php-includes/connect.inc.php'; 

    $receiptid = $_GET['ReceiptNo'];

    //This will show the course details
    $stmt = $db->prepare("SELECT pay_paymentdate, pay_paymentmonth, pay_cos_fee, pay_cos_admi, pay_cos_total FROM `cp_payments` WHERE pay_id=$receiptid");
    $stmt->bind_result($pay_paymentdate, $pay_paymentmonth, $pay_cos_fee, $pay_cos_admi, $pay_cos_total);
    $stmt->execute();

 while ($stmt->fetch()){
     $pay_cos_fee = number_format($pay_cos_fee, 2, '.', ''); 
     $pay_cos_admi = number_format($pay_cos_admi, 2, '.', ''); 
     $pay_cos_total = number_format($pay_cos_total, 2, '.', ''); 
     
 }
?>




<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Receipt</title>
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
    <script>

        window.print();
    </script>
    

    <style>
        @media print {
            a.no-print {
                display: none;
            }
        }
    </style>
    
  </head>
  
  <!-- onload="window.print();" -->
  <body>
     
<script>
//Non Javascript code to close window...
window.onkeydown = function( event ) {
    if ( event.keyCode == 27 ) {
        window.close();
    }
};


</script>

    <div class="wrapper">
      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
              <i class="">        
</i>Student Receipt
            </h2>
          </div><!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
            <p>Student ID : <br /><span style="font-weight: bold;"><?php echo $_GET['StudentID'] ?></span>
                <br />Student Name: <br /><span style="font-weight: bold;"> <?php echo $_GET['StudentName'] ?></span>
                <br />Receipt No : <br /><span style="font-weight: bold;"><?php echo $_GET['ReceiptNo'] ?></span>
                <br />Paid Date : <br /><span style="font-weight: bold;"><?php echo $pay_paymentdate; ?></span>
                <br />Paid Month :<br /><span style="font-weight: bold;"><?php echo $pay_paymentmonth; ?></span>
            </p>
          </div><!-- /.col -->
          <div class="col-sm-4 invoice-col">
            
            
          </div><!-- /.col -->
        </div><!-- /.row -->

        <hr>
        <br>
        
        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Subject Name</th>
                  <th>Subject Fee (Rs)</th>
                  <th>Admission (Rs)</th>
                  <th>Total (Rs)</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $_GET['SubjName'] ?></td>
                  <td><?php echo $pay_cos_fee;  ?></td>
                  <td><?php echo $pay_cos_admi; ?></td>
                  <td><?php echo $pay_cos_total; ?></td>
                </tr>
              </tbody>
            </table>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <hr>
        
        <div class="row">      
          <div class="col-xs-6">
            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th>Total:</th>
                  <td><?php echo $pay_cos_total; ?></td>
                </tr>
              </table>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <a class="no-print btn btn-danger" href="../index.php?page=ViewAllStudents&PageNo=1"><< Back</a>
      </section><!-- /.content -->
    </div><!-- ./wrapper -->


   
    
    
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>    



  </body>
</html>

<?php
// If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


?>