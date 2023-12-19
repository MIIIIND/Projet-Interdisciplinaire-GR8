<?php

class bd {
    public function getBd(){
        date_default_timezone_set('Europe/Brussels');
        $hote='localhost';
        $nomBD='isim_parc';
        $user='root';
        $mdp=''; 
        try {
            $bd=new PDO('mysql:host='.$hote.';dbname='.$nomBD, $user, $mdp
            ,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $bd->exec("SET NAMES 'utf8'");
        }
        catch (Exception $e) {echo "Erreur de connexion à la BD : $e";}
        return $bd;
    }

}
function getshops(){
    $bd = getBd();
    $shops = $bd->query('SELECT * from shop');
    $shops->setFetchMode(PDO::FETCH_OBJ);
    return $shops->fetchall();
}
function getshop($idMag){
    $bd = getBd();
    $shop = $bd->prepare('SELECT * from shop WHERE shop_id=?');
    $shop->execute(array($idMag));
    if ($shop->rowcount() ==1)
        return $shop->fetch();
    else
        throw new Execption("le magasin on le connais pas'$idMag'");
}

?>