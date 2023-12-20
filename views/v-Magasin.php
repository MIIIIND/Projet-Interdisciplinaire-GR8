<?php ob_start(); ?>
<nav>
	<a href="">Gestion commandes</a>
	<a href="">Gestion articles</a>
</nav>
<fieldset>
	<legend>Modifier les horaires du magasin</legend>
	<form method="post">
		<label>Ouverture<br>
		<input type="time" name="H_ouv" id="H_ouv"><br>
		</label>
		<label>Fermeture<br>
		<input type="time" name="H_fer" id="H_fer"><br>
		</label>
		<input type="submit" name="set_schedules" value="Définir" >
	</form>
</fieldset>
<?php
$title = 'Gestion Magasin';
$content = ob_get_clean();
require '_template.php'
?>