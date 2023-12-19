<?php 
require_once 'model.php';
$DB = new bd();

function login() {
    require 'config.php';
    if ($LOGIN_METHOD == 1) {loginDB();}
    else {loginLDAP();}
}

function loginLDAP() {
    if ( isset($_POST['connexion']) ) {
        $DOMAIN = "grp8.lan";
        $ldaprdn = trim($_POST['login'])."@".$DOMAIN;
        $ldappass = trim($_POST['password']);
        $ldapconn = ldap_connect("192.168.150.1") or die("Could not connect to LDAP server.");
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
    
        if ($ldapconn) {
            if ($ldaprdn == "" || $ldappass == "") {echo "<p>Erreur dans l'identifiant ou le mot de passe</p>";}
            elseif (@ldap_bind($ldapconn, $ldaprdn, $ldappass)) {
                $_SESSION['login']=$ldaprdn;
                header('Location:index.php'); //on redirige pour vider $_POST
                exit();
            }
            else {echo "<p>Erreur dans l'identifiant ou le mot de passe</p>" ;}
        }
    }
}

function loginDB() {
    global $DB;
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);
    $user = $DB->getUser($login, $password);
    if ($user == null) {
        echo "Erreur dans le login ou le mot de passe";
        return;
    }
    switch ($user->role_Fk) {
        case '1':
            $_SESSION['role']='Admin';
            header('Location: VueMagasin.php');
            break;
        case '2':
            $_SESSION['role']='Modo';
            break;
        case '3':
            $_SESSION['role']='Client';
            break;
    }
}

?>