<html>
  <head>
    <title>BarCode Generator</title>
  </head>
  
  
<?php

// Barcode Generator

    $StudentID = $_GET['StudentID'];
    $StudentName = $_GET['StudentName'];

?>

  
  


<div align="center">
    
        
<br>
<br>


<p style="padding:0; margin: 0;">+-----------------------------------------+</p>
                            <div>
                              <img alt="<?php echo $StudentID; ?>" src="../../output/barcode/barcode.php?text=<?php echo $StudentID; ?>" />  
                              <?php echo $StudentID; ?> <br> <?php echo $StudentName; ?>  
                            
                            </div>

<p style="padding:0; margin: 0;">+-----------------------------------------+</p>

      
        
        


    
</div>


</html>
