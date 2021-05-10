<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
 
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
 
    $search_id = 32;
 
    //la query in SQL - al posto del valore di ricerca inseriamo "un segnaposto"
    $query = "Select ID_UTENTE, NomeUtente, CognomeUtente, EmailUtente from utenti
    Where ID_UTENTE = ?";
 
    //preparare la query
    $statement = $mysqli->prepare($query);
    //s per string, i per integer, d per double, b per blob
    $statement->bind_param('i', $search_id);
 
    //esecuzione dello statement
    $statement->execute();
 
    //associamo le colonne risultanti dall'esecuzione della query
    $statement->bind_result($ID_UTENTE, $NomeUtente, $CognomeUtente, $EmailUtente);
 
    echo "<table border='1'>";
    //fetch records
    while($statement->fetch()){
      echo "<tr>";
      echo "<td>" . $ID_UTENTE . "</td>";
      echo "<td>" . $NomeUtente . "</td>";
      echo "<td>" . $CognomeUtente . "</td>";
      echo "<td>" . $EmailUtente . "</td>";
          echo "</tr>";
    }
    echo "</table>";
    //close statement & connection
    $statement->close();
    $mysqli->close();
 
     ?>
  </body>
</html>