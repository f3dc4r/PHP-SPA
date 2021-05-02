<?PHP 
  session_start();
  if(isset($_SESSION['isLoggedIn']) && isset($_SESSION)){
    header("Location: template.php?id=7"); //dashboard
  }

?>

<h2>Area Riservata</h2>


<?php
$error="";

if($_POST){
  //print_r($_POST);
  $patternEmail = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
  $patternPass = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/";

  //Verifica se i dati sono passati correttamente
    if(
      isset($_POST['email']) && !empty($_POST['email']) &&
      preg_match($patternEmail, $_POST['email']) &&

      isset($_POST['password']) && !empty($_POST['password']) &&
      preg_match($patternPass, $_POST['password']) &&
      isset($_POST['check_1'])
    ){
      //Autenticazione
      //connessione col DB- includere un file conn.inc.php
      include "conn.inc.php"; // restituisce variabile database connessione
      $EmailUtente = $_POST['email'];
      $Password = $_POST['password'];
      //rimpiazzare il carattere apostrofo e codificare i caratteri <, >
      //addSlashes php
      //esecuzione query
      $query = "Select * from utenti where EmailUtente = '$EmailUtente'
                AND PSWd = sha1('$Password')
                AND disabilitato = 0";
      // echo $query; die(); DEBUG SQL
      $result = mysqli_query($dbh, $query) or die("Query Error"); //Restituisce un oggetto
      $row = mysqli_fetch_assoc($result);
      //print_r($row);
      if(mysqli_num_rows($result) == 1){ //importantissimo perché deve essere strettamente uguale a 1
        session_start(); //inizializzo la sessione
        $_SESSION['isLoggedIn'] = 1;
        $_SESSION['user'] = $row;?>
        <div class="alert alert-success" role="alert">
          Login success! Sarai ridirezionato alla tua dashboard entro 3 secondi
        </div>

        <div class="spinner-border" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>

        <script type="text/javascript">
          setTimeout(
            () =>{
              location.href="template.php?id=7" //Dashboard personale dopo 3 secondi con javascript
            }, 3000
          )
        </script>

        <?PHP //header("Location: template.php?id=7");//Dashboard personale
      }else{
        $errorAut = "Non sei autenticato <a href='template.php?id=6'>Registrati</a>";
        ?>
        <div class="alert alert-danger" role="alert">
        <?PHP echo $errorAut; ?>
      </div>
      <?PHP
      }

        

    }else{
      //Dati non validi
      $error = "errore di immisisone dati - Riprovare";
    }?>
    <?PHP if(!empty($error)) {?>
      <div class="alert alert-danger" role="alert">
        <?PHP echo $error; ?>
      </div>
      <?PHP }?>
<?PHP
}//se i dati sono stati postati

 ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?id=5">
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password"  name="password" placeholder="Password">
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input"
    name = "check_1" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Ho letto <a href="https://www.labfortraining.it/labfortraining-privacy" target="_blank"> l'informativa sulla privacy e accetto le condizioni</a></label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<div class="form-group">
  <span>Non hai un account? <a href="<?php echo $_SERVER['PHP_SELF'];?>?id=6">Registrati</a></span>
</div>
