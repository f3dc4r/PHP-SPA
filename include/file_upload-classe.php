<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"></head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<div class="container">

<?php

$target_dir = "uploads/";
$uploadOK = 1;

if(isset($_POST['submit'])){
    $target_file = $target_dir . basename($_FILES['foto']['name']);
    //echo $_FILES['foto']['name']; // attenzione del valore name nella mia input qui name="foto"
    //echo $target_file;
    //echo $_FILES['foto']['tmp_name']
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION); //controllo l'estensione del file

    $check = getimagesize($_FILES['foto']['tmp_name']); //assegno la grandezza del file alla variabile check
    $check = mime_content_type($_FILES['foto']['tmp_name']);
    if($check !== false){
        echo "Il file è un'immagine di tipo " . $check['mime'] . "<br>";
        $uploadOK = 1;
    } else {
        echo "Il file non è un'immagine di tipo " . $check['mime']  . "<br>";
        $uploadOK = 0;
    }

    if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != "gif"){
        echo "Sono ammessi soltanto file di tipo JPG, JPEG, PNG, GIF<br>";
        $uploadOK = 0;
    }

    if($_FILES['foto']['size']>=102400){ //blocco il caricamento di file sopra i 1024kb
        echo "Le dimensioni del file sono troppo grandi<br>";
        $uploadOK = 0;
    }

    if(file_exists($target_file)){
        echo "Il file già esiste<br>";
        $uploadOK = 0;
    }

    if($uploadOK == 0){
        echo "Il file non è stato caricato";
    }else {

        if (move_uploaded_file( $_FILES['foto']['tmp_name'] , $target_file)){ //viene caricato un file tmp nel server e poi caricato nella destinazione
            echo "il file " . basename($_FILES['foto']['name']) . " è stato caricato<br>";
        } else {
            echo "Si è verificato un errore durante l'upload<br>";
        }
    }

    
}


?>

<form action="<?PHP echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">

<input type="file" name="foto" id="foto" accept="image/x-png, image/gif, image/jpeg">
<button type="submit" name="submit">Invia</button>

</form>

</div>