<?php 
// On démarre la session AVANT d'écrire du code HTML 
session_start(); 

?> 

<?php
try
{ // On se connecte à MySQL
  $bdd = new PDO('mysql:host=localhost;dbname=test_projet;charset=utf8', 'root', '');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}
catch(Exception $e)
{
  // En cas d'erreur, on affiche un message et on arrête tout 
        die('Erreur : '.$e->getMessage());
}



?>
 


<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Inscription</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">


    <link rel="stylesheet"  href="../jquery-ui/css/smoothness/jquery-ui-1.10.3.custom.css" />
  
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
     {
        border-top: 5px solid #f1dc4f;
  background-color: RGBa(255, 255, 128, 0.25);
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

      <?php include("inclusion/menu.php");?>

    



  <!--test pour s'inscrire-->

<?php

 if (isset($_POST['email']) && isset($_POST['pseudo']) && isset($_POST['pass']) && isset($_POST['lname']) &&isset($_POST['cpass'])&& isset($_POST['fname']) && isset($_POST['tel']) && isset($_POST['adresse']) && isset($_POST['postal']) && isset($_POST['classe'])  ) /*si on a bien rentré tous ces champs (nom , adresse etc)*/
  {

      $email = htmlspecialchars($_POST['email']);
      $pseudo = $_POST['pseudo'];
      $classe= $_POST['classe'];

      if (isset($_POST['matiere'])) //si on a rentré dans le formulaire qu'on veut donner une matière      
      {
      	$mat= implode(",",$_POST['matiere']);
      }
      else
      {
      	$mat=NULL;
      }
      
      $nbpoints = 100 ; //quand on s'inscrit on a 100 points automatiquement




      if ( $_POST['pass'] == $_POST['cpass'] ) /*si le mot de passe et le mot de pase de confirmation sont les mêmes*/
      {
        if(strlen($_POST['pass'])>=6)
        {
            //toutes ces expressions régulières (preg_match) vont nous permettre de sécuriser l'inscription pour qu'il y ait le moins d'erreurs de saisie possibles et donc avoir moins de chance d'avoir des champs suspects dans notre base de donnéees
          
          //On verifie si l'email est valide au format @efrei.net(ou . fr) ou bien @esigetel.net ( ou .fr)
            if(preg_match('([a-zA-Z0-9\.\-_]+@((efrei\.net)|(efrei\.fr)|(esigetel\.fr)|(esigetel\.net))) ', $_POST['email'] ))
            { 
                  if(preg_match("#^[0-9]{5}$#", $_POST['postal'])) //on verifie si notre code postal à 5 chiffres en 1 et 5
                  {

                      if(preg_match("#^0[1-9]([-. ]?[0-9]{2}){4}$#", $_POST['tel'] )) /* notre numero peut donc s'ecrire de cette manière et être enregistré dans la base de données : 0654543434 OU 06-54-54-34-34 ou 06.54.54.34.34 ou  enfin : 06 54 54 34 34 */
                      {
                  
                        //  Récupération de l'utilisateur pour verifier si le pseudo entré dans le formulaire n'existe pas déjà avec celui qui vient d'être entré dans le formulaire
                          $re = $bdd->prepare('SELECT id FROM membres1 WHERE pseudo = :pseudo');
                          $re->execute(array(
                              'pseudo' => $pseudo));

                          $resultat = $re->fetch();

                         if ($resultat )
                         {
                            $form = true ;
                            $error=1;
                            echo 'Ce pseudo existe déjà';
                         } 
                         else
                         {
                            $error= 0; //pseudo n'existe pas 
                         }

                      }
                      else
                      {
                        $form = true ;
                        $error=1;
                        echo 'Le téléphone n\'est pas au bon format :ex: 0624561436';
                      }
                  }
                  else
                  {
                        $form = true ;
                        $error=1;
                        echo 'Le code postal n\'est pas au bon format';
                  }




            }
            else 
            {
              $form = true ;
              $error=1;
              echo 'L\'email n\'est pas valide ( exemple@efrei.fr)';
            }
        }
        else
        {
          $form = true ;
          $error=1;
          echo 'Le mot de passe contient moins de 6 caractères';
        }
      }

      else
      {
        $form = true ;
        $error=1;

        echo'Les deux mots de passe ne sont pas identiques';
      }

      
  

    if($error!=1) //s'il n'y a aucune erreur alors on peut enregistrer toutes les infos dans la base de données

     {
      try
      {
      	

         // Hachage du mot de passe
        $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
      

          //  Requete sql pour insérer tous ces champs dans notre base de données
         $req = $bdd->prepare('INSERT INTO `membres1`(`pseudo`, `email`, `pass`, `lname`, `fname`, `tel`, `adresse`, `postal`, `classe`, `matiere`, `points`) VALUES (:pseudo, :email, :pass, :lname, :fname, :tel, :adresse, :postal, :classe, :matiere, :points);');

      	 $req->execute(array(
        'pseudo' => htmlspecialchars($_POST['pseudo']), 'email' => htmlspecialchars($email), 'pass'=>$pass_hache , 'lname' => htmlspecialchars($_POST['lname']), 'fname'=> htmlspecialchars($_POST['fname']), 'tel'=> $_POST['tel'], 
        'adresse'=>htmlspecialchars($_POST['adresse']), 'postal' => $_POST['postal'], 'classe'=>$classe, 
         'matiere'=>$mat, 'points'=> $nbpoints));




      }
       catch(Exception $e)
      {
              die('Erreur : '.$e->getMessage());
      }


      echo 'Inscription réussie !' ?>
      <a href="connexion.php" class="fs-subtitle" style="font-weight: bold"> Connecte-toi ici !</a>



      <?php


    } 
}
else 
{
  $form = true ;
  $error=1;
  echo 'Tous les champs doivent être remplis';
}




?>



  <!-- formulaire d'inscription -->
<form method="post" action="inscrire.php" id="msform" >
  <!-- progressbar -->
  <ul id="progressbar">
    <li class="active">Paramètres de<br/> connection</li>
    <li>Informations personnelles</li>
    <li>Efr'aide</li>
  </ul>
  <!-- fieldsets -->
  <fieldset>
    <h2 class="fs-title">Créer ton compte</h2>
    <h3 class="fs-subtitle">étape 1</h3>
    <input type="text" name="pseudo" placeholder="Pseudo" />
    <input type="text" name="email" placeholder="Email Efrei" />
    <input type="password" name="pass" placeholder="Mot de passe" />
    <input type="password" name="cpass" placeholder="Confirmer le mot de passe" />

    <h3 class="fs-subtitle"><br/>Tu as déjà un compte ?<br/><br/><a href="connexion.php" class="fs-subtitle" style="font-weight: bold"> Connecte-toi ici !</a><br/></h3>
    
    <input type="button" id="next" name="next" class="next action-button" value="Suivant" />
   
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Informations personnelles</h2>
    <h3 class="fs-subtitle">Qui es tu ?</h3>
    <input type="text" name="lname" placeholder="Nom" />
    <input type="text" name="fname" placeholder="Prénom" />
   
    <input type="text" name="tel" placeholder="Téléphone, ex : 0645362564" />
    <textarea name="adresse" placeholder="Adresse"></textarea>
    <input type="text" name="postal" placeholder="Code Postal" />
    <br/>

    

    <h4 class="fs-subtitlee">Quel est votre niveau d'étude ?<br/></h4>

               <select name="classe" required>
                   <optgroup label="L1">
                    <option value="L1 classique" selected="selected">L1 classique</option> <!--donc L1classique choisie par defaut-->
                     <option value="L1 int">L1 int</option>
                     <option value="PL1">PL1</option>
                     <option value="L1 bio">L1 bio</option>
                    </optgroup>

                    <optgroup label="L2">
                     <option value="L2 classique">L2 classique</option>
                     <option value="L2 int">L2 int</option>
                     <option value="PL2">PL2</option>
                    </optgroup>

                    <optgroup label="L3">
                     <option value="L3">L3</option>
                     <option value="L3 new">L3 new</option>
                    </optgroup>

                   <option  value="M1">M1</option>
                   <option  value="M2">M2</option>
               </select>
               </br>


        

    
    <input type="button" name="previous" class="previous action-button" value="Précédent" />
    <input type="button" name="next" class="next action-button" value="Suivant" />
  </fieldset>


  <fieldset>
    <h2 class="fs-title">Efr'aide</h2>
    <h3 class="fs-subtitle">Echanges de cours</h3>

   
    <h4 class="fs-subtitlee">Dans quelle(s) matière(s) souhaitez-vous donner des cours ?<br/></h4>
           <input type="checkbox" name="matiere[]" value="Mathematiques" id="d_math"  > <label id="check_m" for="d_math" >Mathématiques</label>
           <input type="checkbox" name="matiere[]" value="Physique" id="d_physique"><label id="check_p" for="d_physique" >Physique</label>
           <input type="checkbox" name="matiere[]" value="Informatique" id="d_info" ><label id="check_i" for="d_info" >Informatique</label><br />
           <input type="checkbox" name="matiere[]" value="Formation Generale" id="d_gene"><label id="check_g" for="d_gene" >Formation générale</label><br/>
          
           <p id=aucune> ( Aucune case cochée : je suis trop mauvais(e) )</p>

    
    
    <input type="button" name="previous" class="previous action-button" value="Précdent" />
    <input type="submit" name="submit" value="S'inscrire" /> <!--on s'inscrit en appuyant sur cette touche si tous nos champs sont entrés et au bon format-->
 
  </fieldset>


</form>


<!-- Footer -->
    <?php include("inclusion/footer.php");?>

    
    


    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>

  
    <script  src="js_formulaire/index.js"></script>

   




</body>


</html>