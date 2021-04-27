<?PHP 
  session_start();
  if(isset($_SESSION['isLoggedIn']) && isset($_SESSION)){ //se sono loggato
    ?>
    <h2>Benvenuto <?php echo $_SESSION['user']['NomeUtente']; ?></h2>
    <h4>Profilo</h4>
    <table class= "table table-bordered">
        <?PHP 
        foreach ($_SESSION['user'] as $key => $value): ?>
            <tr>
                <th><?PHP echo $key; ?></th>
                <td><?PHP echo $value; ?></td>
            </tr>
        <?PHP endforeach; ?>
        <tr>
        </tr>
    </table>
 <?PHP }

?>