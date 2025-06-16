<?php
// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

        
// Select the user and assign permission...          
$stmt1122 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1122" ); 
$stmt1122->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1122->execute();

while ($stmt1122->fetch()){ 
    
}



?>



<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
 <?php
    if ($cp_userpermission_OnOff == 0){
        $Message .= "<h1>Access Denied</h1>";
        echo $Message;
        
    } else {
            
            
?>            
          <h1>
            Reports Dashboard
          </h1>
        </section>

<?php
// Get total students
$stmt = $db->prepare("SELECT COUNT(stu_studentID) FROM cp_students");
$stmt->bind_result($TotalStudents);
$stmt->execute();

while ($stmt->fetch()){


}

?>
        
        <!-- Row 01 -->
        <section class="content">
          <!-- TOTAL STUDENTS -->
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-add"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Students</span>
                  <span class="info-box-number"><?php echo $TotalStudents; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
   
                        <!-- TOTAL INCOME -->
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
               // Get total allocated students
               $stmt1 = $db->prepare("SELECT COUNT(sa_stu_student_id) FROM cp_subj_allo");
               $stmt1->bind_result($TotalAlloStudents);
               $stmt1->execute();

               while ($stmt1->fetch()){
                 
                   
            }

            ?>
            
            <!-- TOTAL ALLOCATED -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="ion ion-android-contacts"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Allocated</span>
                  <span class="info-box-number"><?php echo $TotalAlloStudents; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
             
            

            
            
            <div class="clearfix visible-sm-block"></div>
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
            
            <!-- This Month Income -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-social-usd"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">This Month Income</span>
                  <span class="info-box-number">Rs. <?php echo $MonthIncome; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
             <?php
               // Get total allocated students
               $stmt9 = $db->prepare("SELECT COUNT(id) FROM cp_lecturers");
               $stmt9->bind_result($TotalLecturers);
               $stmt9->execute();

               while ($stmt9->fetch()){
                 
                   
            }

            ?>
            <!-- OLD STUDENTS -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Lecturers</span>
                  <span class="info-box-number"><?php echo $TotalLecturers; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
            
 
            
             <?php
           
               $Date2 = date('Y-m-d');
            
               // To get monthly income...
               $stmt10 = $db->prepare("SELECT SUM(pay_cos_total) FROM cp_payments WHERE pay_paymentdate LIKE '%{$Date2}%'");
               $stmt10->bind_result($TodayIncome);
               $stmt10->execute();

               while ($stmt10->fetch()){
               $TodayIncome = number_format($TodayIncome, 2, '.', '');  
                   
            }

            ?>
            
            <!-- Today Income -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-social-usd"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Today Income</span>
                  <span class="info-box-number">Rs. <?php echo $TodayIncome; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
            
 
            
            

            
          </div><!-- /.row -->
          

        
          

          <hr>
 
          
         <!-- Report: Total Students-->
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-stalker"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Report: Total Students</span>
                  <a href="output/repoAllStudents.php" target="_blank" class="btn btn-primary btn-flat" >Create</a>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
            <?php
               
               // To get Subject Name
               $stmt4 = $db->prepare("SELECT subj_id, subj_name FROM cp_subjects");
               $stmt4->bind_result($Subj_ID, $Subj_name);
               $stmt4->execute();

            ?>
            
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-stalker"></i></span>
                <div class="info-box-content">
                <form  target="_blank" action="output/repoSubjAlloStudents.php" method="get" class="form-inline">
                  <span class="info-box-text">Report: Student Allocated on Subjects</span>
                  <select  style="margin-bottom: 5px;" name="SubjectID" class="form-control">
                  <?php
                    while ($stmt4->fetch()){

                    
                  ?>
                     
                      <option value="<?php echo $Subj_ID; ?>"><?php echo $Subj_name; ?></option>
                        
                                       
                  <?php } ?>
                   </select>   
               <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                </form>
               </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

                        <?php
   
            //This will show the Subjects
            $stmt13 = $db->prepare("SELECT subj_id, subj_name FROM `cp_subjects`");
            $stmt13->bind_result($AS_Subj_ID, $AS_Sunj_Name);
            $stmt13->execute();


            ?>
            
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-stalker"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Report: Batch Students </span>
                  <form  target="_blank" action="output/repoSubjBatchNo.php" method="get" class="form-inline">
                      <select style="margin-bottom: 5px;" name="SubjectID" class="form-control">
                      
                          <?php
                               
                              while ($stmt13->fetch()){

                           ?>
                          
                       <option value="<?php echo $AS_Subj_ID ?>"><?php echo $AS_Sunj_Name; ?></option>
                        
                        <?php
                         
                        
                              }
                              
                            
                        
                        ?>
                       
                      </select>
                    
                    <input style="margin-bottom: 5px;" class="form-control" type="text" name="SearchKey" value="" placeholder="Batch No"/>
                    <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                  </form>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
            <?php
   
            //This will show the Subjects
            $stmt5 = $db->prepare("SELECT subj_id, subj_name FROM `cp_subjects`");
            $stmt5->bind_result($AS_Subj_ID, $AS_Sunj_Name);
            $stmt5->execute();


            ?>
            
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-stalker"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Report: Batch Students Phone Numbers</span>
                  <form  target="_blank" action="output/repoPhoneNubs.php" method="get" class="form-inline">
                      <select style="margin-bottom: 5px;" name="SubjectID" class="form-control">
                      
                          <?php
                               
                              while ($stmt5->fetch()){

                           ?>
                          
                       <option value="<?php echo $AS_Subj_ID ?>"><?php echo $AS_Sunj_Name; ?></option>
                        
                        <?php
                         
                        
                              }
                              
                            
                        
                        ?>
                       
                      </select>
                    
                    <input style="margin-bottom: 5px;" class="form-control" type="text" name="SearchKey" value="" placeholder="Batch No"/>
                    <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                  </form>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
            
          <?php
   
            //This will show the Subjects
            $stmt11 = $db->prepare("SELECT subj_id, subj_name FROM `cp_subjects`");
            $stmt11->bind_result($AS_Subj_ID, $AS_Sunj_Name);
            $stmt11->execute();


            ?>
            
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-stalker"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Report: Barcode Generator</span>
                  <form  target="_blank" action="output/repoBarcodeGen.php" method="get" class="form-inline">
                      <select style="margin-bottom: 5px;" name="SubjectID" class="form-control">
                      
                          <?php
                               
                              while ($stmt11->fetch()){

                           ?>
                          
                       <option value="<?php echo $AS_Subj_ID ?>"><?php echo $AS_Sunj_Name; ?></option>
                        
                        <?php
                         
                        
                              }
                              
                            
                        
                        ?>
                       
                      </select>
                    
                    <input style="margin-bottom: 5px;" class="form-control" type="text" name="SearchKey" value="" placeholder="Batch No"/>
                    <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                  </form>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            
            <?php
            

            //This will show Students Attendances
            $stmt8 = $db->prepare("SELECT subj_id, subj_name FROM `cp_subjects`");
            $stmt8->bind_result($RepoDailin_Subj_ID, $RepoDailin_Sunj_Name);
            $stmt8->execute();

           
            ?>
            
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-stalker"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Report: Students Attendances</span>
                   <form  target="_blank" action="output/repoStudentAttend.php" method="get" class="form-inline">
                   <select  style="margin-bottom: 5px;" name="SubjectID" class="form-control">
                      
                          <?php
                               
                              while ($stmt8->fetch()){

                           ?>
                          
                       <option value="<?php echo $RepoDailin_Subj_ID ?>"><?php echo $RepoDailin_Sunj_Name; ?></option>
                        
                        <?php
                         
                        
                              }
                              
                            
                        
                        ?>
                       
                      </select>
                    
                    <input style="margin-bottom: 5px;" class="form-control" type="date" name="date01" value="" placeholder=""/>
                    <input style="margin-bottom: 5px;" class="form-control" type="date" name="date02" value="" placeholder=""/>
                    <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                  </form>
                  
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
             <div class="col-md-6 col-sm-6 col-xs-12">
              <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-stalker"></i></span>
                <div class="info-box-content">
                <form  target="_blank" action="output/repoStudentFull.php" method="get" class="form-inline">
                  <span class="info-box-text">Report: Student Detail Report</span>
                  <input style="margin-bottom: 5px;" class="form-control" type="number" name="StudentID" value="" placeholder="Student ID" required/>
               <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                </form>
               </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->            
      
            
             <div class="col-md-12 col-sm-12 col-xs-12">
              <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-stalker"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Report: Mark Absent</span>
                   <form  target="_blank" action="output/repoAbsentStudent.php" method="get" class="form-inline"> 
                       <input style="margin-bottom: 5px;" class="form-control" type="date" name="Date" value="" placeholder="" required/>
                       <input style="margin-bottom: 5px;" class="form-control" type="text" name="BatchNo" value="" placeholder="Batch No" required/>
                        
                       <select  style="margin-bottom: 5px;" name="LecturerID" class="form-control">
                      
                          <?php
                          
                                       //This will show Lecturers
                                    $stmt_select_lecturer = $db->prepare("SELECT lec_id, lec_name FROM `cp_lecturers`");
                                    $stmt_select_lecturer->bind_result($lec_id, $lec_name);
                                    $stmt_select_lecturer->execute();
                               
                              while ($stmt_select_lecturer->fetch()){

                           ?>
                          
                       <option value="<?php echo $lec_id ?>"><?php echo $lec_name; ?></option>
                        
                        <?php
                         
                        
                              }
                              
                            
                        
                        ?>
                       
                      </select>

                       
                       <select  style="margin-bottom: 5px;" name="SubjectID" class="form-control">
                      
                          <?php
                          
                                //This will show Students Attendances
                                $stmt19 = $db->prepare("SELECT subj_id, subj_name FROM `cp_subjects`");
                                $stmt19->bind_result($RepoDailin_Subj_ID, $RepoDailin_Sunj_Name);
                                $stmt19->execute();
                                
                               
                              while ($stmt19->fetch()){

                                
                                
                           ?>
                          
                       <option value="<?php echo $RepoDailin_Subj_ID ?>"><?php echo $RepoDailin_Sunj_Name; ?></option>
                        
                        <?php
                         
                        
                              }
                              
                            
                        
                        ?>
                       
                      </select>
                       
                       
                       
                       
                    <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                  </form>
                  
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->           
            
            
            
            
            
   
           <div class="col-md-6 col-sm-6 col-xs-12">
              <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-stalker"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Report: Total Lecturers </span>
                  <a href="output/repolecturers.php" target="_blank" class="btn btn-primary btn-flat" >Create</a>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            

 </div><!-- /.row -->
 
 
 
          <hr>
          
          <!-- Info boxes Row 03-->
          <div class="row">
            <div class="col-md-5 col-sm-5 col-xs-12">
              <div style="background-color: #00a65a;" class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-social-usd"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Report: Total Income</span>
                  <a href="output/repoTotalincome.php" target="_blank" class="btn btn-primary btn-flat" >Create</a>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
            <?php

            //This will show Daily Income
            $stmt6 = $db->prepare("SELECT subj_id, subj_name FROM `cp_subjects`");
            $stmt6->bind_result($RepoDailin_Subj_ID, $RepoDailin_Sunj_Name);
            $stmt6->execute();

            ?>
            
            <div class="col-md-7 col-sm-7 col-xs-12">
              <div style="background-color: #00a65a;" class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-social-usd"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Report: Daily Income</span>
                  <form  target="_blank" action="output/repo-DailyIncome.php" method="get" class="form-inline">
                   <select style="margin-bottom: 5px;" name="SubjectID" class="form-control">
                      
                          <?php
                               
                              while ($stmt6->fetch()){

                           ?>
                          
                       <option value="<?php echo $RepoDailin_Subj_ID ?>"><?php echo $RepoDailin_Sunj_Name; ?></option>
                        
                        <?php

                              }

                        ?>
                       
                      </select>
                    
                    <input style="margin-bottom: 5px;" class="form-control" type="date" name="SearchKey" value="" placeholder=""/>
                    <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                  </form>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <?php
   


            ?>
            
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div style="background-color: #00a65a;" class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-social-usd"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Report: Range Income </span>
                  <form  target="_blank" action="output/repo-RangeIncome.php" method="get" class="form-inline">
                    <input style="margin-bottom: 5px;" class="form-control" type="date" name="date01" value="" placeholder=""/>
                    <input style="margin-bottom: 5px;" class="form-control" type="date" name="date02" value="" placeholder=""/>
                    <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                  </form>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
       
            <?php
            

            //This will show Range Subject Income
            $stmt7 = $db->prepare("SELECT subj_id, subj_name FROM `cp_subjects`");
            $stmt7->bind_result($RepoDailin_Subj_ID, $RepoDailin_Sunj_Name);
            $stmt7->execute();

           
            ?>
            
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div style="background-color: #00a65a;" class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-social-usd"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Report: Range Subject Income</span>
                <form  target="_blank" action="output/repoRangeSubjectIncome.php" method="get" class="form-inline">
                   <select style="margin-bottom: 5px;" name="SubjectID" class="form-control">
                      
                          <?php
                               
                              while ($stmt7->fetch()){

                           ?>
                          
                       <option value="<?php echo $RepoDailin_Subj_ID ?>"><?php echo $RepoDailin_Sunj_Name; ?></option>
                        
                        <?php

                              }

                        ?>
                       
                      </select>
                    
                    <input style="margin-bottom: 5px;" class="form-control" type="date" name="date01" value="" placeholder=""/>
                    <input style="margin-bottom: 5px;" class="form-control" type="date" name="date02" value="" placeholder=""/>
                    <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                  </form>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
       <?php
            

            //This will show Range Subject Income
            $stmtLecShare = $db->prepare("SELECT lec_id, lec_name FROM `cp_lecturers`");
            $stmtLecShare->bind_result($LecID, $LecName);
            $stmtLecShare->execute();

           
            ?>
            
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div style="background-color: #00a65a;" class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-social-usd"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Report: Lecturer Share</span>
                <form  target="_blank" action="output/repoLecShare.php" method="get" class="form-inline">
                   <select style="margin-bottom: 5px;" name="LecID" class="form-control">
                      
                          <?php
                               
                              while ($stmtLecShare->fetch()){

                           ?>
                          
                       <option value="<?php echo $LecID ?>"><?php echo $LecName; ?></option>
                        
                        <?php

                              }

                        ?>
                       
                      </select>
                    
                    <input style="margin-bottom: 5px;" class="form-control" type="date" name="Lecdate01" value="" placeholder=""/>
                    <input style="margin-bottom: 5px;" class="form-control" type="date" name="lecdate02" value="" placeholder=""/>
                      <select style="margin-bottom: 5px;" name="SubjectID" class="form-control">  
                            <option value="0"></option>
                        <?php


                            //This will show Range Subject Income
                            $stmt15 = $db->prepare("SELECT subj_id, subj_name FROM `cp_subjects`");
                            $stmt15->bind_result($RepolecShareSubjid, $RepolecShareSunj_Name);
                            $stmt15->execute();

                            while ($stmt15->fetch()){
                                
                                
                            ?>
                    
                         <option value="<?php echo $RepolecShareSubjid ?>"><?php echo $RepolecShareSunj_Name; ?></option>
                            
                        <?php     
                            }
                         ?>
                       
                      </select>
                    <input style="margin-bottom: 5px;" class="form-control" type="number" name="share" value="" placeholder="Share"/>
                    <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                  </form>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          
   <hr>  
    
 
              <div class="col-md-6 col-sm-6 col-xs-12">
              <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-gears"></i></span>
                <div class="info-box-content">
                <form  target="_blank" action="output/set_ichart_fixer.php" method="get" class="form-inline">
                  <span class="info-box-text">Setting: Dashboard MONTHLY INCOME CHART Fixer</span>
                  <input style="margin-bottom: 5px;" class="form-control" type="number" name="c_year" value="<?php echo date('Y'); ?>" placeholder="Student ID" required/>
               <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="FIX">
                </form>
               </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->        
            
               <div class="col-md-6 col-sm-6 col-xs-12">
              <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-stalker"></i></span>
                <div class="info-box-content">
                <form  target="_blank" action="output/repologs.php" method="get" class="form-inline">
                  <span class="info-box-text">Report: User Logs</span>
               <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                </form>
               </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->   
            
                   <div class="col-md-6 col-sm-6 col-xs-12">
              <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-gears"></i></span>
                <div class="info-box-content">
                <form  target="_blank" action="output/set_clear_logs.php" method="post" class="form-inline">
                  <span class="info-box-text">Setting: Clear User Logs</span>
                  <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" name="clear_logs" type="submit" value="Clear">
                </form>
               </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->   
            
   
        </section><!-- /.content -->
        
        <?php   
        
                              }  
                              
                              
                // Close your database connection and Other Connections...
//                $stmt1122->close();
//                $stmt->close();
//                $stmt2->close();
//                $stmt1->close();
//                $stmt3->close();
//                $stmt9->close();
//                $stmt10->close();
//                $stmt4->close();
//                $stmt5->close();
//                $stmt11->close();
//                $stmt8->close();
//                $stmt6->close();
//                $stmt7->close();
                 
        ?>  
        

      </div><!-- /.content-wrapper -->
   
<?php
    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: login.php');
}
