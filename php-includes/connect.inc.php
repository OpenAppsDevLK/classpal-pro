<?php

        
// Database Connection
$dbconnect = array(
    'server' => 'localhost',
    'dbuser' => 'netc_u_classpalpro',
    'dbpass' => 'tnKy!P2+st4O%1*h',
    'dbname' => 'netc_classpalpro'  
);

$db = new mysqli (
        $dbconnect ['server'],
        $dbconnect ['dbuser'],
        $dbconnect ['dbpass'],
        $dbconnect ['dbname']     
        
        );

if ($db->connect_errno>0){
    echo "Database Connect Error";
    exit;
}  else {
    //echo "Success";
    
}


?>