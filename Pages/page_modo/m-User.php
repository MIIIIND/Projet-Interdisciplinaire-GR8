<?php 
require_once 'm-Model.php';

class User extends DB {
    public function getUser($login, $password){ // retourne un utilisateur
        try {
            $sql = 'SELECT * from user AS u JOIN role AS r ON u.role_Fk=r.role_id WHERE login=? AND password=?';
            $user = $this->executeRequest($sql, array((string) $login, (string) $password));
            if ($user->rowcount() == 1)
                return $user->fetch();
            else
                echo "Erreur dans le login ou le mot de passe";
        }
        catch (Exception $e) {echo "Erreur de connexion : $e";}
    }

    public function updateBill($price, $user_id){
        $sql="UPDATE `user` SET bill = bill + ? WHERE user_id = ?";
        $this->executeRequest($sql, array((int) $price, (int) $user_id));
    }
}
?>