<?php 
// On démarre la session AVANT d'écrire du code HTML 
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
        border-top: 5px solid #ff6666;
	background-color: RGBa(255, 102, 102, 0.25);
     }

     .affix {
      top: 0;
      width: 100%;
      z-index: 9999 !important;
  }

  .affix + .container-fluid {
      padding-top: 70px;
  }

  #case .style {

        background: white;
        border: 0 none;
        border-radius: 3px;
        box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
        padding: 40px 30px;
        box-sizing: border-box;
        width: 80%;
        margin: 0 10%;
        
        
        position: relative;
      }

      #case {

        width: 630px; 
        height: 350px; 
        margin: 50px auto;

        position: relative;
        margin-bottom :30px;
      }


 </style>

	</head>
	 <body class="w3-light-grey">
      
     <!--header>-->
   
      <?php include("inclusion/entete.php");?>

    
      


       <!--si pas connecté : -->
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
                              <li class="menu-monprofil">
                                  <a href="monprofil.php">MON PROFIL</a>
                              </li>
                              <li  class="menu-jeux">
                                  <a href="Jeux.php">JEUX</a>
                              </li>
                              <li id="active" class="menu-efraide">
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
         
          include("inclusion/footer.php");
          

          
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
                          <li  class="menu-jeux">
                              <a href="Jeux.php">JEUX</a>
                          </li>
                          <li id="active" class="menu-efraide">
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





         <?php //on prépare la requete pour récuperer pseudo, email classe et matière des membres dans la base de données

          $req = $bdd->prepare('SELECT pseudo, email, classe, matiere FROM membres1 ');
    
           $pseudo= $_SESSION['pseudo'];


          $req->execute(array( 'pseudo'=>$pseudo  ));
          
          while ($donnees = $req->fetch())
          {
            ?>
              
                <?php

            if( (strtolower($donnees['pseudo']) != strtolower($pseudo)) && $donnees['matiere'])
            {// si le pseudo n'est pas l'utilisateur connecté si l'utilisateur donne des cours, on affiche les différents étudiants donnant des cours
          //on utilise strlower() dans le cas ou des pseudo sont en majuscules, strlower() convertit tous les caractères alphabétiques en minuscules. 
             ?>
           


                    <?php/*
             if ($donnees['matiere'])// 
              {*/
                ?>
                <div id="case">
                  <div class="style">
                    <?php

                     echo '<h4 class="mot"><strong>Pseudo : </strong>'. $donnees['pseudo'] . '<br /><br />';
                    echo '<strong>Email Efrei ou Esigetel : </strong>'. $donnees['email'] . '<br /><br />';
                  
                    echo '<strong>Classe : </strong>'.$donnees['classe'] . '<br /><br />';
                    echo '<strong>Matière(s) donnée(s): </strong>'.$donnees['matiere'] . '';

               // }


              }

            
       ?>
                 </div>

               </div>

        <?php 
        }


$req->closeCursor(); // Termine le traitement de la requête  


?>



        <?php
      ?>


      
<!-- Footer -->
    <?php include("inclusion/footer.php");
  }  

  ?>


	</body>

</html>
