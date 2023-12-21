
<?php ob_start(); ?>
<div class="login">
        <img src="img/IconLog.png" alt="icon de compte">
        <form method="post" action="index.php">
            <p><label for="login">Identifiant<br>
            <input type="text" name="login" id="login">
            </label>
            <p><label for="password">Mot de passe<br>
            <input type="password" name="password" id="password">
            </label>
            <p><input type="submit" name="connexion" value="connexion">
        </form>
</div>
<p>Si vous ne disposez pas de compte, contacter l'administrateur.</p>
<?php
$nav = null;
$title = 'Connexion';
$content = ob_get_clean();
require '_template.php'
?>  