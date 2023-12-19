<?php

class bd {
    protected function getBd(){
        date_default_timezone_set('Europe/Brussels');
        try {
            require_once 'config.php';
            $bd=new PDO('mysql:host='.$hoteDB.';dbname='.$nomBD, $userDB, $mdpDB
            ,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $bd->exec("SET NAMES 'utf8'");
        }
        catch (Exception $e) {echo "Erreur de connexion à la BD : $e";}
        return $bd;
    }

    public function getAllShops(){
        $bd = $this->getBd();
        $shops = $bd->query('SELECT * from shop');
        $shops->setFetchMode(PDO::FETCH_OBJ);
        return $shops->fetchall();
    }

    public function getShop($idMag){
        $bd = $this->getBd();
        $shop = $bd->prepare('SELECT * from shop WHERE shop_id=?');
        $shop->execute(array((int) $idMag));
        if ($shop->rowcount() == 1)
            return $shop->fetch();
        else
            #throw new Execption("le magasin on le connais pas'$idMag'");
            echo "le magasin on le connais pas'$idMag'";
    }

    public function getUser($login, $password){
        try {
            $bd = $this->getBd();
            $user = $bd->prepare('SELECT * from user WHERE login=? AND password=?');
            $user->execute(array((int) $login, (int) $password));
            $user->setFetchMode(PDO::FETCH_OBJ);
            if ($user->rowcount() == 1)
                return $user->fetch();
            else
                echo "Erreur dans le login ou le mot de passe";
        }
        catch (Exception $e) {echo "Erreur de connexion : $e";}
    }
}

?>