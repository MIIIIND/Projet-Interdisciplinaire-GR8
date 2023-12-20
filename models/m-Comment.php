<?php 
require_once 'm-Model.php';

class Shop extends DB {
    public function getShopComments($shop_id)  { // retourne les commentaires d'un magasin
        $sql = 'SELECT c.content, c.score, c.comment_id , c.author_user_id_Fk, u.first_name, u.second_name FROM comment AS c JOIN user AS u ON c.author_user_id_Fk = u.user_id WHERE c.target_shop_Fk=?;';
        $comments = $this->executeRequest($sql, array((int) $shop_id));
        return $comments->fetchall();
    }

    public function delComment($comment_id) {
        $sql = 'UPDATE comment SET content="Ce commentaire a été supprimé." WHERE comment_id=?';
        $this->executeRequest($sql, array((int) $comment_id));
    }
}
?>

