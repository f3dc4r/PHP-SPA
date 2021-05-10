<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"></head>

<div class="container">
  <?php
    $target_dir="img/";
    $uploadOK = 1;
 
    // $_GET, $_POST, $_REQUEST
    // $_SESSION
    // $_SERVER
    if(isset($_POST['submit'])){
        $target_file = $target_dir . basename($_FILES['foto']['name']);
         //echo $target_file ."<br>";
         //echo $_FILES['foto']['tmp_name'] . "<br>";
 
         //$check=getimagesize($_FILES['foto']['tmp_name']);
 //         $mime_types = array(
 // //text
 //             'txt' => 'text/plain',
 //             'htm' => 'text/html',
 //             'html' => 'text/html',
 //             'php' => 'text/html',
 //             'css' => 'text/css',
 //             'js' => 'application/javascript',
 //             'json' => 'application/json',
 //             'xml' => 'application/xml',
 //             'swf' => 'application/x-shockwave-flash',
 //             'flv' => 'video/x-flv',
 //
 //              // images
 //              'png' => 'image/png',
 //              'jpe' => 'image/jpeg',
 //              'jpeg' => 'image/jpeg',
 //              'jpg' => 'image/jpeg',
 //              'gif' => 'image/gif',
 //              'bmp' => 'image/bmp',
 //              'ico' => 'image/vnd.microsoft.icon',
 //              'tiff' => 'image/tiff',
 //              'tif' => 'image/tiff',
 //              'svg' => 'image/svg+xml',
 //              'svgz' => 'image/svg+xml',
 //
 //           );
 
        //print_r($mime_types);
 
         $check = mime_content_type($_FILES['foto']['tmp_name']);
         echo $check . "<br>";
         $pos = strpos($check,"image"); //controllo la prima occorrenza della parola img all'interno della variabile $check
         echo $pos . "<br>";
 
          if(strpos($check,"image")===false){
            echo "il file non è un'immagine<br>";
             $uploadOK = 0;
          } else {
              echo "la parola image è stata torvata in posizione" . $pos . "<br>";
          }
 
         $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
 
         if($imageFileType !='jpg' && $imageFileType!='png' &&
            $imageFileType !='jpeg' && $imageFileType != "gif"
         ){
           echo "Sono ammessi soltanto file di tipo JPG, JPEG, PNG, GIF<br>";
           $uploadOK = 0;
         }
 
         if($_FILES['foto']['size']>=1024000){
           echo "Le dimensioni del file sono troppo grandi<br>";
            $uploadOK = 0;
         }
 
         if(file_exists($target_file)){
           echo "Il file già esiste<br>";
            $uploadOK = 0;
         }
 
         if($uploadOK ==0){
           echo "Il file non è stato uploadato";
         }else {
           if(move_uploaded_file( $_FILES['foto']['tmp_name'],
           $target_file)){
             echo "il file " . basename($_FILES['foto']['name']) . " è stato uploadato<br>";
           }else{
             echo "Si è verificato un errore durante l'upload<br>";
           }
         }
 
 
    }
 
   ?>
   <style media="screen">
     form{
       margin: 20px;
 
     }
 
     input{
       border:1px solid gray;
       padding:20px;
     }
   </style>
   <form action="<?PHP echo $_SERVER['PHP_SELF'];?>" method="post"
   enctype="multipart/form-data">
   <input type="file" name="foto" id="foto"
   accept="image/jpg, image/jpeg, image/gif, image/x-png">
   <button type="submit" name="submit">Invia</button>
   </form>
 
</div>