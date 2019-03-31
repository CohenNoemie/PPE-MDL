<?php
  session_start() ;
  // connexion à la base de données
  require_once('connecOracle.php') ;
  $connexion = new connecOracle($_SESSION["login"], $_SESSION["pwd"]) ;
  // la suite des traitements n'est possible que si la connexion est ok
  if ($connexion) {
    // recuperation de l'information transférée en get
    $id = $_GET["id"] ;
    // decomposition des informations recues
    $tabId = explode("-", $id) ;
    $idAtelier = $tabId[0] ;
    $idCritere = $tabId[1] ;
    $nb=1;
    // mise à jour de la base de données pour prendre en compte le choix
    $req = "call pckstats.majresultat(:idatelier, :idcritere, :nbchoix)" ;
    // appel de la procédure stockée concernée avec les bons paramètres
    $param = array($idAtelier, $idCritere, $nb) ;
    $connexion->execProc("pckstats.majresultat", $param) ;
  } 
?>