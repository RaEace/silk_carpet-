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




<?php  
    define( 'MAIL_TO', /* >>>>> */'silkcarpet@outlook.fr'/* <<<<< */ );  //ajout du mail qu'on a créer
    define( 'MAIL_FROM', '' ); // valeur par défaut  
    define( 'MAIL_OBJECT', '' ); // valeur par défaut  
    define( 'MAIL_MESSAGE', '' ); // valeur par défaut  

    $mailSent = false; // drapeau qui aiguille l'affichage du formulaire OU du récapitulatif  
    $errors = array(); // tableau des erreurs de saisie  
      
    if( filter_has_var( INPUT_POST, 'send' ) ) // le formulaire a été soumis avec le bouton [Envoyer]  
    {  
        $from = filter_input( INPUT_POST, 'from', FILTER_VALIDATE_EMAIL );  
        if( $from === NULL || $from === MAIL_FROM ) // si le courriel fourni est vide OU égale à la valeur par défaut  
        {  
            $errors[] = 'Vous devez renseigner votre adresse de courrier électronique.';  
        }  
        elseif( $from === false ) // si le courriel fourni n'est pas valide  
        {  
            $errors[] = 'L\'adresse de courrier électronique n\'est pas valide.';  
            $from = filter_input( INPUT_POST, 'from', FILTER_SANITIZE_EMAIL );  
        }  

        $object = filter_input( INPUT_POST, 'object', FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_HIGH | FILTER_FLAG_ENCODE_LOW );  
        if( $object === NULL OR $object === false OR empty( $object ) OR $object === MAIL_OBJECT ) // si l'objet fourni est vide, invalide ou égale à la valeur par défaut  
        {  
            $errors[] = 'Vous devez renseigner l\'objet.';  
        }  


        $message = filter_input( INPUT_POST, 'message', FILTER_UNSAFE_RAW );  
        if( $message === NULL OR $message === false OR empty( $message ) OR $message === MAIL_MESSAGE ) // si le message fourni est vide ou égale à la valeur par défaut  
        {  
            $errors[] = 'Vous devez écrire un message.';  
        }  

        if( count( $errors ) === 0 ) // si il n'y a pas d'erreurs  
        {   
               if( mail( MAIL_TO, $object, $message, "From: $from\nReply-to: $from\n" ) ) // tentative d'envoi du message  
            {  
                $mailSent = true;  
            }  
            else // échec de l'envoi  
            {  
                $errors[] = 'Votre message n\'a pas été envoyé.';  
            }
             
        }  
    }  
    else // le formulaire est affiché pour la première fois, avec les valeurs par défaut  
    {  
        $from = MAIL_FROM;  
        $object = MAIL_OBJECT;  
        $message = MAIL_MESSAGE;  
    }  
?>  


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Contact V8</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
	<!--lien pour le site -->
	<link rel="stylesheet" href="../style.css">

    
    <!-- W3CSS !-->
     <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
     <!-- fontawesome !-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

     <!--pour scroll-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


  	<style>
  	.affix {
      top: 0;
      width: 100%;
      z-index: 9999 !important;
  }

  .affix + .container-fluid {
      padding-top: 70px;
  }
  .bonjour
			  {
			  	margin-top:15px;
			  	
			  	color:white;
			  	font-weight: bold;
			  	font-size: 20px;
			  }

</style>

