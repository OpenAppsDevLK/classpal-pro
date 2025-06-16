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
    <title>Total Lecturers</title>
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
              <i class="fa fa-users"></i> Report: Total Lecturers 
              <small class="pull-right">Report Created Date: <?php echo date('Y-m-d'); ?></small>
            </h2>
          </div><!-- /.col -->
        </div>
        <!-- info row -->
        <?php

     
    //This will show the Student details
    $stmt = $db->prepare("SELECT id, lec_id, lec_regdate, lec_name, lec_address, lec_sex, lec_mob, lec_notes FROM `cp_lecturers`");
    $stmt->bind_result($id, $lec_id, $lec_regdate, $lec_name, $lec_address, $lec_sex, $lec_mob, $lec_notes);
    $stmt->execute();
        
        
        ?>
        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table id="vas_table" class="table table-hover table-bordered table-responsive">

                         
                    <thead>
                      <tr>
                        <th>Lecturer ID</th>
                        <th>Lecturer Name</th>
                        <th>Lecturer Reg. Date</th>
                        <th>Address</th>
                        <th>Sex</th>
                        <th>Mobile No</th>
                        <th>Notes</th>
                      </tr>
                    </thead>
                    <tbody>


                    <?php
                     while ($stmt->fetch()){
                    ?>
                        
                        
                      <tr>


                        
                        <td><?php echo $lec_id; ?></td>
                        <td><?php echo $lec_name;  ?></td>
                        <td><?php echo $lec_regdate; ?></td>
                        <td><?php echo $lec_address; ?></td>
                        <td><?php echo $lec_sex; ?></td>
                        <td><?php echo $lec_mob; ?></td>
                        <td><?php echo $lec_notes; ?></td>
                        
                         
                      

                      </tr>
                   <?php
                     }  
                   
                   ?>
                      
                   </tbody>
                   
                     <tfoot>
                      <tr>
                        <th>Lecturer ID</th>
                        <th>Lecturer Name</th>
                        <th>Lecturer Reg. Date</th>
                        <th>Address</th>
                        <th>Sex</th>
                        <th>Mobile No</th>
                        <th>Notes</th>
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

               $stmt1 = $db->prepare("SELECT COUNT(id) FROM `cp_lecturers` ");
               $stmt1->bind_result($TotalLec);
               $stmt1->execute();

               while ($stmt1->fetch()){
                 
                   
            }

            ?>
                    
                    <th>Total Lecturers: <?php echo $TotalLec; ?></th>
                  
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