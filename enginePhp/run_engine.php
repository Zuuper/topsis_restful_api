<?php
    include 'requirement.php';
    include 'engine.php';
    include 'db_connection.php';
    $conn = OpenCon();
    $url = $get_data;
    $status = true;
    echo "Check data ke cloud..." ;
    while($status){
      echo "<br>" ;
      TopUpEngine($conn,$url);
      sleep(1);
      ob_flush();
      flush();
    }


?>