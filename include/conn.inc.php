<?php
  $serverName = "localhost";
  $username = "root";
  $password = ""; //XAMPP su MAMPP è root
  $dbName="labforfoods";
  $dbh = mysqli_connect($serverName, $username, $password, $dbName)
  or die("Connection KO");
 ?>
