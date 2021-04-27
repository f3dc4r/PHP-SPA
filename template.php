<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Un'applicazione SPA in Php con gestione del routing</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"></head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style media="screen">
      *{margin:0}
      header, menu, #corpo, footer{
        padding: 10px;
        margin: 5px auto;
        border: 1px solid #333;
      }

      header{
        height: 80px;
      }

      menu{
        min-height: 30px;
      }

      menu ul{margin:0; padding:0; width:100%; list-style: none;}
      menu ul li{
        width:16%; float:left; text-align: center;line-height: 30px;
      }

      footer{
        height:100px;
      }
      #corpo{
        min-height: 400px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <?php
        include "include/header.php";
        include "include/menu.php";
        include "include/corpo.php";
        include "include/footer.php";
       ?>

    </div>

  </body>
</html>
