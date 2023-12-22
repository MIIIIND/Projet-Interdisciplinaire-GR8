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

    public function getModo() {
        $sql = "SELECT * FROM user WHERE role_Fk = (SELECT role_id FROM role WHERE role_name = 'Modo');";
        return $this->executeRequest($sql);
    }

    public function addUser($first_name, $second_name, $role_Fk, $password, $login) {
        $sql = "INSERT INTO user (first_name, second_name, role_Fk, password, login) VALUES (?, ?, ?, ?, ?)";
        return $this->executeRequest($sql, array((string) $first_name, (string) $second_name, (int) $role_Fk, (string) $password, (string) $login));
    }

    public function delUser($name) { // Deleting from ID would have been better...
        $sql = "DELETE FROM user WHERE second_name = ?";
        return $this->executeRequest($sql, array((string) $name));
    }

    public function updateUser($prenom, $mdp, $login, $nom) {
        $sql = "UPDATE user SET second_name = ?, password = ?, login = ? WHERE second_name = ?";
        $stmt = $this->executeRequest($sql, array((string) $prenom, (string) $mdp, (string) $login, (string) $nom));
    }
}
?>