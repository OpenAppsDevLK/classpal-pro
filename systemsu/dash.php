<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
        
//includes Files
include_once '../php-includes/connect.inc.php';
include_once 'php-includes/header.inc.php';
include_once 'php-includes/topnav.inc.php';
include_once 'php-includes/get-var.inc.php';
include_once 'php-includes/sidebarleft.inc.php'; 




$stmt1121 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1121" ); 
$stmt1121->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1121->execute();

while ($stmt1121->fetch()){ 
    
}



?>

<?php

            

            
?>




      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
 <?php
 
            $stmt2 = $db->prepare("SELECT id, firstname, lastname FROM `cp_users` WHERE id= {$_SESSION['user_id']}"); 
            $stmt2->bind_result($id, $FirstName, $LastName);
            $stmt2->execute();
            
            while ($stmt2->fetch()){ 
                
            }
            
    if ($cp_userpermission_OnOff == 0){

        $Message = "<h1>";
        $Message .= "Welcome $FirstName...!!";
        $Message .= "</h1>";
        echo $Message;
        
    } else {
            
            
?>
            <h1>
        
            Dashboard
            
       <?php
       
            $stmt = $db->prepare("SELECT id, firstname, lastname FROM `cp_users` WHERE id= {$_SESSION['user_id']}"); 
            $stmt->bind_result($id, $FirstName, $LastName);
            $stmt->execute();
            
            while ($stmt->fetch()){ 
             
       ?>
            
            <small>Hi.. <?php echo $FirstName ?>, Welcome to ClassPAL SUPER ADMIN area..!!</small>
            
            
            <?php
            }
            ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
          <div class="row">

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
            <?php
                // Get total sum of payments...
               $stmt2 = $db->prepare("SELECT SUM(pay_cos_total) FROM cp_payments");
               $stmt2->bind_result($TotalIncome);
               $stmt2->execute();

               while ($stmt2->fetch()){
                $TotalIncome = number_format($TotalIncome, 2, '.', ''); 
                   
            }

            ?>
            
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-cash"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Income</span>
                  <span class="info-box-number">Rs. <?php echo $TotalIncome; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
       
            <?php
           
               $Date = date('Ym');
            
               // To get monthly income...
               $stmt3 = $db->prepare("SELECT SUM(pay_cos_total) FROM cp_payments WHERE pay_paymentmonth = $Date");
               $stmt3->bind_result($MonthIncome);
               $stmt3->execute();

               while ($stmt3->fetch()){
               $MonthIncome = number_format($MonthIncome, 2, '.', '');  
                   
            }

            ?>
            
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-social-usd"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">This Month Income</span>
                  <span class="info-box-number">Rs. <?php echo $MonthIncome; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="row">   
            <div class="col-md-12">
              
                <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">MONTHLY INCOME CHART</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body" style="display: block;">
                  <div class="chart">
                    <canvas id="barChart" style="height: 284px; width: 601px;" width="601" height="284"></canvas>
                  </div>
                </div><!-- /.box-body -->
              </div>

            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <div class="col-md-8">
              <!-- MAP & BOX PANE -->
          
              
              <div class="row">
                <div class="col-md-6">
                 
                    
                  
                </div><!-- /.col -->

                
                <div class="col-md-6">
                  <!-- USERS LIST -->
                 
                  
                </div><!-- /.col -->
              </div><!-- /.row -->

  
            </div><!-- /.col -->

          </div><!-- /.row -->
        </section><!-- /.content -->
        <?php   }  ?>  
      </div><!-- /.content-wrapper -->
      
              
