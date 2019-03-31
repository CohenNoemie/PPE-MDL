<?php
/**
 * Classe de creatopn d'objets html
 */
class HtmlObject {
    
    /**
     * Retourne un combo contenant des infos provenant d'une base de données
     * @param type $connexion
     * @param type $req
     * @param type $field
     * @param type $id
     * @param type $name
     * @param type $selected
     * @return string
     */
    public static function comboFromField($connexion, $req, $field, $id, $name, $selected) {
        $chaine = "" ;
        $crs = $connexion->query($req) ;
        $chaine .= '<select name="'.$name.'" id="'.$name.'" size="1">' ;
        foreach($crs as $ligne) {
          $chaine .= '<option value="'.$ligne[$id].'"' ;
          if ($ligne[$id]==$selected) {
            $chaine .= ' selected' ;
          }
          $chaine .= '>' ;
          $chaine .= $ligne[$field] ;
          $chaine .= '</option>' ;  
        }
        $chaine .= '</select>' ;   
        return $chaine ;
    }
    
    /**
     * Retourne une ligne correspondant aux titres d'un tableau
     * @param type $connexion
     * @param type $req
     * @param type $field
     * @param type $title
     * @param type $tdclass
     * @return string
     */
    public static function trTitleFromField($connexion, $req, $field, $title, $tdclass) {
        $chaine = "" ;
        $crs = $connexion->query($req) ;
        $chaine .= '<tr>' ;
        if ($title) {
            $chaine .= '<td class="'.$tdclass.'">&nbsp;</td>' ;
        }
        foreach($crs as $ligne) {
            $chaine .= '<td class="'.$tdclass.'">' ;
            $chaine .= $ligne[$field] ;
            $chaine .= '</td>' ;
        }
        $chaine .= '</tr>' ;
        return $chaine ;
    }
    
    /**
     * Retourne une ligne de tableau contenant des valeurs provenant de la base de données
     * @param type $nbCol
     * @param type $connexion
     * @param type $req
     * @param type $field
     * @param type $title
     * @param type $tdclass
     * @return string
     */
    public static function trValFromField($nbCol, $connexion, $req, $field, $title, $tdclass) {
        $chaine = "" ;        
        $chaine .= '<tr>' ;
        if (isset($title)) {
            $chaine .= '<td class="'.$tdclass.'">'.$title.'</td>' ;
        }
        for ($k=1 ; $k<=$nbCol ; $k++) {
            $chaine .= '<td class="'.$tdclass.'">' ;
            // construction de la requete parametree
            $reqLine = str_replace("%1", $k, $req) ;
            $crs = $connexion->query($reqLine) ;
            if ($ligne = $crs->fetch()) {
                // il y a un critere a afficher
                $chaine .= $ligne[$field] ;
            }else{
                $chaine .= '&nbsp;' ;
            } 
            $chaine .= '</td>' ;
        }
        $chaine .= '</tr>' ;
        return $chaine ;
    }
    
    /**
     * Retourne une ligne de tableau avec des zones de saisie
     * @param type $nbCol
     * @param type $title
     * @param type $tdclass
     * @param type $id
     * @param type $name
     * @return string
     */
    public static function trInputText($nbCol, $title, $tdclass, $id, $name) {
        $chaine = "" ;        
        $chaine .= '<tr>' ;
        if (isset($title)) {
            $chaine .= '<td class="'.$tdclass.'">'.$title.'</td>' ;
        }
        for ($k=1 ; $k<=$nbCol ; $k++) {
            $chaine .= '<td class="'.$tdclass.'">' ;
            $chaine .= '<input type="text" id="'.$id.'-'.$k.'" name="'.$name.'" class="'.$tdclass.'" />' ;
            $chaine .= '</td>' ;
        }
        $chaine .= '</tr>' ;        
        return $chaine ;
    }
    
    /**
     * Retourne une ligne de tableau avec un bouton en derniere case
     * @param type $nbCol
     * @param type $tdclassNormal
     * @param type $tdclassButton
     * @param type $id
     * @param type $value
     * @return string
     */
    public static function trButtonRight($nbCol, $tdclassNormal, $tdclassButton, $id, $value) {
        $chaine = "" ;        
        $chaine .= '<tr>' ;
        // case vides
        for ($k=0 ; $k<$nbCol ; $k++) {
            $chaine .= '<td class="'.$tdclassNormal.'">&nbsp;</td>' ;  
        }
        // bouton dans la case le plus a droite
        $chaine .= '<td class="'.$tdclassButton.'"><input id="'.$id.'" type="button" value="'.$value.'" /></td>' ;   
        $chaine .= '</tr>' ;
        return $chaine ;        
    }
}

?>