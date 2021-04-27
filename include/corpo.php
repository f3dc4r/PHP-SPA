<div class="" id="corpo">
  <?php
  /*
  Costruiamo una procedura di Routing
  Per testare se nell'url esiste il parametro id come
  parametro di querystring
  */
  // switch($_GET['id']){
  //   case '0':
  //   //...
  //   break;
  //
  //   case '1':
  //   //...
  //   break;
  // //  ....
  //
  //   default:
  //   //....
  //   break;
  //
  // }

  if(isset($_GET['id'])){//Home
    //posso gestire le rotte previste
    if($_GET['id']==0){
      echo "<h2>HOME</h2>";//injection dei contenuti
    }
      else if($_GET['id']==1){ //Chi Siamo
        include "chi-siamo.html";
      }
        else if($_GET['id']==2){ //Servizi

          include "servizi.html";
        }
          else if($_GET['id']==3){ //Gallery

            include "gallery.php";
          }
          else if($_GET['id']==4){ //Contatti

            include "contatti.html";
          }
          else if($_GET['id']==5){ //Area riservata -Login

            include "login.php";
          }
            else if($_GET['id']==6){ //Area riservata- Registrati

              include "register.php";
            }

            else if($_GET['id']==7){ //Area riservata - Dashboard
              
              include "dashboard.php";
            }

            else if($_GET['id']==8){ //Area riservata - Profilo
              
              include "profilo.php";
            }

            else if($_GET['id']==9){ //Area riservata - Logout
              
              include "logout.php";
            }

            else if($_GET['id']==10){ //Area riservata - Ordini
              
              include "ordini.php";
            }

              else{
                //faccio un redirect sull'Home Page
                header("Location:" . $_SERVER['PHP_SELF'] . "?id=0");
              }


  }else{
    //faccio un redirect sull'Home Page
    header("Location:template.php?id=0");
  }

   ?>
</div>
