<?php
// Browser Session Start here
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];

// Select the user and assign permission...       
    $stmt1126 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1135");
    $stmt1126->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
    $stmt1126->execute();

    while ($stmt1126->fetch()) {
        
    }

//linked with update_sms_gway_setting.fn.php
    $SMS_gway_setting = Update_sms_gway_settings();

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
                    Settings
                    <small>You can change the useful settings...</small>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">All Settings</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">

                        <!-- SMS Gateway Settings Start -->

                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title">SMS Gateway Settings</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <form id="form_addstudent" role="form" action="" method="post" enctype="multipart/form-data" >
                                    <!-- text input -->
        <?php
        //This will select SMS gateway code and token form db...
        $stmt_select_sms_gway_settings = $db->prepare("SELECT setting_id, sms_gway_dcode, sms_gway_token, sms_sender, sms_send_reg, sms_send_pay, sms_send_atten FROM `cp_settings` WHERE `setting_id`=2 ");
        $stmt_select_sms_gway_settings->bind_result($setting_id, $sms_gway_dcode, $sms_gway_token, $sms_sender, $sms_send_reg, $sms_send_pay, $sms_send_atten);
        $stmt_select_sms_gway_settings->execute();

        while ($stmt_select_sms_gway_settings->fetch()) {
            
        }
        ?>

                                    <div class="form-group">
                                        <label>SMS Gateway Name</label>
                                        <input type="text" name="txt_sms_gateway_name" value="Textit" class="form-control" readonly>
                                        <p>Note: Signup for the SMS Gateway, Please visit <a href="https://www.textit.biz/" target="_blank">Textit.biz</a></p>
                                    </div>

                                    <div class="form-group">
                                        <label>SMS Sender Name</label>
                                        <input type="text" name="txt_sms_sender" value="<?php echo $sms_sender; ?>" class="form-control">
                                    </div>


                                    <div class="form-group">
                                        <label>Textit: Account ID</label>
                                        <input type="text" name="txt_sms_gway_dcode" value="<?php echo $sms_gway_dcode; ?>" class="form-control">
                                    </div>


                                    <div class="form-group">
                                        <label>Textit: Password </label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>                       
                                            <input type="text" name="txt_sms_gway_token" value="<?php echo $sms_gway_token; ?>" class="form-control">
                                        </div>
                                    </div>

                                    <hr>


                                    <div class="form-group">
                                        <label>Registration Message: This message will be sent after the student registers with the class. (If not, Leave it blank )</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>                       
                                            <input type="text" name="sms_send_reg" value="<?php echo $sms_send_reg; ?>" class="form-control">
                                        </div>
                                    </div>
                                    
                                     <div class="form-group">
                                        <label>Payment Message: This message will be sent after the student pays. (If not, Leave it blank )</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>                       
                                            <input type="text" name="sms_send_pay" value="<?php echo $sms_send_pay; ?>" class="form-control">
                                        </div>
                                    </div>                                   
                                    
                                     <div class="form-group">
                                        <label>Attendance Message: This message will be sent after the student attends the class. (If not, Leave it blank )</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>                       
                                            <input type="text" name="sms_send_atten" value="<?php echo $sms_send_atten; ?>" class="form-control">
                                        </div>
                                    </div>                                     
                                    
                                    <div class="box-footer">

                                        <div class= "col-lg-6 col-md-12 col-xs-1">
                                            <input  style="margin-top: 5px;" class="btn  btn-success" type="submit" onclick="" name="btn_sms_gway_save" value="Save">                    
                                        </div>


                                    </div><!-- /.box-footer-->   

                                </form>      
                            </div><!-- /.box-body -->


                        </div><!-- /.box -->

                        <!-- SMS Gateway Settings END -->



                        <!-- Login Page Settings Start -->    

<!--                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title">Login Page Settings</h3>
                            </div> /.box-header 
                            <div class="box-body">
                                <form id="login_page_settings" role="form" action="" method="post" enctype="multipart/form-data" >
                                     text input                    

                                    <div class="form-group">
                                        <label>Institute Name</label>
                                        <input type="text" name="txt_tea_name" value="<?php //echo $teacher_name; ?>" class="form-control ">
                                    </div>


                                    <div class="form-group">
                                        <label>Institute Logo</label>
                                        <input type="file" name="teacher_photo" class="form-control" id="file" />
                                        <input type="hidden" name="uploaded_teacher_photo" value="<?php //echo $teacher_photo; ?>" class="form-control">
                                    </div>



                                    <div class="box-footer">

                                        <div class= "col-lg-6 col-md-12 col-xs-1">
                                            <input  style="margin-top: 5px;" class="btn  btn-success" type="submit" onclick="" name="btn_login_page_settisngs" value="Save">                    
                                        </div>


                                    </div> /.box-footer   

                                </form>      
                            </div> /.box-body 


                        </div> /.box         -->

                        <!-- Login Page Settings End -->  

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
