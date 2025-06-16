<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

?>


<?php

 if(isset($_GET["SearchKey"])){
   $SechKey = $_GET["SearchKey"];

    if(isset($_GET["SubjectID"])){
    $Subj_ID = $_GET["SubjectID"];
        
    // If the value is set form POST request to $ShowRecords1, that value will update on the database...
     if (isset($_POST["shorec"])){
   $ShowRecords1 = $_POST["shorec"];



     // Update the database from selected value
     $stmt2 = $db->prepare("UPDATE cp_settings SET showrecords=? WHERE `setting_id`=1 ");
     $stmt2->bind_param('i',$ShowRecords1);
     $stmt2->execute(); 
     //$stmt->close();

   }


 ?>


<?php

global $db;

                   
     //Select the database "setting" value and Set that value to $ShowRecords1 to genarate the records...
    $stmt1 = $db->prepare("SELECT showrecords FROM `cp_settings` WHERE `setting_id`=1 ");
    $stmt1->bind_result($ShowRecords1);
    $stmt1->execute();
    

    
    while ($stmt1->fetch()){ 
        
    }   
    
        
// This first query is just to get the total count of rows
$sql = "SELECT COUNT(sa_id) FROM cp_subj_allo WHERE sa_subj_id=$Subj_ID";
$query = mysqli_query($db, $sql);
$row = mysqli_fetch_row($query);

// Here we have the total row count
$rows = $row[0];

// This is the number of results we want displayed per page, $ShowRecords1 select form database "setting" table...
$page_rows = $ShowRecords1;

// This tells us the page number of our last page
$last = ceil($rows/$page_rows);

// This makes sure $last cannot be less than 1
if($last < 1){
	$last = 1;
}

// Establish the $pagenum variable (Page Numbers)
$pagenum = 1;
// Get pagenum from URL vars if it is present, else it is = 1
if(isset($_GET['PageNo'])){
	$pagenum = preg_replace('#[^0-9]#', '', $_GET['PageNo']);
}

// This makes sure the page number isn't below 1, or more than our $last page
if ($pagenum < 1) { 
    $pagenum = 1; 
} else if ($pagenum > $last) { 
    $pagenum = $last; 
}

// This sets the range of rows to query for the chosen $pagenum
$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;

        
    
     
// This is your query again , it is for grabbing just one page worth of rows by applying $limit
$sql = "SELECT cp_subj_allo.sa_stu_student_id, cp_subj_allo.sa_stu_student_Name, cp_subj_allo.sa_subj_id, sa_subj_fee, cp_subj_allo.sa_batch_no, cp_subj_allo.sa_notes, cp_payments.Pay_stu_studentID, cp_payments.pay_paymentmonth, cp_payments.pay_student_name  FROM `cp_subj_allo` left join `cp_payments` ON cp_payments.Pay_stu_studentID = cp_subj_allo.sa_stu_student_id AND cp_payments.pay_paymentmonth = $SechKey  WHERE sa_subj_id=$Subj_ID";

$query = mysqli_query($db, $sql);

// This shows the user what page they are on, and the total number of pages
$textline2 = "Page <b>$pagenum</b> of <b>$last</b>";


// Establish the $paginationCtrls variable
$paginationCtrls = '<ul class="pagination pagination-sm no-margin">';
 //If there is more than 1 page worth of results
if($last != 1){
	/* First we check if we are on page one. If we are then we don't need a link to 
	   the previous page or the first page so we do nothing. If we aren't then we
	   generate links to the first page, and to the previous page. */
	if ($pagenum > 1) {
        $previous = $pagenum - 1;
		$paginationCtrls .= '<li><a href="index.php?page=PaymentPending&SubjectID='.$Subj_ID.'&PageNo=1">&laquo;&laquo;</a></li>'
                                 .'<li><a href="index.php?page=PaymentPending&SubjectID='.$Subj_ID.'&PageNo='.$previous.'">&laquo;</a></li>';
                         
		// Render clickable number links that should appear on the left of the target page number
		for($i = $pagenum-2; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<li><a href="index.php?page=PaymentPending&SubjectID='.$Subj_ID.'&PageNo='.$i.'">'.$i.'</a></li>';
			}
	    }
    }
    
	// Render the target page number, but without it being a link
	$paginationCtrls .= '<li class="active" ><a href="#">'.$pagenum.'</a></li> ';
        
        
	// Render clickable number links that should appear on the right of the target page number
	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<li><a href="index.php?page=PaymentPending&SubjectID='.$Subj_ID.'&PageNo='.$i.'">'.$i.'</a></li>';
		if($i >= $pagenum+2){
			break;
		}
	}
	// This does the same as above, only checking if we are on the last page, and then generating the "Next"
    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= '<li><a href="index.php?page=PaymentPending&SubjectID='.$Subj_ID.'&PageNo='.$next.'">&raquo;</a></li> '
                         .'<li><a href="index.php?page=PaymentPending&SubjectID='.$Subj_ID.'&PageNo='.$last.'">&raquo;&raquo;</a></li>'
                         .'</ul>';
    }
}
    




 
?>



