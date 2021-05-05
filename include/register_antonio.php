<style media="screen">

  .error{

    background-color:yellow;

    border:1px solid red;

  }

  .testoRosso{

    color:red

  }

 

</style>

 

<?php

 

if($_POST){

 //check dati

 

 $patternEmail = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";

 $patternPass = "/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})/";

 $errorNome="";

 $errorCognome="";

 $errorEmail = "";

 $errorPassword="";

 $errorRipetiPassword="";

 $errorCheck="";

 $errorMessage = 0;//all'inizio c'è errore perchè i campi sono tutti vuoti

 

 //print_r($_POST);

 

 //NOME

 if(empty($_POST['nome'])){

   $errorMessage = 1;

   $errorNome="Il campo NOME non è valido";

 }

 

 //COGNOME

 if(empty($_POST['cognome'])){

   $errorMessage = 1;

   $errorCognome="Il campo Cognome non è valido";

 }

 

 //EMAIL

 if( empty($_POST['email']) ||

    !preg_match($patternEmail, $_POST['email'])

){

   $errorMessage = 1;

   $errorEmail .= "Il campo EMAIL non è valido";

 }

 

 //Password

 if(empty($_POST['password']) ||

    !preg_match($patternPass, $_POST['password'])

){

   $errorMessage = 1;

   $errorPassword = "Il campo PASSWORD non è valido";

 }

 

 //RIPETI  PASSWORD

 if(empty($_POST['ripetiPassword']) ||

    !preg_match($patternPass, $_POST['ripetiPassword'])

 ){

   $errorMessage = 1;

   $errorRipetiPassword="Il campo RIPETI PASSWORD non è valido";

 }

 

 //PASSWORD e RIPETI PASSWORD NON SONO UGUALI

  if($_POST['ripetiPassword'] !== $_POST['password']){

    $errorMessage = 1;

    $errorRipetiPassword="Il campo RIPETI PASSWORD deve essere uguale al campo PASSWORD";

 

  }

 

// CHECK PRIVACY

 

  if(!isset($_POST['check_1'])){

    $errorMessage = 1;

    $errorCheck = "Il campo PRIVACY deve essere selezionato";

  }

 

       if($errorMessage == 0){

         //echo "error: " . $errorMessage;

         //scrittura del nuovo utente nel DB

         include "conn.inc.php"; //=> $dbh come variabile di connessione

         $NomeUtente = $_POST['nome'];

         $CognomeUtente = $_POST['cognome'];

         $EmailUtente = $_POST['email'];

         //controllo se l'email è già presente => per gli studenti

         $PSWd = $_POST['password'];

 

         $query = "Insert into utenti(NomeUtente,CognomeUtente,EmailUtente,PSWd)";

         $query .= "Values('$NomeUtente', '$CognomeUtente', '$EmailUtente', sha1('$PSWd'))";

 

      //echo $query; //die();

           if (mysqli_query($dbh, $query)) {

               $msg = "Nuovo record creato con successo. ";

               //Debbo inviare un'email all'utente tramite la funzione mail

               //header("location:http://l4com.labforweb.it/backend/web/index.php?r=user/mail");

               //$_POST=[];

               ?>

               <div class="alert alert-success" role="alert">

                 <?PHP echo $msg . " Sarai ridirezionato alla pagina di Login tra qualche secondo";?> <a href="template.php?id=5">Effetua il Login</a>

               </div>

               <script type="text/javascript">

                 setTimeout(

                   ()=>{

                     location.href="template.php?id=5"

                   },1000

                 )

               </script>

 

        <?php   }

             else {

                   $error = "Errore: " . mysqli_error($dbh);

                 }?>

                 <div class="alert alert-danger" role="alert">

                   <?PHP echo $error;?>

                 </div>

 

       <?PHP }

           else{

             $error = "Errore di immissione dati - Riprovare";

             ?>

             <div class="alert alert-danger" role="alert">

               <?PHP echo $error;?>

             </div>

 

           <?PHP

             }

 

}

 

?>

<form method="post" enctype="multipart/form-data"

action = "<?PHP echo $_SERVER['PHP_SELF'];?>?id=6">

