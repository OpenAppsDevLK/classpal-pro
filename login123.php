<?php

// Some servers, header syntax not working,..Use this code if php header not working...
//ob_start();

require_once 'php-includes/connect.inc.php';

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ClassPAL | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
   
    
 
 
  </head>
  <body style="background-color: #00a65a;" class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
          <p style="color: white;" ><b>ClassPAL</b>PRO</p>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">
            <!-- src="Upload/df.jpg" -->
            <img  src="https://laraapps.netcabin.sbs/classpalpro/Upload/classpal-pro.jpg"  class=" " id="Uploadimg" name="Uploadimg" style="width:200px;height:200px; border-radius: 10px;">        
        </p>

        
        <form action="" method="get" name="myform">
            <b>Student ID</b>
          <div class="form-group has-feedback">
              <input type="number" name="StudentID" class="form-control" placeholder="Enter Student ID" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
            <b>Access Key</b>
          <div class="form-group has-feedback">
              <input type="password" name="AccessKey" class="form-control" placeholder="Enter Access Key" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-6">
                <button  type="submit" class="btn btn-primary btn-block btn-flat">View Info</button>
            </div><!-- /.col -->     
          </div>
        </form>

        <?php

if(isset($_GET['StudentID'])){
    $Stu_ID = $_GET['StudentID'];
    $Stu_AccessKey = $_GET['AccessKey'];
    
    $SID = mysqli_real_escape_string($db,trim($_GET['StudentID']));
    $AK = mysqli_real_escape_string($db,trim($_GET['AccessKey']));
    
    
    $sql = "SELECT * FROM cp_students WHERE stu_studentID = '{$SID}' AND stu_accesskey = '{$AK}' LIMIT 1";
    $result = mysqli_query($db,$sql);    
    
    if(mysqli_num_rows($result) == 1){

        header('Location: studentinfo.php?StudentID='. $Stu_ID);
        exit();
        
    } else {
       
     					$error[] = "
                                                    <div class='alert alert-danger alert-dismissable'>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                                    <h4><i class='icon fa fa-ban'></i> WARNING!</h4>
                                                    Student ID Or Access Key is not currect, please check and Try Again...
                                                    </div>";   
        
      
    }
                                                                  
                        if(!empty($error)){
				foreach($error as $msg){
					echo '<p>'.$msg.'</p>';			
				}
			}                                        
                                        
                                        
                                        
                                        
}
                                
// Some servers header syntax not working,..Use this code if php header not working...
//ob_end_flush();

?>
        
      </div><!-- /.login-box-body -->
      
       <div class="login-box-body">
          <div class="row">
    
          </div>
     

      </div><!-- /.login-box-body -->
      
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>






        
        
