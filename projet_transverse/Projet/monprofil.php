<?php 
// On démarre la session AVANT d'écrire du code HTML 
session_start(); 
// On s'amuse à créer quelques variables de session dans $_SESSION 


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


	     <style >
	     #active
	     {
	     border-top: 5px solid #557ef6;
		background-color: RGBa(85, 126, 246,0.25);
			}

	 .affix {
      top: 0;
      width: 100%;
      z-index: 9999 !important;
      }

      .affix + .container-fluid {
          padding-top: 70px;
      }
      #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 3px;
        box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
        padding: 50px 30px;
        box-sizing: border-box;
        width: 80%;
        margin: 0 10%;
        
       
        position: relative;
      }

      #msform {

        width: 630px; 
        height: 650px; 
        margin: 50px auto;

        position: relative;
        margin-bottom :10px;
      }

      #msform .mot
      {
        font-size : 18px;
        

      }

      body
      {
        
         background: 
         linear-gradient(0.25turn, #3f87a6, #ebf8e1,#f69d3c);
    
      }

  

		</style>


	</head>
	<body>
		
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
                              <li id="active"  class="menu-monprofil">
                                  <a href="monprofil.php">MON PROFIL</a>
                              </li>
                              <li  class="menu-jeux">
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
                          <li id="active"  class="menu-monprofil">
                              <a href="monprofil.php">MON PROFIL</a>
                          </li>
                          <li  class="menu-jeux">
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




<div id="msform">
  <fieldset>

         <?php

          $req = $bdd->prepare('SELECT * FROM membres1 WHERE pseudo = :pseudo'); /*cette requête permet de récuper tous les champs ( avec *) de notre tables membre où le pseudo vaut le pseudo de la personne connectée*/
    
            $pseudo= $_SESSION['pseudo'];


          $req->execute(array( 'pseudo'=>$pseudo  ));
          
          while ($donnees = $req->fetch())
          {

        echo '<h4 class="mot"><strong>Pseudo : </strong>'. $donnees['pseudo'] . '<br /><br />'; //on affiche le pseudo de l'utilisateur actuellement connecté
        echo '<strong>Email Efrei ou Esigetel : </strong>'. $donnees['email'] . '<br /><br />';
        echo '<strong>Nom : </strong>'. $donnees['lname'] . '<br /><br />';
        echo '<strong>Prénom : </strong>'.$donnees['fname'] . '<br /><br />';

        echo '<strong>Numéro de téléphone : </strong>'.$donnees['tel'] . '<br /><br />';
        echo '<strong>Adresse : </strong>'.$donnees['adresse'] . '<br /><br />';
        echo '<strong>Code Postal : </strong>'.$donnees['postal'] . '<br /><br />';
        echo '<strong>Classe : </strong>'.$donnees['classe'] . '<br /><br />';
        if($donnees['matiere']) // si l'utilisateur donne des matières, on les affiches
        {
          echo '<strong>Matière(s) donnée(s): </strong>'.$donnees['matiere'] . '<br /><br />';
        }
        else
        {
          echo '<strong>Matière(s) donnée(s)</strong> : Aucune'. '<br /><br />';;
        }

        echo '<strong>Nombre de points : </strong>'.$donnees['points'] . '<br /></h4>'; // sinon on affiche "aucune" ,  $donnees['points'] ici étant null
}

$req->closeCursor(); // Termine le traitement de la requête  */

?>
</fieldset>
</div>
       


         <?php
      } 
     ?>




      


      
      <!-- Footer -->
    <?php include("inclusion/footer.php");?>


	</body>

</html>
