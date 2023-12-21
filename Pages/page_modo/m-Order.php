<?php 
require_once 'm-Model.php';

class Order extends DB {
    public function getOrders($id_shop){ // retourne un magasin
        $sql = "SELECT o.order_id, o.quantity, o.date, o.state_Fk, os.state_name, u.user_id, u.first_name, u.second_name, u.bill, c.name AS cottage_name, p.Souvenir_name, p.price
        FROM `order` AS o 
        JOIN `order_state` AS os ON os.order_state_id = o.state_Fk 
        JOIN `user` AS u ON o.client_user_id_Fk = u.user_id 
        JOIN `cottage` AS c ON u.stays_at_Fk = c.cottage_id 
        JOIN `product` AS p ON o.product_Fk = p.product_id 
        WHERE shop_id_Fk=?;";
        
        $orders = $this->executeRequest($sql, array((int) $id_shop));
        return $orders;
    }

    public function getOrderStates() {
        $sql = "SELECT * FROM order_state;";
        $orderStates = $this->executeRequest($sql);
        return $orderStates;
    }
}
?>