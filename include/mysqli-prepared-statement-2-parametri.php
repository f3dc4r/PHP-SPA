<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Mysqli prepared statement 2 parametri</title>
<style>
p{
background-color:yellow;
}
</style>
</head>
 
  <body>
  <h2>L’estensione MySQLi - Prepared Statement</h2>
 
  <?php
  include "conn.inc.oop.php";
 
  $mysqli = new mysqli($serverName, $username,$password, $dbName);
  //verifica dell'avvenuta Connessione; $mysqli il nostro oggetto connection
  if($mysqli->connect_errno){
    echo "Errore di connessione al DB: " . $mysqli->connect_error;
    exit();
  }else{
    echo "<p>Connessione avvenuta con successo</p>";
  }
 
$disabilitato = 1;
$EmailUtente='mario.rossi@gmail.com';
 
 
$stmt = $mysqli->prepare("Select ID_UTENTE, NomeUtente, CognomeUtente, EmailUtente, disabilitato
from utenti where disabilitato=? and EmailUtente = ?");
 
// 2. fase di binding dei parametri - definizione della variabile per la sostituzione del placeholder
 
$stmt->bind_param('is', $disabilitato, $EmailUtente);
//i -> integer ; s -> string
 
// 3. valorizzazione della variabile per l’esecuzione
 
// 4. esecuzione dello statement
$stmt->execute();
 
//5. Possiamo ottenere i risultati nel seguente modo, tramite il binding dei risultati
 
//bind result variables: ovvero indichiamo quali colonne vogliamo visualizzare
$stmt->bind_result($ID_UTENTE, $NomeUtente, $CognomeUtente, $EmailUtente,$disabilitato);
 
print '<table border="1">';
//6. fetch records
while($stmt->fetch()) {
    print '<tr>';
    print '<td>'.$ID_UTENTE.'</td>';
    print '<td>'.$NomeUtente.'</td>';
    print '<td>'.$CognomeUtente.'</td>';
    print '<td>'.$EmailUtente.'</td>';
    print '<td>'.$disabilitato.'</td>';
    print '</tr>';
 
}
print '</table>';
 
// chiusura dello statement
$stmt->close();
 
// chiusura della connessione
$mysqli->close();
?>
  </body>
</html>