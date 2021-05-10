<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>
 
<body>
<?php
//Nuova connession a MySQL OOP
$mysqli = new mysqli('localhost','root','','labforfood');
 
//Mostro eventuali errori di connessione
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
 
//MySqli Select Query
$results = $mysqli->query("SELECT * FROM utenti");
 
print '<table border="1">';
while($row = $results->fetch_assoc()) {
 
/*è possibile anche usare
- $results->fetch_row() : restituisce un array a cui mi ci posso riferire tramite un indice numerico
- $results->fetch_array() : mi restituisce due array, uno standard ed uno associativo
- $results->fetch_assoc() al quale mi ci posso riferire tramite chiave
*/
    print '<tr>';
    print '<td>'.$row["ID_UTENTE"].'</td>';
    print '<td>'.$row["NomeUtente"].'</td>';
    print '<td>'.$row["CognomeUtente"].'</td>';
    print '<td>'.$row["EmailUtente"].'</td>';
    print '<td>'.$row["PSWd"].'</td>';
    print '</tr>';
}
print '</table>';
 
// Frees the memory associated with a result
$results->free();
 
// close connection
$mysqli->close();
?>
</body>
</html>
 
