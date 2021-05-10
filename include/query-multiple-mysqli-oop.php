<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>
 
<body>
<?php
 
//Open a new connection to the MySQL server
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "labforfoods");
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
 
//Output any connection error
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
 
//product 1
$product_code1 = '"'.$mysqli->real_escape_string('P1').'"';
$product_name1 = '"'.$mysqli->real_escape_string('Google Nexus').'"';
$product_price1 = '"'.$mysqli->real_escape_string('149').'"';
 
//product 2
$product_code2 = '"'.$mysqli->real_escape_string('P2').'"';
$product_name2 = '"'.$mysqli->real_escape_string('Apple iPad 2').'"';
$product_price2 = '"'.$mysqli->real_escape_string('217').'"';
 
//product 3
$product_code3 = '"'.$mysqli->real_escape_string('P3').'"';
$product_name3 = '"'.$mysqli->real_escape_string('Samsung Galaxy Note').'"';
$product_price3 = '"'.$mysqli->real_escape_string('259').'"';
 
//Insert multiple rows
$insert = $mysqli->query(
  "INSERT INTO products(product_code, product_name, price) VALUES
($product_code1, $product_name1, $product_price1),
($product_code2, $product_name2, $product_price2),
($product_code3, $product_name3, $product_price3)");
 
if($insert){
    //return total inserted records using mysqli_affected_rows
    print 'Success! Total ' .$mysqli->affected_rows .' rows added.<br />';
}else{
    die('Error : ('. $mysqli->errno .') '. $mysqli->error);
}
 
// close connection
$mysqli->close();
?>
</body>
</html>