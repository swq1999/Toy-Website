<?php
   $conn = new mysqli(/*deleted for privacy concerns*/);

   if ($conn===false) {
      echo "<p> Connection failed </p><br>";
	  echo "<p> Error: ".$conn->connect_error."</p>";
      exit;
   }
?>
