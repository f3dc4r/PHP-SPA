<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
 
<?PHP
 
if(isset($_POST['submit'])){
 
$mysqli = new mysqli("localhost","root","","labforfood");
 
$username=$mysqli->real_escape_string(htmlentities($_POST['username']));
$password=$mysqli->real_escape_string(htmlentities($_POST['password']));
 
// verifica dell'avvenuta connessione
if ($mysqli->connect_errno) {
           // notifica in caso di errore
        echo "Errore di connessione al DB: ". $mysqli->connect_error;
           // interruzione delle esecuzioni i caso di errore
        exit();
 
}
else {
           // notifica in caso di connessione attiva
        echo "Connessione avvenuta con successo<br>";
}
 
   //3. Query in SQL (query select) -- non stiamo facendo al validazione dei dati
   //direttamente l'autenticazione
 
$sql="Select * from utenti where EmailUtente='$username' and PSWd=sha1('$password')";
echo $sql . "<br>";
//per fare una sql injection basta inserire qualsiasi utente
//ed una password come '" or 1=1 -- '"
 
$res=$mysqli->query($sql);
 
//if($res->num_rows==1){ //se la query restituisce un solo risultato... posso entrare
 
if($res->num_rows==1){ //se la query restituisce un solo risultato... sono autenticato
$row = $res->fetch_array(MYSQLI_ASSOC);
$msg="Benvenuto " . $row['NomeUtente'] . "<hr>";
echo $msg;}
else{echo "Accesso negato!<hr>";}
 
}
?>
 
<body>
  <form id="form1" name="form1"
  action="<?PHP echo $_SERVER['PHP_SELF'];?>" method="post">
  username<br>
    <input type="text" name="username">
    <br>
    password<br>
    <input type="password" name="password"><br>
    <input type="submit" name="submit">
  </form>
</body>
</html>