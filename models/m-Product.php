<?php 
require_once 'm-Model.php';

class Product extends DB {
    public function getProducts($shop_id) {
        $sql = "SELECT * FROM product WHERE shop_id_Fk=?;";
        $products = $this->executeRequest($sql, array((int) $shop_id));
        return $products;
    }

    public function getProduct($id) {
        $sql = "SELECT Souvenir_name FROM product WHERE product_id=?;";
        $product = $this->executeRequest($sql, array((int) $id));
        return $product;
    }

    public function getProductTypes() {
        $sql = "SELECT * FROM product_type;";
        $productTypes = $this->executeRequest($sql);
        return $productTypes;
    }

    public function addProduct($name, $price, $type, $description, $shop) {
        $sql = "INSERT INTO product (Souvenir_name, price, type_Fk, description, shop_id_Fk) VALUES (?, ?, ?, ?, ?);";
        $this->executeRequest($sql, array((string) $name, (int) $price, (int) $type, (string) $description, (int) $shop));
    }

    public function updateProduct($name, $price, $type, $description, $product_name, $shop) {
        $sql = "UPDATE product SET Souvenir_name=?, price=?, type_Fk=?, description=? WHERE Souvenir_name=? AND shop_id_Fk=?;";
        $this->executeRequest($sql, array((string) $name, (int) $price, (int) $type, (string) $description, (string) $product_name, (int) $shop));
    }

    public function delProduct($name, $shop) {
        $sql = "DELETE FROM product WHERE Souvenir_name=? AND shop_id_Fk=?;";
        $this->executeRequest($sql, array((string) $name, (int) $shop));
    }

    public function addType($name) {
        $sql = "INSERT INTO product_type (type_name) VALUES (?);";
        $this->executeRequest($sql, array((string) $name));
    }

    public function delType($name) {
        $sql = "DELETE FROM product_type WHERE type_name=?;";
        $this->executeRequest($sql, array((string) $name));
    }

    public function prepareRequestForFilter($sql) { // A rather specific function, I know x)
        $prodcuts = $this->getPreparedRequest($sql);
        return $prodcuts;
    }
}
?>