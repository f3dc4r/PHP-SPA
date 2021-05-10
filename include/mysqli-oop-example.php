<?php 
    error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
    <meta charset=utf-8>
    <title>
        Connessione a DB tramite mysqli OOP
    </title>
    </head>
    <body>
        <h3>MySqli - OOP</h3>
        <h4>connessione al DB e query select</h4>
        <?php
            include "conn.inc.oop.php";
            //connessione restituisce la vriabile oggetto $mysqli
            $mysqli = new mysqli($serverName, $userName, $password, $dbName);
            //verifica dell'avvenuta connessione
            if($mysqli->connect_errno){
                echo "<h4>Errore di connessione al DB: " . $mysqli->connect_error . "</h4>";
                exit();
            }else{
                echo "<h4>Connessione al DB avvenuta con successo</h4>";
            }

            //SELECT query
            $query = "SELECT * FROM utenti Order by ID_UTENTE DESC";

            //Esecuzione della query e restituzione di un oggetto "resultset"
            $result = $mysqli->query($query);

            //conteggio dei record ottenuti dalla query
            if($result->num_rows > 0){
                $msg = "Trovati " . $result->num_rows . " utenti";
                $arrRows = array(); //inizializzo array vuoto
                while($row = $result->fetch_array(MYSQLI_NUM)){ //puntatore alla riga successiva del mio array
                    //MYSQLI_ASSOC array associativo
                    //fetch_assoc() come fetch_array(MYSQLI_ASSOC)
                    //fetch_row() come fetch_array(MYSQLI_NUM)
                    //fetch_array(MYSQLI_BOTH) è uguale a scrivere fetch_array() 
                    $arrRows[] = $row;
                    //array_push($arrRows, $row); //è la stessa cosa della riga prima
                }

                var_dump($arrRows);
                //echo count($arrRows);
            }else{
                $msg = "Non ci sono utenti del DB";
            }
        ?>
    </body>
</html>