<?php 
require_once 'm-Model.php';

class Comment extends DB {
    public function getShopComments($shop_id)  { // retourne les commentaires d'un magasin
        $sql = 'SELECT c.content, c.score, c.comment_id , c.author_user_id_Fk, u.first_name, u.second_name
                FROM comment AS c
                JOIN user AS u ON c.author_user_id_Fk = u.user_id
                WHERE c.target_shop_Fk=?;';
        
        $comments = $this->executeRequest($sql, array((int) $shop_id));
        return $comments;
    }

    public function delComment($comment_id) {
        $sql = 'UPDATE comment SET content="Ce commentaire a été supprimé." WHERE comment_id=?';
        $this->executeRequest($sql, array((int) $comment_id));
    }

    public function addComment($author_id, $target_shop, $content, $score) {
        $sql = 'INSERT INTO comment (author_user_id_Fk, target_shop_Fk, content, score) VALUES (?, ?, ?, ?);';
        $this->executeRequest($sql, array((int) $author_id, (int) $target_shop, (string) $content, (int) $score));
    }
}
?>

