<?php

session_start(); 

try { 
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


     <link rel="stylesheet" href="../../bootstrap3/css/bootstrap.css">
     <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <!-- fontawesome !-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


		<style>

		/*Pour la réalisation de ce jeu, nous nous sommes aider de tutoriels sur youtube, expliquant de facon simple la réalisation d'un memory game
pour les débutants en JavaScript et Html, nous nous en sommes inspirés et avons commenté le code pour qu'il soit compréhensible pour tous*/




/*CSS HERE*/
div#memory_board{/*dans cette div on établit les couleurs du grand tableau et ses dimensions*/
	background:#0000!important;
	background-color: white!important;
	box-shadow: 6px 6px 20px black;
	border:#8B0000 1px solid;
	width:600px;
	height:420px;
	padding:24px;
	margin:0px auto;
}
div#memory_board > div{   /*ici il s'agit d'une div appelant une div, ce qui correspond à chacune des cartes à retourner (petites cases à l'intérieur du tableau*/
	background: url(tile_bg.jpg) no-repeat;
	background-color: #fde3c3!important;
	border:#8B0000 1px solid;
	box-shadow: 6px 6px 6px black;
	width:71px;
	height:71px;
	float:left;
	margin:10px;
	padding:1px;
	font-size:50px;
	cursor:pointer;
	text-align:center;
}

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

		  .bonjour
			  {
			  	margin-top:15px;
			  	
			  	color:white;
			  	font-weight: bold;
			  	font-size: 20px;
			  }






</style>



<script type="text/javascript">

 // JAVASCRIPT ici: nous avons d'abord 4 variables 


var memory_tab = ['A','A','B','B','C','C','D','D','E','E','F','F','G','G','H','H','I','I','J','J','K','K','L','L'];
//ce tableau contient le contenue des cartes, les cartes sont alors crées dynamiquement
var memory_valeurs = []; //Il s'agit d'un tableau vide qui contiendra toutes les valeurs mémoires
var memory_cartes = []; // l'appelation des cartes du jeu
var tiles_flipped = 0; //compteur permettant de savoir combien de cartes sont retournées pour l'instant




var gagner = false;
//var mise = <?php $mise ?>; 
//var points = <?php ($points); ?>; 


 //cette méthode permet de modifier le tableau des objets, on utilise prototype pour acceder à tous les objets
 Array.prototype.memory_tile_shuffle = function(){
            var i = this.length, j, temp; //'this' represente le mot en cours d'analyse
            while(--i > 0){
                j = Math.floor(Math.random() * (i+1));
                temp = this[j];
                this[j] = this[i];
                this[i] = temp;
            }
        }



function newBoard(){


	tiles_flipped = 0; //le nombre de cartes retournées, revient à 0 quand recommence le jeu don qd on a un nouveau jeu
	var output = '';  //nouvelle variable
	//var mise = <?php /*echo $mise */?>; 

 memory_tab.memory_tile_shuffle(); //On applique la methode sur le tableau contenant la valeur des cartes pour qu'on puisse les modifier
            for(var i = 0; i < memory_tab.length; i++){
                output += '<div id="tile_'+i+'" onclick="memoryFlipTile(this,\''+memory_tab[i]+'\')"></div>'; //tile_0 puis tile_1 puis tile_2 etc... : le premier argument de la div est sur lequel nous cliquons et le deuxieme son contenu

            }
	document.getElementById('memory_board').innerHTML = output; //putting the elements on the board
}
function memoryFlipTile(carte,val){

            // cette fonction va permettre de retourner une carte
            if(carte.innerHTML == "" && memory_valeurs.length < 2){ //si la carte est vide et que la longueur de ka valeur mémoire est inférieur à 2
                carte.style.background = '#FAEBD7'; // couleur du background de la carte retournée
                carte.innerHTML = val; // la valeur de la carte est montré uniquement une fois qu'elle est retournée
                if(memory_valeurs.length == 0){ // si aucune des cartes actuelles n'est deja retournée
                    memory_valeurs.push(val); //on place alors la valeur de la carte dans le memory tableau (qui est vide au début du jeu)
                    memory_cartes.push(carte.id);
                } else if(memory_valeurs.length == 1){ //si la carte est deja retournée
                    memory_valeurs.push(val);
                    memory_cartes.push(carte.id);
                    if(memory_valeurs[0] == memory_valeurs[1]){ // si les deux cartes sont les memes
                        tiles_flipped += 2; // on ajoute alors les deux cartes au compteur des cartes retournées
                        // on va devoir nettoyer (réinitialiser) les deux tableau pour un nouveau match de cartes
                        memory_valeurs = [];
                        memory_cartes = [];
                        // on doit voir si tout le tableau de jeu est 'clear'
                        if(tiles_flipped == memory_tab.length){ // on regarde si le nombre de cartes retournées correspond au nombre de cartes en tout dans le jeu
					

						gagner = true;

						alert("Partie terminée... cliquez sur Ok pour rejouer !" );
						document.getElementById('memory_board').innerHTML = "";
						document.location.href = "memorygame.php"; //redirection vers la page memorygame
						
				}
			} else {
				function flip2Back(){ // si les cartes ne sont pas les meme il n'y a pas de match
                            // on va donc devoir retourner les cartes pour qu'elle soit à nouveau face cachée
                            var tile_1 = document.getElementById(memory_cartes[0]);
                            var tile_2 = document.getElementById(memory_cartes[1]);
                            tile_1.style.background = 'url(tile_bg.jpg) no-repeat';
                            tile_1.innerHTML = "";
                            tile_2.style.background = 'url(tile_bg.jpg) no-repeat';
                            tile_2.innerHTML = "";
                            //on réinitialise les deux tableau
                            memory_valeurs = [];
                            memory_cartes = [];
                        }
                        setTimeout(flip2Back, 500); // les deux cartes qui ne match pas sont retournées pendant environ 1/2 seconde
			}
		}
	}
}
</script>
<!--pour scroll-->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
                          <li  id="active" class="menu-jeux">
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






