<?php 
require_once 'm-Model.php';

class ShopType extends DB {
    public function getAllShopTypes() { // retourne tous les types de magasins
        $sql = 'SELECT * from shop_type';
        $types = $this->executeRequest($sql);
        return $types;
    }

    public function addShopType($type_name) {
        $sql = 'INSERT INTO shop_type (type_name) VALUES (?)';
        return $this->executeRequest($sql, array($type_name));
    }

    public function delShopType($type_name) {
        $sql = 'DELETE FROM shop_type WHERE type_name = ?';
        return $this->executeRequest($sql, array($type_name));
    }
}
?>