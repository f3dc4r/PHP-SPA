<?PHP

session_start();
  if(isset($_SESSION['isLoggedIn']) && isset($_SESSION)){
    // distruggi sessione
    session_destroy();
    header("Location: template.php?id=5");
  }else{
    header("Location: template.php?id=5");
  }

/*
Per distruggere le variabili in PHP $nome = "pippo";
unset($nome);
*/

?>