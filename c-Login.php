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
    if ( isset($_POST['connexion']) ) {
        $ldaprdn = trim($_POST['login']);
        $ldappass = trim($_POST['password']);
        $ldapconn = ldap_connect("192.168.150.1") or die("Could not connect to LDAP server.");
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
    
        if ($ldapConn) {
            // Authentification
            $ldapBind = ldap_bind($ldapConn, $ldapUser, $ldapPass);
        
            if ($ldapBind) {
                // Paramètres de recherche
                $baseDN = "OU=Users,DC=example,DC=com";
                $searchFilter = "(sAMAccountName=username)";
                $searchScope = "sub";
        
                // Effectuer la recherche
                $ldapSearch = ldap_search($ldapConn, $baseDN, $searchFilter, [], 0, 0, 0, 0);
                $entries = ldap_get_entries($ldapConn, $ldapSearch);
        
                // Afficher les résultats
                for ($i = 0; $i < $entries["count"]; $i++) {
                    echo "DN: " . $entries[$i]["dn"] . "\n";
                    echo "Attributes: " . json_encode($entries[$i]) . "\n";
                }
        
                // Fermer la connexion LDAP
                ldap_close($ldapConn);
            } else {
                echo "Échec de l'authentification LDAP";
            }
        } else {
            echo "Impossible de se connecter au serveur LDAP";
        }
    }
}

function loginDB() {
    global $user_db;
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);
    $user = $user_db->getUser($login, $password);
    if ($user == null) {
        echo "Erreur dans le login ou le mot de passe";
        return;
    }
    switch ($user->role_Fk) {
        case '1':
                ='Admin';
            header('Location: c-master.php');
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