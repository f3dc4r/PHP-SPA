<?PHP
session_start();
if (isset($_SESSION['isLoggedIn']) && isset($_SESSION)) {
    header("Location: template.php?id=7"); //dashboard
}

?>

<h2>Registrati</h2>

<?php
$error = "";
if ($_POST) {
    //print_r($_POST);
    $patternEmail = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
    $patternPass = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/";

    //Verifica se i dati sono passati correttamente
    if (
        isset($_POST['nome']) && !empty($_POST['email']) &&

        isset($_POST['cognome']) && !empty($_POST['email']) &&

        isset($_POST['email']) && !empty($_POST['email']) &&
        preg_match($patternEmail, $_POST['email']) &&

        isset($_POST['password']) && !empty($_POST['password']) &&
        preg_match($patternPass, $_POST['password']) &&

        isset($_POST['ripetipassword']) && !empty($_POST['ripetipassword']) &&
        ($_POST['ripetipassword'] === $_POST['password']) &&

        isset($_POST['check_1'])
    ) {
        //Autenticazione
        //connessione col DB- includere un file conn.inc.php
        include "conn.inc.php"; // restituisce variabile database connessione
        $nomeutente = $_POST['nome'];
        $cognomeutente = $_POST['cognome'];
        $emailutente = $_POST['email'];
        $password = sha1($_POST['password']);
        $dataregistrazione = date("Y-m-d H:i:s");

        //esecuzione query
        $query = "INSERT INTO utenti (NomeUtente, CognomeUtente, EmailUtente, PSWd, DataRegistrazione)
                    VALUES ('$nomeutente','$cognomeutente', '$emailutente', '$password', $dataregistrazione)";

        if (mysqli_query($dbh, $query)) {

            $RegisterOk = "Registrazione correttamente effettuata";
?>
            <div class="alert alert-success" role="alert">
                <?PHP echo $RegisterOk; ?>
            </div>
        <?PHP
        } else {
            $errorAut = "Non è stato possibile eseguire la registrazione";
        ?>
            <div class="alert alert-danger" role="alert">
                <?PHP echo $errorAut; ?>
            </div>
    <?PHP

            //$queryResult = "SELECT EmailUtente FROM utenti WHERE EmailUtente = '$emailutente'";
            //echo $query; die(); //DEBUG SQL
            //$register = mysqli_query($dbh, $query) or die("Register Error");
            //$result = mysqli_query($dbh, $queryResult) or die("Query Error");
            //$row = mysqli_fetch_assoc($result);
            //print_r($row);
            //if (mysqli_num_rows($result) == 1) {
            //session_start(); //inizializzo la sessione
            //$_SESSION['isLoggedIn'] = 1;
            //$_SESSION['user'] = $row;

        }
    } else {
        //Dati non validi
        $error = "errore di immisisone dati - Riprovare";
    } ?>
    <?PHP if (!empty($error)) { ?>
        <div class="alert alert-danger" role="alert">
            <?PHP echo $error; ?>
        </div>
    <?PHP } ?>
<?PHP
} //se i dati sono stati postati

?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=6">
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Inserisci il tuo Nome">
    </div>
    <div class="form-group">
        <label for="cognome">Cognome</label>
        <input type="text" class="form-control" id="cognome" name="cognome" placeholder="Inserisci il tuo cognome">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Inserisci la tua email">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="ripetipassword">Ripeti Password</label>
        <input type="password" class="form-control" id="ripetipassword" name="ripetipassword" placeholder="Ripeti Password">
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" name="check_1" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Ho letto <a href="https://www.labfortraining.it/labfortraining-privacy" target="_blank"> l'informativa sulla privacy e accetto le condizioni</a></label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<div class="form-group">
    <span>Sei già registrato? <a href="<?php echo $_SERVER['PHP_SELF']; ?>?id=5">Login</a></span>
</div>