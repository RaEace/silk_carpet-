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
  <meta charset="UTF-8">
  <title>Inscription</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  
      <link rel="stylesheet" href="css_formulaire/style.css">
      <link rel="stylesheet" href="../bootstrap3/css/bootstrap.css">


    <link rel="stylesheet" href="style.css">
    
    <!-- W3CSS !-->
     <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
     <!-- fontawesome !-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

     <!--pour scroll-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


     <style>
      #active
      {border-top: 5px solid #ffa64d;
  background-color: RGBa(255, 166, 77, 0.25);
      }

.affix {
      top: 0;
      width: 100%;
      z-index: 9999 !important;
  }

  .affix + .container-fluid {
      padding-top: 70px;
  }

    body
    {

  background: 
    linear-gradient(rgba(196, 102, 0, 0.6), rgba(155, 89, 182, 0.6))!important;
    }


    </style>

     </head>
  
  <body>
      
      <!--header>-->
   
      <?php include("inclusion/entete.php");?>

      
      <!--menu-->
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
                      <li class="menu-efraide">
                          <a href="efrei'aide.php">EFR'AIDE</a>
                      </li>
                      <li  id="active" class="menu-con">
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
//on va vérifier si la connexion marche

 if (isset($_POST['pseudo']) && isset($_POST['pass'])) { //si le pseudo et le mot de passe ont bien été rentré

  $pseudo = $_POST['pseudo'];

  //  Récupération de l'utilisateur et de son pass hashé
  $req = $bdd->prepare('SELECT id, pass, points FROM membres1 WHERE pseudo = :pseudo');
  $req->execute(array(
      'pseudo' => $pseudo));

  $resultat = $req->fetch();

  

  // Comparaison du pass envoyé via le formulaire avec la base en hasché
  $isPasswordCorrect = password_verify($_POST['pass'], $resultat['pass']);

  if (!$resultat)
  {
      echo 'Mauvais identifiant ou mot de passe !';
  }
  
  else
  {
      if ($isPasswordCorrect) {
          $_SESSION['id'] = $resultat['id']; /*création de variable de sessions qui nous servirons pour l'affichage du pseudo ou points*/
          $_SESSION['pseudo'] = $pseudo;
          $_SESSION['points'] = $resultat['points'];
          echo 'Vous êtes connecté !';
          return header('Location: accueil.php');// une fois qu'on est connecté, on est redirigé vers l'accueil
      }
      else {
          echo 'Mauvais identifiant ou mot de passe !';
      }
  }

}



?> 







      <!--formulaire-->
    <form method="post" action="connexion.php" id="msform">
       
      <br/>
      <!-- fieldsets -->
      <fieldset>
        <br/>
        <h2 class="fs-title">Connexion à son compte</h2><br/>
        <input type="text" name="pseudo" placeholder="Pseudo" />

        <input type="password" name="pass" placeholder="Mot de passe" />
        <br/>
        <h3 class="fs-subtitle"><br/>Tu n'as pas de compte ?<br/><br/><a href="inscrire.php" class="fs-subtitle" style="font-weight: bold"> Inscris-toi ici !</a><br/></h3>
      

          <input type="submit" value="SE CONNECTER" />

      </fieldset><br/><br/><br/>
         
  </form>
  
 



   <!-- Footer -->
    <?php include("inclusion/footer.php");?>


    

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>

  
    <script  src="js_formulaire/index.js"></script> 



  </body>

</html>
