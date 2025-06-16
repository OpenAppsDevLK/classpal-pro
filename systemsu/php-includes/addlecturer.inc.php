<?php
// Browser Session Start here
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];

// Select the user and assign permission...        
    $stmt1134 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1134");
    $stmt1134->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
    $stmt1134->execute();

    while ($stmt1134->fetch()) {
        
    }


//linked with addlecturer.fn.php
    $ADDLecturer = addlecturer();
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
    <?php
    if ($cp_userpermission_OnOff == 0) {
        $Message .= "<h1>Access Denied</h1>";
        echo $Message;
    } else {
        ?>
                <h1>
                    Add Lecturer
                    <small>You can add lecturer details...</small>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Lecturer Registration Details</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">

                        <form id="form_addstudent" style="" role="form" action="" method="post" enctype="multipart/form-data" >
                            <!-- text input -->
                            <div class="form-group">
                                <label>ID</label>
                                <input type="text" name="txt_AutoID" class="form-control" placeholder="AUTO" readonly>
                            </div>


        <?php
        $a = mt_rand(10000, 1000000);
        ?>


                            <div class="form-group">
                                <label>Lecturer ID</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </div>                       
                                    <input type="text" name="txt_Lecturer_id" value="<?php echo $a; ?>" class="form-control ">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Registration Date* (M:D:Y)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="date" name="txt_Lecturer_regDate" value="<?php echo date('Y-m-d') ?>" class="form-control pull-right" required>
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->

                            <div class="form-group">
                                <label>Lecturer Name*</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-info"></i>
                                    </div>
                                    <input type="text" name="txt_Lecturer_name" class="form-control" required>
                                </div>

                            </div>


                            <div class="form-group">
                                <label>Address</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-align-justify"></i>
                                    </div>
                                    <textarea class="form-control" name="txt_Lecturer_address" rows="3"></textarea>
                                </div>
                            </div>



                            <div class="form-group">
                                <label>Sex</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-venus-mars"></i>
                                    </div>                       
                                    <select name="txt_Lecturer_sex" class="form-control">
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Mobile Number*</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-mobile"></i>
                                    </div>
                                    <input type="text" name="txt_Lecturer_Mno01" class="form-control" required>
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->




                            <div class="form-group">
                                <label>Notes</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil "></i>
                                    </div>                       
                                    <textarea class="form-control" name="txt_Lecturer_notes" rows="4"></textarea>
                                </div>
                            </div>





                            <div class="box-footer">

                                <div class= "col-lg-6 col-md-12 col-xs-1">
                                    <input  style="margin-top: 5px;" class="btn  btn-success btn-lg" name="btn_AddLec_submit" type="submit" onclick="" value="Register this Lecturer">                    
                                    <a style="margin-top: 5px;" href="index.php?page=AddLecturer&PageNo=1" class="btn btn-primary">New</a>
                                    <a style="margin-top: 5px;" href="index.php?page=ViewAllLecturers&PageNo=1" class="btn  btn-danger">View All Lecturers </a>

                                </div>


                            </div><!-- /.box-footer-->   

                        </form>      
                    </div><!-- /.box-body -->


            </section><!-- /.content -->
        <?php
    }
    ?>        
    </div><!-- /.content-wrapper -->

    <?php
// If session isn't meet, user will redirect to login page
} else {
    header('Location: login.php');
}
?>