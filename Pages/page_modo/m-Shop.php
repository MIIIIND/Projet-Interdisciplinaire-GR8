<?php 
require_once 'm-Model.php';

class Shop extends DB {
    public function getAllShops()  { // retourne tous les magasins
        $sql = 'SELECT * from shop';
        $shops = $this->executeRequest($sql);
        return $shops->fetchall();
    }

    public function getShop($idMag){ // retourne un magasin
        $sql = 'SELECT * from shop WHERE shop_id=?';
        $shop = $this->executeRequest($sql, array((int) $idMag));
        if ($shop->rowcount() == 1)
            return $shop->fetch();
        else
            #throw new Execption("le magasin on le connais pas'$idMag'");
            echo "le magasin on le connais pas'$idMag'";
    }

    public function getShopFromOwner($user_id) {
        $sql = 'SELECT * from shop WHERE manager_user_id_Fk=?';
        $shop = $this->executeRequest($sql, array((int) $user_id));
        return $shop;
    }

    public function setSchedules($open_h, $close_h, $user_id) {
        $sql = 'UPDATE shop SET opens_at=?, closes_at=? WHERE manager_user_id_Fk=?';
        $this->executeRequest($sql, array($open_h, $close_h, (int) $user_id));
    }
}
?>