<br/><br/>

<form method="post" action="memorygame.php">
 <input type="text" name="mise" placeholder="Mise, ex : 100" required />
</form>

<h1>Memory game</h1><br/>

	<div id="memory_board"></div>



<?php

if (isset($_POST['mise'])) //si la mise a bien été rentrée
{
 
         $mise = $_POST['mise'];
         $id=($_SESSION['id']);


   
      $points = $_SESSION['points'];  //les points de l'utilisateur connecté

      if( $mise <= $points ) // si la mise est inférieur à nos points actuels alors on peut miser !
      {
       $error=0; //on peut miser
       echo' La mise est de ' .$mise.' points';
      }

      else // on veut trop miser par rapport à nos points
      {
       $form = true ; //on doit resélectionné la valeur de la mise
        $error=1;
        echo 'Vous n\'avez pas assez de points pour miser autant';

			
      }  





		 if($error==0) // on peut miser et donc jouer 
		{

		    
		     
			$form = false ;

		  //on affiche tout le javascript pour jouer au jeu

		echo'<script>newBoard();</script>';  
		//echo' gagner est ' .$gagner. '' ;
		//echo '<script>gagner;</script>';








		}

		// donc quand on est ici si on a gagné alors : 
		//$gagner = <script>  </script>
		/*if ($gagner==1)
		{          $points=$points + $mise;
		           $modif= $bdd->prepare('UPDATE membres1 SET points= :points WHERE id= :id');
		          
						$modif->bindParam(':id', $id, PDO::PARAM_INT);
						$modif->bindParam(':points', $points, PDO::PARAM_INT);
						$modif->execute();
		}

		else // on a perdu
		{
		      
					$points=$points - $mise;
		           $modif= $bdd->prepare('UPDATE membres1 SET points= :points WHERE id= :id');
		          
		$modif->bindParam(':id', $id, PDO::PARAM_INT );
		$modif->bindParam(':points', $points, PDO::PARAM_INT);
		$modif->execute();

		}*/  // cette partie n'a pas été aboutie : nous ne pouvions pas accéder à la valeur "gagner" dans le javascript du jeu memorygame lorsque tiles_flipped == memory_tab.length == 24 dans notre cas



}

else
{
 echo'Ce champs doit être rempli pour jouer';
}



?>


<!-- Footer -->
<br/><br/>
    <!-- Footer -->
    <footer class="w3-center w3-padding-32" style="background-color:#e0e0e0">
      
     <p><a href="#" class="w3-btn w3-grey w3-large" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.6);text-decoration: none";><i class="fa fa-arrow-up w3-margin-right w3-xlarge "></i>TO THE TOP</a></p>
    


    <div class="w3-row w3-margin-bottom" style="position: relative; top:60px">
        <div class="w3-col" style="width:23.5%"><p></p></div>

        <div class="w3-col w3-margin-left" style="width:17%">
          <i class="fa fa-desktop w3-margin-bottom w3-jumbo w3-center"></i>
         <p class="w3-large"><a style="font-weight:bold" href="../apropos.php">Qui sommes-nous ?</a></p>
        </div>

        <div class="w3-col w3-margin-left" style="width:17%;position:relative;left:-10px">
           <i class="fa fa-diamond w3-margin-bottom w3-jumbo"></i>
           <p class="w3-large"><a style="font-weight:bold" href="../Contact/contact.php">Contactez-nous ici !</a></p>
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