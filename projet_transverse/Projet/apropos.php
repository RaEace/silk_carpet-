<?php 
// On démarre la session AVANT d'écrire du code HTML 
session_start(); 



try 
{ 
// On se connecte à MySQL 
$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', ''); 
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
    <!--<link rel="stylesheet" href="materialize.min.css">
    <!- W3CSS !-->
     <link rel="stylesheet" href="../bootstrap3/css/bootstrap.css">

     <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
     <!-- fontawesome !-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

     <!--pour scroll-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
#active
{border-top: 5px solid #99e6ff;
  background-color: RGBa(153, 230, 255, 0.15);
}

.affix {
      top: 0;
      width: 100%;
      z-index: 9999 !important;
  }

  .affix + .container-fluid {
      padding-top: 70px;
  }

  
</style>

  </head>
  <body class="w3-light-grey">
      
     
      <!--header>-->
   
      <?php include("inclusion/entete.php");?>


      <!--si pas connecté : -->
      <?php if(!isset($_SESSION['id'])) //la session n'existe pas S
        {
             


          ?>


                   <!--menu quand t'es pas connecté-->
           <nav data-spy="affix" data-offset-top="197"> 
            <div class="table">
                  <ul>
                              <li   class="menu-acc">
                                  <a href="accueil.php">ACCUEIL</a>
                              </li>
                              <li  id="active" class="menu-apro">
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
                          <li  class="menu-acc">
                              <a href="accueil.php">ACCUEIL</a>
                          </li>
                          <li  id="active"  class="menu-apro">
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


        <?php
      }
      ?>




<div class="w3-display-container w3-content w3-hide-small" style="max-width:1900px">
  <img src="imgs/the-school.jpg" alt="ecole" width="1900" height="600" ></div>
  <p></p>

  

   <div class="w3-row w3-center">
    <div class="w3-col" style= "width: 20%";><p></p></div>
      <div class="w3-col" style= "width: 60%";>
   
        <div class="w3-container w3-card-4 w3-padding-16 w3-white " style="margin-top:50px">
          <h2>Qui sommes-nous ?</h2>
            <p> Nous sommes cinq etudiants de l'école d'ingénieur Efrei Paris, et dans le cadre de nos études nous avons dû réalier un projet. Nous avons décidé de réaliser SilkCarpet ! </p>
            <p>Grâce à Silk Carpet, vous pouvez jouer à des jeux, tout en gagnant des points afin de donner des cours à des étudiants de l'Efrei Paris. Vous pouvez égalemment recevoir des cours ! Mathématiques, physique, informatique, même la formation générale... tout est possible ! Et cela gratuitement ! <br/>Enjoy</p>
            <div class="w3-image">
                <img src="imgs/photo4.jpg" alt="nous2" style="width:50%"/>
            </div>
            <h2>Tu souhaites nous contacter ?</h2>
            <p> <a href="Contact/contact.php" style="font-weight: bold">Clique ici</a> si tu veux nous laisser un message ! Nous t'y répondrons au plus vite. </p>
      </div>
    </div>
  </div>



<div class="w3-content" style="max-width:1100px;margin-top:80px;margin-bottom:80px">
  <div class="w3-center w3-padding-64">
        <span class="w3-xlarge w3-bottombar w3-border-dark-grey w3-padding-16">La Dream Team </span>
    <!-- Grid -->
  <div class="w3-row-padding" id="about">

    <div class="w3-center w3-padding-64">
      
    </div>

    <div class="w3-third w3-margin-bottom">
      <div class="w3-card-4">
        <img src="imgs/jules.jpg" alt="John" style="width:100%">
        <div class="w3-container">
          <h3>LAGNY Jules</h3>
          <p class="w3-opacity">Chef de projet</p>
          <p><br><br></p>
              <p><a href="Contact/contact.php"><button class="w3-button w3-block" style="background-color: #cccccc";>Contacter</button></a></p>
        </div>
      </div>
    </div>

    <div class="w3-third w3-margin-bottom">
      <div class="w3-card-4">
        <img src="imgs/stef.jpg" alt="Mike" style="width:100%">
        <div class="w3-container">
          <h3>KUKOVSKI Stefania</h3>
          <p class="w3-opacity">Responsable technique</p>
          <p><br><br></p>
              <p><a href="Contact/contact.php"><button class="w3-button w3-block" style="background-color: #cccccc";>Contacter</button></a></p>
        </div>
      </div>
    </div>

    <div class="w3-third w3-margin-bottom">
      <div class="w3-card-4">
        <img src="imgs/amandine.jpg" alt="Jane" style="width:100%">
        <div class="w3-container">
          <h3>MINIER Amandine</h3>
          <p class="w3-opacity">Responsable design</p>
          <p><br><br></p>
          <p><a href="Contact/contact.php"> <button class="w3-button w3-block" style="background-color: #cccccc";>Contacter</button></a></p>
        </div>
      </div>
    </div>

  
    



    <div class="w3-row w3-margin-bottom">
     
          <!--cette ligne sert juste a décaler, w3 col veut dire un bloc ici de 18%--> 
         <div class="w3-col" style="width:18%"><p></p></div>

         <div class="w3-col w3-card-4" style="width:32%"><img src="imgs/mathis2.jpg" alt="Jane" style="width:100%">
            <div class="w3-container">
              <h3>POWELL Mathis</h3>
              <p class="w3-opacity">Responsable qualité</p>
              <p><br><br></p>
              <p><a href="Contact/contact.php"><button class="w3-button w3-block" style="background-color: #cccccc";>Contacter</button></a></p>
           </div>
        </div> 

   
        <div class="w3-col w3-card-4 w3-margin-left" style="width:32%";><img src="imgs/lilia.jpg" alt="Jane" style="width:100%">
        
          <div class="w3-container">
            <h3>CHERIF Lilia</h3>
            <p class="w3-opacity">Responsable communication</p>
            <p><br><br></p>
              <p><a href="Contact/contact.php"><button class="w3-button w3-block" style="background-color: #cccccc";>Contacter</button></a></p>
          </div>
         </div>
      </div>




    </div>

  </div><!--fin du centrage -->
    

</div>


     <!-- Footer -->
    <?php include("inclusion/footer.php");?>

  </body>

</html>
