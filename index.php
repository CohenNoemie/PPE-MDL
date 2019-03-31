<?php include("head.php") ; ?>

<div id="divBody">
  <br />  
  <?php 
  // controle de la presence de variables de sessions (authentificaiton ok)
  $connexion = null ;
  if (isset($_SESSION["login"])) {
    // la personne est deja authentifiee
    $connexion = new connecOracle($_SESSION["login"], $_SESSION["pwd"]) ;
  }else{
    // controle si la page est rechargee (test d'authentification)
    if (isset($_POST["txtLogin"])) {
      // controle d'authentification
      $connexion = new connecOracle($_POST["txtLogin"], $_POST["txtPwd"]) ;
    }
  }
  
  // s'il n'y a pas de connexion à la base, on affiche le formulaire
  if (!$connexion) {
    // formulaire d'authentification
    include("authentification.php") ;
  }else {
    // authentification correcte : saisie des avis
    include("avis.php") ;
  }
  ?>  
</div>