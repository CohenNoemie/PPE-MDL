<?php
/**
 * classe pour gérer la connexion à la base oracle
 */
class connecOracle extends PDO {
    
    // proprietes statiques
    private static $host = "192.168.0.16" ;
    private static $port = "1521" ;
    private static $name = "XE" ;
    
    /**
     * Constructeur permettant de creer la connexion et de gerer les variables de session
     * @param type $login
     * @param type $pwd
     */
    function __construct($login, $pwd) {
        $stringConnect = " 
        (DESCRIPTION =
            (ADDRESS_LIST =
              (ADDRESS = (PROTOCOL = TCP)(HOST = ".self::$host.")(PORT = ".self::$port."))
            )
            (CONNECT_DATA =
              (SERVICE_NAME = ".self::$name.")
            )
          )";
        try{
            // connexion
            parent::__construct('oci:dbname='.$stringConnect, $login, $pwd, array(PDO::ERRMODE_EXCEPTION => true)) ;        
            // enregistrement des informations dans les variables de session
            $_SESSION["login"] = $login ;
            $_SESSION["pwd"] = $pwd ;
        } catch (PDOException $ex) {
           // erreur de connexion, on supprime les variables de session si elles existent
            if (isset($_SESSION["login"])){
               unset($_SESSION["login"]) ;
               unset($_SESSION["pwd"]) ;
            }
        }
    }
    
    /**
     * Execute une procedure stockee avec des parametres
     * @param type $nomProc
     * @param type $param
     */
    function execProc($nomProc, $param) {
        // calcul du nombre de parametres
        $nbParam = count($param) ;
        // construit la requete pour executer la procedure stockee
        $req = "call ".$nomProc."(" ;
        for($k=0 ; $k<$nbParam-1 ; $k++) {
            $req .= ":param".$k.", " ;
        }
        $req .= ":param".$k.")" ;
        // preparation de l'appel de la procedure stockee
        $procedure = $this->prepare($req) ;
        // affectation des parametres
        for($k=0 ; $k<$nbParam ; $k++) {
            $procedure->bindParam(':param'.$k, $param[$k]) ;            
        }
        // execution de la procedure
        $procedure->execute() ;
       
    }
    
    /**
     * Retourne le nombre de lignes d'une requete select
     * @param type $req
     * @return type
     */
    function nbLine($req) {
        $crs = $this->query($req) ;
        return count($crs->fetchAll()) ;
    }
    
    /**
     * A la demande de la fermeture de la connexion, supprime les variables de session
     */
    function closeConnec() {
        unset($_SESSION["login"]) ;
        unset($_SESSION["pwd"]) ;
    }
}
?>