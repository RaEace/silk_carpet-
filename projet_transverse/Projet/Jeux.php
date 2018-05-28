<?php

session_start(); 


try 
{ 
// On se connecte à MySQL 
$bdd = new PDO('mysql:host=localhost;dbname=test_projet;charset=utf8', 'root', ''); 
} 
catch(Exception $e) 
{ 
// En cas d'erreur, on affiche un message et on arrête tout 
die('Erreur : '.$e->getMessage()); 
} 

?>


<!DOCTYPE html>
<html lang = "fr-FR">
  <head>
    <title>Silk Carpet</title>
    <meta charset = "utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <!-- materialize css !-->
    
    <!--ici comprend pas materialize-->


    <link rel="stylesheet" href="../bootstrap3/css/bootstrap.css">
    <!-- ou : <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->

    <!-- W3CSS !-->
     <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
     <!-- fontawesome !-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!--pour scroll-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



      <style >
       #active
       {
       border-top: 5px solid #ffb3ff;
  background-color: RGBa(255, 179, 255, 0.25);
      }

      .affix {
      top: 0;
      width: 100%;
      z-index: 9999 !important;
  }

  .affix + .container-fluid {
      padding-top: 70px;
  }
    
  body{
  height: 100%; /*100de base */
  /*Image only BG fallback*/
  
  /*background de couleur rosé = gradient + image pattern combo*/
  background: 
    linear-gradient(rgba(222, 102, 0, 0.6), rgba(0, 89, 182, 0.6))!important;
  }



    </style>

  </head>
  <body>
      
     <!--header>-->
   
      <?php include("inclusion/entete.php");?>

       
       

      <?php if(!isset($_SESSION['id'])) 
        {
             


          ?>


                   <!--menu quand t'es pas connecté-->
           <nav data-spy="affix" data-offset-top="197"> 
            <div class="table">
                  <ul>
                              <li  class="menu-acc">
                                  <a href="accueil.php">ACCUEIL</a>
                              </li>
                              <li   class="menu-apro">
                                  <a href="apropos.php">A PROPOS</a>
                              </li>
                              <li   class="menu-monprofil">
                                  <a href="monprofil.php">MON PROFIL</a>
                              </li>
                              <li  id="active" class="menu-jeux">
                                  <a href="Jeux.php">JEUX</a>
                              </li>
                              <li class="menu-efraide">
                                  <a href="efrei'aide.php">EFR'AIDE</a>
                              </li>
                              <li  class="menu-con">
                                  <a href="connexion.php">SE CONNECTER</a>
                              </li>
                              <li  class="menu-inscrire">
                                  <a href="inscrire.php">S'INSCRIRE</a>
                              </li>
                </ul>
              </div>
            </nav>
              <div id="under-navbar-apropos"></div>



          <?php


          echo '<p>|</p>'.'                Vous devez vous connecter pour accéder à cette partie du site. Pour se connecter, <a href=connexion.php><strong>clique-ici</strong></a>';
          
          

          
          echo '<p>|</p>';
          echo '<p>|</p>';
          echo '<p>|</p>';
          echo '<p>|</p>';
         echo '<p>|</p>';
          echo '<p>|</p>';

          echo '<p>|</p>';
          echo '<p>|</p>';
          echo '<p>|</p>';
         
          
          

          
        }


          else // on est connecté
      {

        ?>
               <!--menu avec deconnexion : -->
       <nav data-spy="affix" data-offset-top="197"> 
        <div class="table">
              <ul>
                          <li  class="menu-acc">
                              <a href="accueil.php">ACCUEIL</a>
                          </li>
                          <li   class="menu-apro">
                              <a href="apropos.php">A PROPOS</a>
                          </li>
                          <li class="menu-monprofil">
                              <a href="monprofil.php">MON PROFIL</a>
                          </li>
                          <li  id="active" class="menu-jeux">
                              <a href="Jeux.php">JEUX</a>
                          </li>
                          <li  class="menu-efraide">
                              <a href="efrei'aide.php">EFR'AIDE</a>
                          </li>
                          <li  class="menu-con">
                              <a href="deconnexion.php">SE DECONNECTER</a>
                          </li>

                          <li  class="bonjour" style="margin-left:700px;">
                          
                            <?php 
                            
                            if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
                              {
                                  echo $_SESSION['points'].' points';
                              }?>
                          </li>
                         
          </div>
        </nav>
          <div id="under-navbar-apropos"></div>







          <!--affichage des différents jeux avec liens redirgés vers d'autres page-->

      <div class="container" style="margin-top:40px;margin-bottom:30px">
        <div class="row">
          <div class="col-sm-4">
            <h3 style="text-align: center">Memory Game</h3>
            <p><a href="jeux_ligne/memorygame.php"><img src="imgs/memory1.jpg" alt="memory" style="width:100%"/></a></p>
          </div>

          <div class="col-sm-4">
            <h3 style="text-align: center">2048</h3>
            <p><a href="jeux_ligne/2048/index.php"><img src="imgs/2048.jpg" alt="memory" style="width:100%"/></a></p>
          </div>

          <div class="col-sm-4">
           <h3 style="text-align: center">Echec</h3>
           <p><a href="https://uimo.github.io/Games/docs/Chess"><img src="imgs/echec_1.jpg" alt="echec"
            style="width:100%"/></a></p>

          </div>
        </div>
      </div>


      <div class="container" style="margin-bottom:60px">
        <div class="row">
          <div class="col-sm-4">
            <h3 style="text-align: center">Morpion</h3>
            <p><a href="https://uimo.github.io/Games/docs/oxo"><img src="imgs/morpion.jpg" alt="echec"
            style="width:100%"/></a></p>
             
          </div>


        </div>
      </div>

  


         <?php
      } // fin else
     ?>




<!-- Footer -->
    <?php 
          include("inclusion/footer.php"); //notre footer

    ?>


 
  
</body>
   

  

</html>