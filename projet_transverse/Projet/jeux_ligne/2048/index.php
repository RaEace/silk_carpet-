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
<html>
<head>
	<title>2048</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style_2048.css" rel="stylesheet">

    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../../../bootstrap3/css/bootstrap.css">
     <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <!-- fontawesome !-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

     <style>
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
		    linear-gradient(rgba(222, 102, 0, 0.6), rgba(0, 89, 182, 0.6));
		  }
		 </style>

		 <!--pour scroll-->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
</head>


<body>
		<!--header-->
	       <div class="container-fluid" style= "height:260px;background-color:#e0e0e0";> 
	        <img src="../../imgs/silk1.png" alt="silk" style="width:12%;float:left"; class="w3-circle">
	        <h1 style="position: relative;left:-100px;font-size:50px";>SILKCARPET</h1>
	        <h3 style="position: relative;left:15px";>EFR'AIDE</h3>
	        <p style="position: relative;left:15px";>Site de jeux en ligne</p>
	        <p style="position: relative;left:15px";>et d'échanges de cours gratuits !</p>
	     
	      </div>


	    <!--menu avec deconnexion : -->
       <nav data-spy="affix" data-offset-top="197"> 
        <div class="table">
              <ul>
                          <li  class="menu-acc">
                              <a href="../../accueil.php">ACCUEIL</a>
                          </li>
                          <li   class="menu-apro">
                              <a href="../../apropos.php">A PROPOS</a>
                          </li>
                          <li class="menu-monprofil">
                              <a href="../../monprofil.php">MON PROFIL</a>
                          </li>
                          <li  id="active" class="menu-jeux">
                              <a href="../../Jeux.php">JEUX</a>
                          </li>
                          <li  class="menu-efraide">
                              <a href="../../efrei'aide.php">EFR'AIDE</a>
                          </li>
                          <li  class="menu-con">
                              <a href="../../deconnexion.php">SE DECONNECTER</a>
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


		<h1>2048</h1>
		<p id="score"></p>
		<p id="size"></p>


		<div id="canvas-block">
		    <canvas id="canvas" width="500" height="500"></canvas>
		</div>

		<script src="script.js"></script> <!-- affichage du javascript de notre jeu 2048-->




		<!-- Footer -->
    <footer class="w3-center w3-padding-32" style="background-color:#e0e0e0">
      
     <p><a href="#" class="w3-btn w3-grey w3-large" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.6);text-decoration: none";><i class="fa fa-arrow-up w3-margin-right w3-xlarge "></i>TO THE TOP</a></p>
    


    <div class="w3-row w3-margin-bottom" style="position: relative; top:60px">
        <div class="w3-col" style="width:23.5%"><p></p></div>

        <div class="w3-col w3-margin-left" style="width:17%">
          <i class="fa fa-desktop w3-margin-bottom w3-jumbo w3-center"></i>
         <p class="w3-large"><a style="font-weight:bold" href="../../apropos.php">Qui sommes-nous ?</a></p>
        </div>

        <div class="w3-col w3-margin-left" style="width:17%;position:relative;left:-10px">
           <i class="fa fa-diamond w3-margin-bottom w3-jumbo"></i>
           <p class="w3-large"><a style="font-weight:bold" href="../../Contact/contact.php">Contactez-nous ici !</a></p>
        </div>


        <div class="w3-col  " style="width:17%">
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