/**
 * Chargement de la page
 */
window.onload = function() {

  // sur le choix d'un atelier, le formulaire est envoyé
  document.getElementById("sltAtelier").onchange = function() {
    document.getElementById("frmAtelier").submit() ;
  }
  
  // sur le clic d'un des boutons pour ajouter
  var chaine = "" ;
  var valeurs = document.getElementsByTagName("input") ;
  for (k=0 ; k<valeurs.length ; k++) {
    if (valeurs[k].name=="cmdAjout") {
      valeurs[k].onclick = function() {
       // envoi de la chaine au serveur pour l'ajout
        AjaxReception("ajout.php?id="+this.id, "text", finAjout) ;     
      }
    }  
  }  
  
}

/**
 * finAjout : appelé lors du retour du serveur, pour recharger la page
 * en mettant à jour les informations de l'atelier
 */
function finAjout() {
  alert("MERCI !") ;
  // rechargement de la page en restant sur le même atelier
  document.getElementById("frmAtelier").submit() ;
}


/**
 * Ajax : permet de créer l'objet de communication avec le serveur
 */
function Ajax () {
  
  //--- propriétés ---
  xhr = null ;        // variable de connexion ajax
 
  //--- constructeur (création de l'objet de connexion ---
  if (window.XMLHttpRequest) {
    xhr = new XMLHttpRequest() ; 	
  } else {
    if (window.ActiveXObject) {
      xhr = new ActiveXObject ("Microsoft.XMLHTTP") ; 		 
    } else {
      alert ("Votre navigateur n'est pas compatible avec Ajax") ;
	  }	
  }

  return xhr ;
}

/**
 * AjaxReception : permet de récupérer du texte ou du xml d'un serveur
 * Il est aussi possible d'envoyer des informations par l'url, en get
 */
function AjaxReception (nomfic, typefic, uneFonction) {
  
  //--- propriétés ---
  xhr = Ajax() ;        // variable de connexion ajax
 
  //--- si l'objet est construit, creation de la méthode de récupération ---
  if (xhr) {
    //--- réception du serveur ---	   
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) { 
	      if (typefic=="XML") {
          uneFonction(xhr.responseXML) ;
			  } else {   
          uneFonction(xhr.responseText) ;
			  }
		  }
	  }
    xhr.open("GET", nomfic, true) ;  
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=utf-8");
    xhr.send(null) ;
  }
   
}

/**
* AjaxEnvoi : permet d'envoyer en post des informations au serveur
*/
function AjaxEnvoi (nomfic, message) {
  
  //--- propriétés ---
  xhr = Ajax() ;        // variable de connexion ajax
 
  //--- si l'objet est construit, envoi possible ---
  if (xhr) {
	   
    //--- envoi vers le serveur ---
    xhr.open("POST", nomfic, true) ;
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=utf-8");
    xhr.send(message) ;

  }
   
}