<script>
      $(function () {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $("#barChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas);

            <?php
           
               $Year = date('Y');
               
               $JAN = $Year."01";
               $FEB = $Year."02";
               $MAR = $Year."03";
               $APR = $Year."04";
               $MAY = $Year."05";
               $JUN = $Year."06";
               $JUL = $Year."07";
               $AUG = $Year."08";
               $SEP = $Year."09";
               $OCT = $Year."10";
               $NOV = $Year."11";
               $DEC = $Year."12";
               
               //echo $MAR;
               
            
               // To get monthly income...
               $stmtJAN = $db->prepare("SELECT SUM(pay_cos_total) FROM cp_payments WHERE pay_paymentmonth = $JAN");
               $stmtJAN->bind_result($MonthJAN);
               $stmtJAN->execute();
               
               while ($stmtJAN->fetch()){
                   }
               
               // To get monthly income...
               $stmtFEB = $db->prepare("SELECT SUM(pay_cos_total) FROM cp_payments WHERE pay_paymentmonth = $FEB");
               $stmtFEB->bind_result($MonthFRB);
               $stmtFEB->execute();
               
               while ($stmtFEB->fetch()){ 
                   
               }
               
               
               // To get monthly income...
               $stmtMAR = $db->prepare("SELECT SUM(pay_cos_total) FROM cp_payments WHERE pay_paymentmonth = $MAR");
               $stmtMAR->bind_result($MonthMAR);
               $stmtMAR->execute();
               
               while ($stmtMAR->fetch()){ 
                   
               }
               
               
               // To get monthly income...
               $stmtAPR = $db->prepare("SELECT SUM(pay_cos_total) FROM cp_payments WHERE pay_paymentmonth = $APR");
               $stmtAPR->bind_result($MonthAPR);
               $stmtAPR->execute();
               
               while ($stmtAPR->fetch()){
                   }
                   
               
               // To get monthly income...
               $stmtMAY = $db->prepare("SELECT SUM(pay_cos_total) FROM cp_payments WHERE pay_paymentmonth = $MAY");
               $stmtMAY->bind_result($MonthMAY);
               $stmtMAY->execute();
               
               while ($stmtMAY->fetch()){ 
                   
               }
               

               // To get monthly income...
               $stmtJUN = $db->prepare("SELECT SUM(pay_cos_total) FROM cp_payments WHERE pay_paymentmonth = $JUN");
               $stmtJUN->bind_result($MonthJUN);
               $stmtJUN->execute();
               
               while ($stmtJUN->fetch()){
                   
                   }
                   

               // To get monthly income...
               $stmtJUL = $db->prepare("SELECT SUM(pay_cos_total) FROM cp_payments WHERE pay_paymentmonth = $JUL");
               $stmtJUL->bind_result($MonthJUL);
               $stmtJUL->execute();
               
               while ($stmtJUL->fetch()){
                   
                   }
                   

               // To get monthly income...
               $stmtAUG = $db->prepare("SELECT SUM(pay_cos_total) FROM cp_payments WHERE pay_paymentmonth = $AUG");
               $stmtAUG->bind_result($MonthAUG);
               $stmtAUG->execute();
               
               while ($stmtAUG->fetch()){ 
                   
               }
               

               // To get monthly income...
               $stmtSEP = $db->prepare("SELECT SUM(pay_cos_total) FROM cp_payments WHERE pay_paymentmonth = $SEP");
               $stmtSEP->bind_result($MonthSEP);
               $stmtSEP->execute();
               
               while ($stmtSEP->fetch()){
                   }
                   

               // To get monthly income...
               $stmtOCT = $db->prepare("SELECT SUM(pay_cos_total) FROM cp_payments WHERE pay_paymentmonth = $OCT");
               $stmtOCT->bind_result($MonthOCT);
               $stmtOCT->execute();
               
               while ($stmtOCT->fetch()){
                   }
                   

               // To get monthly income...
               $stmtNOV = $db->prepare("SELECT SUM(pay_cos_total) FROM cp_payments WHERE pay_paymentmonth = $NOV");
               $stmtNOV->bind_result($MonthNOV);
               $stmtNOV->execute();
               
               while ($stmtNOV->fetch()){
                   }
                   
               
               // To get monthly income...
               $stmtDEC = $db->prepare("SELECT SUM(pay_cos_total) FROM cp_payments WHERE pay_paymentmonth = $DEC");
               $stmtDEC->bind_result($MonthDEC);
               $stmtDEC->execute();
               
               while ($stmtDEC->fetch()){ 
                   
               }
               

               
            ?>
                    
        var areaChartData = {
          labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
          datasets: [
            {
//              label: "Electronics",
//              fillColor: "rgba(210, 214, 222, 1)",
//              strokeColor: "rgba(210, 214, 222, 1)",
//              pointColor: "rgba(210, 214, 222, 1)",
//              pointStrokeColor: "#c1c7d1",
//              pointHighlightFill: "#fff",
//              pointHighlightStroke: "rgba(220,220,220,1)",
//              data: [65, 59, 80, 81, 56, 55, 40]
            },
            {
              label: "Digital Goods",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [<?php echo $MonthJAN; ?>, <?php echo $MonthFRB; ?>, <?php echo $MonthMAR; ?>, <?php echo $MonthAPR; ?>, <?php echo $MonthMAY; ?>, <?php echo $MonthJUN; ?>, <?php echo $MonthJUL; ?>, <?php echo $MonthAUG; ?>, <?php echo $MonthSEP; ?>, <?php echo $MonthOCT; ?>, <?php echo $MonthNOV; ?>, <?php echo $MonthDEC; ?>]
            }
          ]
        };


        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;
        barChartData.datasets[1].fillColor = "#00a65a";
        barChartData.datasets[1].strokeColor = "#00a65a";
        barChartData.datasets[1].pointColor = "#00a65a";
        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
      });
    </script>
        

<?php
// If session isn't meet, user will redirect to login page
} else { 
    header('Location: login.php');
}

include_once 'php-includes/footer.inc.php';


?>