</head>
<body>



	    <!--header-->

	<div class="container-fluid" style= "height:260px;background-color:#e0e0e0";> 
        <img src="../imgs/silk1.png" alt="silk" style="width:12%;float:left"; class="w3-circle">
        <h1 style="position: relative;left:-100px;font-size:50px";>SILKCARPET</h1>
        <h3 style="position: relative;left:15px";>EFR'AIDE</h3>
        <p style="position: relative;left:15px";>Site de jeux en ligne</p>
        <p style="position: relative;left:15px";>et d'échanges de cours gratuits !</p>
     
      </div>


      <?php if(!isset($_SESSION['id'])) 
        {
             


          ?>


                   <!--menu quand t'es pas connecté-->
           <nav data-spy="affix" data-offset-top="197"> 
            <div class="table">
                  <ul>
                              <li  class="menu-acc">
                                  <a href="../accueil.php">ACCUEIL</a>
                              </li>
                              <li   class="menu-apro">
                                  <a href="../apropos.php">A PROPOS</a>
                              </li>
                              <li   class="menu-monprofil">
                                  <a href="../monprofil.php">MON PROFIL</a>
                              </li>
                              <li   class="menu-jeux">
                                  <a href="../Jeux.php">JEUX</a>
                              </li>
                              <li class="menu-efraide">
                                  <a href="../efrei'aide.php">EFR'AIDE</a>
                              </li>
                              <li  class="menu-con">
                                  <a href="../connexion.php">SE CONNECTER</a>
                              </li>
                              <li  class="menu-inscrire">
                                  <a href="../inscrire.php">S'INSCRIRE</a>
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
                              <a href="../accueil.php">ACCUEIL</a>
                          </li>
                          <li   class="menu-apro">
                              <a href="../apropos.php">A PROPOS</a>
                          </li>
                          <li class="menu-monprofil">
                              <a href="../monprofil.php">MON PROFIL</a>
                          </li>
                          <li   class="menu-jeux">
                              <a href="../Jeux.php">JEUX</a>
                          </li>
                          <li  class="menu-efraide">
                              <a href="../efrei'aide.php">EFR'AIDE</a>
                          </li>
                          <li  class="menu-con">
                              <a href="../deconnexion.php">SE DECONNECTER</a>
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













<?php  
    if( $mailSent === true ) // si le message a bien été envoyé, on affiche le récapitulatif  
    {  
?>  
        <p id="success">Votre message a bien été envoyé.</p>  
        <p><strong>Courriel pour la réponse :</strong><br /><?php echo( $from ); ?></p>  
        <p><strong>Objet :</strong><br /><?php echo( $object ); ?></p>  
        <p><strong>Message :</strong><br /><?php echo( nl2br( htmlspecialchars( $message ) ) ); ?></p>  
<?php  
    }  
    else // le formulaire est affiché pour la première fois ou le formulaire a été soumis mais contenait des erreurs  
    {  
        if( count( $errors ) !== 0 )  
        {  
            echo( "\t\t<ul>\n" );  
            foreach( $errors as $error )  
            {  
                echo( "\t\t\t<li>$error</li>\n" );  
            }  
            echo( "\t\t</ul>\n" );  
        }  
        else  
        {  
            echo( "\t\t<p id=\"welcome\"><em>Tous les champs sont obligatoires</em></p>\n" );  
        }  
?>  


	<div class="container-contact100"> 
		<!--longitude et latitude d'efrei : 48.788966, 2.363647 -->
		<div class="contact100-map" id="google_map" data-map-x="48.788966" data-map-y="2.363647" data-pin="images/icons/map-marker.png" data-scrollwhell="0" data-draggable="1"></div>

		<div class="wrap-contact100">
			<form  class="contact100-form validate-form" method="post" action="<?php echo( $_SERVER['REQUEST_URI'] ); ?>" enctype="multipart/form-data " >
				<span class="contact100-form-title">
					Contactez-nous
				</span>

		

				<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz" >
					<input class="input100" type="text" name="from" value="<?php echo( $from ); ?>" placeholder="Email">
					<span class="focus-input100-1"></span>
					<span class="focus-input100-2"></span>
				</div>

        <div class="wrap-input100 validate-input" data-validate="Object is required">
          <input class="input100" type="text" name="object" value="<?php echo( $object ); ?>" placeholder="Objet du message">
          <span class="focus-input100-1"></span>
          <span class="focus-input100-2"></span>
        </div>

				<div class="wrap-input100 validate-input" data-validate = "Message is required">
					<textarea class="input100" name="message" placeholder="Ton Message"> <?php echo( $message ); ?> </textarea>
					<span class="focus-input100-1"></span>
					<span class="focus-input100-2"></span>
				</div>

				

				<div class="container-contact100-form-btn">
					<button type="submit" name="send" value="Envoyer" class="contact100-form-btn">
						ENVOYER
					</button>
				</div>
			</form>
		</div>
	</div>

<?php  
    }  
?> 


	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
	<script src="js/map-custom.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>

<!-- pour contact, google page : -->
<script> 
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>


		
    <!-- Footer -->
    
    
  <footer class="w3-center w3-padding-32" style="background-color:#e0e0e0">
      
     <p><a href="#" class="w3-btn w3-grey w3-large" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.6);text-decoration: none";><i class="fa fa-arrow-up w3-margin-right w3-xlarge "></i>TO THE TOP</a></p>
      

    <div class="w3-row w3-margin-bottom" style="position: relative; top:60px";>
        <div class="w3-col" style="width:23.5%!important";><p></p></div>

        <div class="w3-col w3-margin-left" style="width:17%!important";>
          <i class="fa fa-desktop w3-margin-bottom w3-jumbo w3-center"></i>
         <p class="w3-large"><a style="font-weight:bold!important" href="../apropos.php">Qui sommes-nous ?</a></p>
        </div>

        <div class="w3-col w3-margin-left" style="width:17%!important;position:relative!important;left:-10px!important";>
           <i class="fa fa-diamond w3-margin-bottom w3-jumbo"></i>
           <p class="w3-large"><a style="font-weight:bold!important" href="contact.php">Contactez-nous ici !</a></p>
        </div>


        <div class="w3-col  " style="width:17%!important";>
           <i class="fa fa-cog w3-margin-bottom w3-jumbo"></i>
           <p class="w3-large">
              <i class="fa fa-facebook-official w3-hover-opacity"></i>
              <i class="fa fa-twitter w3-hover-opacity"></i>
            </p>
        </div>
      </div>

      <p style="text-align: center;position:relative;top:50px"><br/>Copyright Silk Carpet 2018</p>




    </footer>




    </body>



</html>
