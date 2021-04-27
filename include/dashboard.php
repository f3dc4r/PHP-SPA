<?PHP
session_start();
if (isset($_SESSION) && isset($_SESSION['isLoggedIn'])) {
    //print_r($_SESSION);
?>
    <h2>Benvenuto <?php echo $_SESSION['user']['NomeUtente']; ?></h2>
    <h4><a href="template.php?id=8">Profilo</a></h4>
    <h4><a href="template.php?id=10">Ordini</a></h4>
    <h4><a href="template.php?id=9">Logout</a></h4>

<?PHP } else {
    header("Location: template.php?id=0"); //Vai all'home Page
}
?>