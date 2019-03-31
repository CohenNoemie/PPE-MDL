<?php
echo 'Saisie des avis lors des participations aux ateliers :' ;
echo '<br /><br />' ;

// si rechargement de la page, recuperation de l'atelier
if (isset($_POST["sltAtelier"])) {
    // recuperation de l'atelier selectionne
    $idAtelier = $_POST["sltAtelier"] ;
}else{
    // recuperation du premier atelier de la table
    $req = "select * from vatelier03" ;
    $crsAtelier = $connexion->query($req) ;
    if ($ligne = $crsAtelier->fetch()) {
        $idAtelier = $ligne["ID"] ;
    }else {
        // il n'y a pas d'atelier donc pas de traitement possible
        $idAtelier = 0 ;
        echo "Aucun atelier n'est enregistre : pas de traitement possible" ;
        $connexion->closeConnec() ;
    }
}

// les traitements ne sont possibles que s'il y a au moins un atelier
if ($idAtelier != 0) { 
    // formulaire pour le choix de l'atelier
    echo '<form id="frmAtelier" method="post" action="index.php">' ;
    // recuperation et affichage des ateliers dans un combo
    $req = "select * from vatelier03" ;
    echo HtmlObject::comboFromField($connexion, $req, "LIBELLEATELIER", "ID", "sltAtelier", $idAtelier) ;
    echo '<br /><br />' ;
    echo '</form>' ;
    
    // zones de saisie des avis
    echo '<table class="tab">' ;
    // recherche des critères
    $req = "select * from vcritere01" ;
    $crsCritere = $connexion->query($req) ;
    // boucle sur les critères pour afficher les boutons
    $k = 1 ;
    foreach($crsCritere as $ligne) {
        echo '<tr>' ;
        echo '<td class="caseTab">' ;
        echo '<input type="button" id="'.$idAtelier.'-'.$k.'" value="'.$ligne["LIBELLE"].'" name="cmdAjout" class="caseTab" />' ;
        echo '<br /><br />' ;
        echo '</td>' ;
        echo '</tr>' ;
        $k++ ;
    }     
    echo '</table>' ;
  
}
?>