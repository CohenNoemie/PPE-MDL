<?php 
session_start() ;
// desactiver le rapport des erreurs
///error_reporting(0);  
// insère la classe de connexion
function __autoload($className) {
    require_once($className.'.php') ;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <script type="text/javascript" src="script.js"></script>  
  <link rel="stylesheet" type="text/css" href="principal.css" />
  <title></title>
</head>

<body>

<!-- banniere -->
<div id="divHead">
</div>


