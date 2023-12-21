<?php 
require_once 'm-Model.php';

class Shop extends DB {
    public function getOrders($id_shop){ // retourne un magasin
        $sql = 'SELECT * FROM order AS o JOIN product AS p ON o.product_fK=p.product_id WHERE p.shop_id_fK=?;';
        $orders = $this->executeRequest($sql, array((int) $id_shop));
        return $orders->fetchall();
    }
}
?>