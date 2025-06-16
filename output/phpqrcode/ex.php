<html>
  <head>
    <title>QR Code Generator</title>
  </head>
  


<?php 
 
    //QR Code Generator

    include('qrlib.php'); 
    include('qrconfig.php'); 

    $StudentID = $_GET['StudentID'];
    $StudentName = $_GET['StudentName'];
    $ReceiptNo = $_GET['ReceiptNo']; 
    
    // how to save PNG codes to server 
     
    $tempDir = $StudentID; 
     
    $codeContents1 = "https://appsdev.netcabin.sbs/ClassPAL-PRO/systemsu/index.php?page=AddStudentPayment&StudentID=$StudentID&StudentName=$StudentName&ReceiptNo=$ReceiptNo"; 
    $codeContents2 = "https://appsdev.netcabin.sbs/ClassPAL-PRO/systemsu/index.php?page=StudentAttendance&StudentID=$StudentID"; 
     
    // generating 
    QRcode::png($codeContents1, $tempDir.'006_L.png', QR_ECLEVEL_L); 
    QRcode::png($codeContents2, $tempDir.'006_M.png', QR_ECLEVEL_M); 
  
         
    // end displaying 
echo '<p align="center">';
echo '<table border="1" cellpadding="1" cellspacing="1" style="width:150px;">';
echo '<tbody>';
echo '<tr>';
echo '<td style="text-align: center;">';
	    echo '<div>';
	    echo '<p align="center">';
	    echo '<img src="'.$StudentID.'006_L.png" />';
	    echo '<br>';
	    echo "$StudentID";
	    echo '<br>';
	    echo "$StudentName"."(*)";
	    echo '</p>';
	    echo '</div>';
	    
	    
	     echo '<br>'; 
	     echo '<br>';  
	     
	    echo '<div>';
	    echo '<p align="center">';
	     echo '<img src="'.$StudentID.'006_M.png" />'; 
	    echo '<br>';
	    echo "$StudentID";
	    echo '<br>';
	    echo "$StudentName"."(a)";
	    echo '</p>';
	    echo '</div>';

echo '</td>';
echo '</tbody>';
echo ' </table>';
echo '</p>';
    


    ?>

  
  </html>
  