<?php
require_once 'models/m-User.php';
$user_db = new User();

function connexion(){
    require 'views/v-Login.php';
    if ( isset($_POST['connexion']) ) {
        require 'config.php';
        if ($LOGIN_METHOD == 1) {loginDB();}
        else {loginLDAP();}
    }
}

function loginLDAP() {
    global $user_db;
    $ldaprdn = (string) trim($_POST['login']);
    $ldappass = (string) trim($_POST['password']);
    $ldapconn = ldap_connect("192.168.150.1") or die("Could not connect to LDAP server.");
    ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);

    if ($ldapconn) {
        if ($ldaprdn == "" || $ldappass == "") {echo "<p>Erreur dans l'identifiant ou le mot de passe</p>";}
        elseif (@ldap_bind($ldapconn, $ldaprdn, $ldappass)) {
            $user = $user_db->getUser(explode("@", $ldaprdn)[0], sha1($ldappass));
            $_SESSION['user_id']=$user->user_id;
            $upn = explode("@", $ldaprdn)[1];
            switch ($upn) {
                case 'administrateur.lan':
                    $_SESSION['role']='Admin';
                    header('Location: c-master.php');
                    break;
                case 'modo.lan':
                    $_SESSION['role']='Modo';
                    header('Location: c-master.php');
                    break;
                case 'grp8.lan':
                    $_SESSION['role']='Client';
                    header('Location: c-master.php');
                    break;
            }
        } else {echo "<p>Erreur dans l'identifiant ou le mot de passe.</p>" ;}
    } else {echo "<p>Impossible de se connecter au serveur.</p>" ;}
}

function loginDB() {
    global $user_db;
    $login = trim($_POST['login']);
    $password = sha1(trim($_POST['password']));
    $user = $user_db->getUser($login, $password);
    if ($user == null) {
        echo "<p>Erreur dans le login ou le mot de passe.</p>";
        return;
    }
    $_SESSION['user_id']=$user->user_id;
    switch (strtolower($user->role_name))  {
        case 'admin':
            $_SESSION['role']='Admin';
            header('Location: c-master.php');
            break;
        case 'modo':
            $_SESSION['role']='Modo';
            header('Location: c-master.php');
            break;
        case 'client':
            $_SESSION['role']='Client';
            header('Location: c-master.php');
            break;
    }
}
?>