<div class="form-row">

   <div class="form-group col-md-6">

     <label for="nome">Nome</label>

     <?PHP if (isset($errorNome)){?>

     <input type="text" class="form-control error" id="nome" name = "nome"

     placeholder="Nome">

     <span class='testoRosso'><small><?php echo $errorNome;?></small></span>

   <?php }else{?>

         <?php

         if(empty($_POST['nome'])){?>

           <input type="text" class="form-control" id="nome" name = "nome"

           placeholder="Nome">

        <?php }else{?>

          <input type="text" class="form-control" id="nome" name = "nome"

          placeholder="Nome" value="<?php echo $_POST['nome'];?>">

        <?php } ?>

   <?php }?>

   </div>

 

   <div class="form-group col-md-6">

     <label for="cognome">Cognome</label>

     <?PHP if($errorCognome){?>

     <input type="text" class="form-control error" id="cognome" name = "cognome"

     placeholder="Cognome">

     <span class='testoRosso'><small><?php echo $errorCognome;?></small></span>

   <?php }else{?>

         <?php

         if(empty($_POST['cognome'])){?>

           <input type="text" class="form-control" id="cognome" name = "cognome"

           placeholder="Cognome">

        <?php }else{?>

          <input type="text" class="form-control" id="cognome" name = "cognome"

          placeholder="Cognome" value="<?php echo $_POST['cognome'];?>">

        <?php } ?>

   <?php }?>

   </div>

 

</div>

<div class="form-row">

  <div class="form-group col-md-6">

    <label for="EMAIL">Email</label>

    <?PHP if($errorEmail){?>

    <input type="text" class="form-control error" id="email" name = "email"

    placeholder="Email">

    <span class='testoRosso'><small><?php echo $errorEmail;?></small></span>

  <?php }else{?>

        <?php

        if(empty($_POST['email'])){?>

          <input type="text" class="form-control" id="email" name = "email"

          placeholder="Email">

       <?php }else{?>

         <input type="text" class="form-control" id="email" name = "email"

         placeholder="Email" value="<?php echo $_POST['email'];?>">

       <?php } ?>

  <?php }?>

  </div>

 

 </div>

 

 <div class="form-row">

   <div class="form-group col-md-6">

     <label for="password">Password</label>

     <?PHP if($errorPassword){

       ?>

     <input type="password" class="form-control error" id="password" name = "password"

     placeholder="Password">

     <span class='testoRosso'><small><?php echo $errorPassword;?></small></span>

   <?php }else{?>

         <?php

         if(empty($_POST['password'])){?>

           <input type="password" class="form-control" id="password" name = "password"

           placeholder="Password">

        <?php }else{?>

          <input type="password" class="form-control" id="password" name = "password"

          placeholder="Password" value="<?php echo $_POST['password'];?>">

        <?php } ?>

 

   <?php }?>

   </div>

 

   <div class="form-group col-md-6">

     <label for="password">Ripeti Password</label>

     <?PHP if($errorRipetiPassword){

       ?>

     <input type="password" class="form-control error" id="ripetiPassword" name = "ripetiPassword"

     placeholder="Ripeti Password">

     <span class='testoRosso'><small><?php echo $errorRipetiPassword;?></small></span>

   <?php }else{?>

 

         <?php

         if(empty($_POST['ripetiPassword'])){?>

           <input type="password" class="form-control" id="ripetiPassword" name = "ripetiPassword"

           placeholder="Ripeti Password">

        <?php }else{?>

          <input type="password" class="form-control" id="ripetiPassword" name = "ripetiPassword"

          placeholder="Ripeti Password" value="<?php echo $_POST['ripetiPassword'];?>">

        <?php } ?>

   <?php }?>

   </div>

 </div>

 <div class="form-check">

   <?PHP if($errorCheck){

     //echo $errorCheck;

     ?>

     <input type="checkbox" class="form-check-input" id="check_1" name="check_1">

     <label class="form-check-label" for="check_1">Ho letto

       <a href="https://www.labfortraining.it/labfortraining-privacy"

       target="_blank">l'informativa sulla privacy</a>

       e accetto le condizioni</label>

       <div><span class='testoRosso'><small><?php echo $errorCheck;?></small></span></div>

 

    <?php } else {

 

        if(!empty($_POST['check_1'])){?>

          <input type="checkbox" checked class="form-check-input" id="check_1" name="check_1">

          <label class="form-check-label" for="check_1">Ho letto

            <a href="https://www.labfortraining.it/labfortraining-privacy"

            target="_blank">l'informativa sulla privacy</a>

            e accetto le condizioni</label>

 

        <?php }else{?>

 

          <input type="checkbox"  class="form-check-input" id="check_1" name="check_1">

          <label class="form-check-label" for="check_1">Ho letto

            <a href="https://www.labfortraining.it/labfortraining-privacy"

            target="_blank">l'informativa sulla privacy</a>

            e accetto le condizioni</label>

 

        <?php }

 

    }?>

 

 

 </div>

 

 <button type="submit" class="btn btn-primary">Invia</button>

</form>

 

 <div class="form-group">

   Hai già un account? <a href="template.php?id=5">Accedi</a>

 </div>