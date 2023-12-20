<?php 
require_once 'm-Model.php';

class Shop extends DB {
    public function getOrders($id_shop){ // retourne un magasin
        $sql = '';
        $orders = $this->executeRequest($sql, array());
        return $orders->fetchall();
    }
}
?>