<?php 
require_once 'm-Model.php';

class Shop extends DB {
    public function getAllShops()  { // retourne tous les magasins
        $sql = 'SELECT * from shop';
        $shops = $this->executeRequest($sql);
        return $shops;
    }

    public function getShop($idMag){ // retourne un magasin
        $sql = 'SELECT * from shop WHERE shop_id=?';
        $shop = $this->executeRequest($sql, array((int) $idMag));
        if ($shop->rowcount() == 1)
            return $shop;
        else
            #throw new Execption("le magasin on le connais pas'$idMag'");
            echo "le magasin on le connais pas'$idMag'";
    }

    public function getShopFromOwner($user_id) {
        $sql = 'SELECT * from shop WHERE manager_user_id_Fk=?';
        $shop = $this->executeRequest($sql, array((int) $user_id));
        return $shop;
    }

    public function getStats($name) {
        $sql = "SELECT p.souvenir_name, p.price, SUM(o.quantity) AS total_quantity, (p.price * SUM(o.quantity)) AS ca, s.shop_name
                FROM product AS p
                JOIN shop AS s ON p.shop_id_Fk = s.shop_id
                LEFT JOIN `order` AS o ON p.product_id = o.product_Fk
                WHERE s.shop_name = ?
                GROUP BY p.product_id;";
        
        $stats = $this->executeRequest($sql, array((string) $name));
        return $stats;
    }

    public function getFilteredStats($minPrice, $maxPrice, $minQuantity, $maxQuantity) {
        $sql = "SELECT p.souvenir_name, p.price, SUM(o.quantity) AS total_quantity, (p.price * SUM(o.quantity)) AS ca
                FROM `product` AS p
                JOIN `shop` AS s ON p.shop_id_Fk = s.shop_id
                LEFT JOIN `order` AS o ON p.product_id = o.product_Fk
                GROUP BY p.product_id
                HAVING p.price BETWEEN (10 AND 45) AND SUM(o.quantity) BETWEEN (1 AND 5);";
        
        $stats = $this->executeRequest($sql, array((float) $minPrice, (float) $maxPrice, (int) $minQuantity, (int) $maxQuantity));
        return $stats;
    }

    public function setSchedules($open_h, $close_h, $user_id) {
        $sql = 'UPDATE shop SET opens_at=?, closes_at=? WHERE manager_user_id_Fk=?';
        $this->executeRequest($sql, array($open_h, $close_h, (int) $user_id));
    }
}
?>