<?php 
class DB {
    private $db;

    /*
    private function setDB() { // connexion à la base de données
        require 'config.php';
        self::$db=new PDO('mysql:host='.$hoteDB.';dbname='.$nomBD, $userDB, $mdpDB);
        self::$db->exec("SET NAMES 'utf8'");
    }

    private function getDB() { // retourne la base de données
        if ($this->db==null) {
            $this->setDB();
        }
        return $this->db;
    }
    */

    private function getDB(){
        if ($this->db==null) {
            date_default_timezone_set('Europe/Brussels');
            try {
                require 'config.php';
                $db=new PDO('mysql:host='.$hoteDB.';dbname='.$nomBD, $userDB, $mdpDB
                ,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                $db->exec("SET NAMES 'utf8'");
                $this->db=$db;
            }
            catch (Exception $e) {echo "Erreur de connexion à la BD : $e";}
        }
        return $this->db;
    }

    protected function executeRequest($sql, $params = null) {
        if ($params == null) {
            $results = $this->getDB()->query($sql); // exécution directe
            $results->setFetchMode(PDO::FETCH_OBJ);
            #$results->closeCursor();
        }
        else {
            $results = $this->getDB()->prepare($sql);  // requête préparée
            $results->execute($params);
            $results->setFetchMode(PDO::FETCH_OBJ);
            #$results->closeCursor();
        }
        return $results;
    }
}
?>