<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            View All Pending Payments
            <small></small>
          </h1>
            
        </section>

        <!-- Main content -->
        <section class="content">
              <div class="box box-primary">
                  
            <div class="box-header with-border">
                <?php
                
                    //Select the database setting value
               $stmt2 = $db->prepare("SELECT subj_name FROM `cp_subjects` WHERE `subj_id`=$Subj_ID ");
               $stmt2->bind_result($Subj_Name);
               $stmt2->execute();
               

               
                while ($stmt2->fetch()){   
                    
                       
                
                ?>
                
                <h3 style="color: red;" class="box-title">Subject Name: <?php echo $Subj_Name; ?></h3>
              
              <?php
               } 
              ?>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
                  


        <div class="box-body">
             
             
         <!-- Search Form -->       
                       
                <form style="margin-bottom: 10px;" role="form" method="get" action="" class="form-inline">
                    <input type="hidden" name="page" value="PaymentPending">
                    <input type="hidden" name="SubjectID" value="<?php echo $Subj_ID ?>">
                    <input style="margin-top: 10px; width: 220px" class="form-control" type="text" name="SearchKey" value="" placeholder="Enter Paid Month to"/>
                    <input style="margin-top: 10px;" class="btn btn-primary btn-flat" type="submit" onclick="" value="Search">
                    <a style="margin-top: 10px;" href="index.php?page=SubNPay&PageNo=1" class="btn btn-primary btn-flat" >View All Subjects</a>
                </form>

                    <form name="myform" action="" method="post">
                        <div class="box-body table-responsive no-padding">
                    <table id="vas_table" class="table table-hover table-bordered table-responsive">
                         
                    <thead>
                      <tr>
                        <th>More Info</th>  
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Paid Month</th>
                        <th>Pending ?</th>

                      </tr>
                    </thead>
                    <tbody>

                        <?php

                        $PNo = $_GET["PageNo"];  
                        
                            // Loop to generate database values to table...       
                           while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
                           {

                        ?>
                    
                        
                      <tr>
                         <td >  
                             
                      <a style="margin-top: 10px;" href="index.php?page=UpdateStudentDetails&StudentID=<?php echo $row['sa_stu_student_id']  ?>" target="_blank" class="btn btn-primary btn-flat" ><span class="glyphicon glyphicon-search"></span></a>

                        </td>
                    
                        
                         <td><?php   echo $row['sa_stu_student_id']  ?></td>
                         <td><?php  echo $row['sa_stu_student_Name']  ?></td>
                         <td><?php  echo $row['pay_paymentmonth'] ?></td>
                         <td>
                         <?php
                         
                          
                          $Stu_paymonth = $row['pay_paymentmonth'];
                          $Stu_searchKey = $SechKey;
                          
                   
                              if ($Stu_paymonth == $Stu_searchKey ){  
                              
                                   echo "<span class='glyphicon glyphicon-ok'></span>";
                               
                               }  else {
                                    echo "<span class='glyphicon glyphicon-remove'></span>";    
                               }
                            
                         
                         ?>
                      
                        </td>
                      </tr>
                      <?php 
                      
                       
                       } 
                       
                       ?>
                      
                   </tbody>
                  </table> 
              </div>
    </form> 
                    
                  
<?php
        }
     }
                              
?>
                                     
                                    
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 
<?php
    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: login.php');
}
     
?>



    