<?php


// On démarre la session AVANT d'écrire du code HTML 
session_start();
try
{
  // On se connecte à MySQL 
    $bdd = new PDO('mysql:host=localhost;dbname=test_projet;charset=utf8', 'root', '');
}
catch(Exception $e)
{// En cas d'erreur, on affiche un message et on arrête tout 
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


    <link rel="stylesheet" href="../bootstrap3/css/bootstrap.css">
    
    <!-- W3CSS !-->
     <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
     <!-- fontawesome !-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


     <!--pour scroll-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


     <style>
     #active
     {
        border-top: 5px solid #0ac20a;
        background-color: RGBa(10, 194, 10, 0.25);
     }


     .affix {
      top: 0;
      width: 100%;
      z-index: 9999 !important;
      }

      .affix + .container-fluid {
          padding-top: 70px;
      }

      nav a:hover
      {
        text-decoration: none;
      }

  

   </style>

  </head>
  <body class="w3-white">
    

<div class="w3-display-container" style="color:#fff;height:750px;">
  <img src="imgs/logo3.png" alt="boat" style="width:100%;min-height:350px;max-height:750px;">
</div>



       <!--si pas connecté : -->
      <?php if(!isset($_SESSION['id'])) 
        {
             


          ?>


                   <!--menu quand t'es pas connecté-->
           <nav data-spy="affix" data-offset-top="197"> 
            <div class="table">
                  <ul>
                              <li id="active"  class="menu-acc">
                                  <a href="accueil.php">ACCUEIL</a>
                              </li>
                              <li   class="menu-apro">
                                  <a href="apropos.php">A PROPOS</a>
                              </li>
                              <li class="menu-monprofil">
                                  <a href="monprofil.php">MON PROFIL</a>
                              </li>
                              <li  class="menu-jeux">
                                  <a href="Jeux.php">JEUX</a>
                              </li>
                              <li  class="menu-efraide">
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

          
        }


          else // on est connecté
      {

        ?>
               <!--menu avec deconnexion : -->
       <nav data-spy="affix" data-offset-top="197"> 
        <div class="table">
              <ul>
                          <li id="active"  class="menu-acc">
                              <a href="accueil.php">ACCUEIL</a>
                          </li>
                          <li   class="menu-apro">
                              <a href="apropos.php">A PROPOS</a>
                          </li>

                           <li class="menu-monprofil">
                            <a href="monprofil.php">MON PROFIL</a>
                          </li>

                              
                  


                          <li  class="menu-jeux">
                              <a href="Jeux.php">JEUX</a>
                          </li>
                          <li class="menu-efraide">
                              <a href="efrei'aide.php">EFR'AIDE</a>
                          </li>
                          <li  class="menu-con">
                              <a href="deconnexion.php">SE DECONNECTER</a>
                          </li>


                          <li  class="bonjour" style="margin-left:30px;">
                            <?php 
                              if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
                              {
                                  echo 'Bonjour ' . $_SESSION['pseudo'].' !'; //on affiche notre pseudo grace à la session
                              }?>
                          </li>

                          <li  class="bonjour" style="margin-left:600px;">
                          
                            <?php 
                            
                            if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
                              {
                                  echo $_SESSION['points'].' points'; //de même pour nos points
                              }?>
                          </li>

                          
                         
          </div>
      
        </nav>
          <div id="under-navbar-apropos"></div>




        <?php
      }
      ?>



  <div class="w3-content" style="max-width:1500px;margin-top:80px;margin-bottom:80px">



    <!-- Grid -->
  <div class="w3-row-padding" id="about">
    <div class="w3-center w3-padding-64">
      <span class="w3-xlarge w3-bottombar w3-border-dark-black w3-padding-16">SilkCarpet crée EFR'AIDE</span>
    </div>

    <div class="w3-third w3-margin-bottom">
      <div class="w3-card-4">
        <img src="imgs/eleve1.jpg" alt="aide" style="width:100%">
        <div class="w3-container">
          <h3>EFR'AIDE</h3>
          <p class="w3-opacity">Ou le site d'entraide</p>
          <p>Désormais tu pourras donner ou recevoir des cours avec des étudiants de l'Efrei et cela gratuitement !<br>Tu souhaites y accéder ?</p>
          <p><a href="efrei'aide.php"><button class="w3-button w3-light-grey ">Clique-ici !</button></a></p>
        </div>
      </div>
    </div>

    <div class="w3-third w3-margin-bottom">
      <div class="w3-card-4">
        <img src="imgs/echec_2.jpg" alt="echec" style="width:100%">
        <div class="w3-container">
          <h3>DES JEUX</h3>
          <p class="w3-opacity">Des jeux en ligne pour tous les goûts !</p>
          <p>SilkCarpet propose un large panel de jeux différents : vous pouvez y jouer pour vous divertir uniquement ou pour gagner des points et bénéficier de cours !</p>
          <p><a href="Jeux.php"><button class="w3-button w3-light-grey ">Clique-ici !</button></a></p>
        </div>
      </div>
    </div>

    <div class="w3-third w3-margin-bottom">
      <div class="w3-card-4">
        <img src="imgs/cont.jpg" alt="contact" style="width:100%">
        <div class="w3-container">
          <h3>SilkCarpet</h3>
          <p class="w3-opacity">Un projet</p>
          <p>Nous sommes 5 élèves de L2 et nous étudions actuellement à l'Efrei Paris. N'hésitez pas à nous contacter pour toute demande ou remarque !</p>
          <p><a href="Contact/contact.php"><button class="w3-button w3-light-grey">Contacte-nous ici !</button></a></p>
        </div>
      </div>
    </div>

  


   
 



  </div>

  


    <!-- Skills Section -->
<div class="w3-container w3-light-grey w3-padding-64">
  <div class="w3-row-padding">
    <div class="w3-col m6">
      <h3>Nos atouts et nos Skills.</h3>
      <p>Nous sommes tous les 5 des passionés de la vie<br>
      Nous aimons travailler en équipe, nous sommes de grands curieux et très peu paraisseux ce qui est notre point fort ! </p>
      <p>Nous ne sommes peut-être pas les rois du design <br>
      mais nous avons un humour à mourir de rire qui rend le travail plus agréable, rejoins-nous !</p>
    </div>
    <div class="w3-col m6">
      <p class="w3-wide"><i class=" w3-margin-right"></i>Passion</p>
      <div class="w3-grey">
        <div class="w3-container w3-dark-grey w3-center" style="width:90%">90%</div>
      </div>
      <p class="w3-wide"><i class=" w3-margin-right"></i>Humour</p>
      <div class="w3-grey">
        <div class="w3-container w3-dark-grey w3-center" style="width:85%">85%</div>
      </div>
      <p class="w3-wide"><i class=" w3-margin-right"></i>Curiosité</p>
      <div class="w3-grey">
        <div class="w3-container w3-dark-grey w3-center" style="width:75%">75%</div>
      </div>

      <p class="w3-wide"><i class=" w3-margin-right"></i>Html/Css/JS/PHP</p>
      <div class="w3-grey">
        <div class="w3-container w3-dark-grey w3-center" style="width:70%">70%</div>
      </div>

       <p class="w3-wide"><i class=" w3-margin-right"></i>Paresse</p>
      <div class="w3-grey">
        <div class="w3-container w3-dark-grey w3-center" style="width:10%">10%</div>
      </div>


    </div>
  </div>
</div>




</div>

  
    <!-- Footer -->
    <?php include("inclusion/footer.php");?>




  </body>

</html> 
