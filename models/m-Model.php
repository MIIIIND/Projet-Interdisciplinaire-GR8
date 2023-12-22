<?php 
class DB {
    private $db;

    public function getDB(){ // Cette fonction devrait être privée mais dû à notre structure semi-MVC, elle est publique x)
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

    protected function getPreparedRequest($sql) { // Fonction qui retourne une requête préparée (cas spécial)
        $results = $this->getDB()->prepare($sql);
        return $results;
    }
}
?>