<?php

// Browser Session
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];


} else { 
    header('Location: login123.php');
}




include_once 'php-includes/footer.inc.php';

?>