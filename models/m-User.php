<?php 
require_once 'm-Model.php';

class User extends DB {
    public function getUser($login, $password){ // retourne un utilisateur
        try {
            $sql = 'SELECT * from user WHERE login=? AND password=?';
            $user = $this->executeRequest($sql, array((string) $login, (string) $password));
            if ($user->rowcount() == 1)
                return $user->fetch();
            else
                echo "Erreur dans le login ou le mot de passe";
        }
        catch (Exception $e) {echo "Erreur de connexion : $e";}
    }
}
?>