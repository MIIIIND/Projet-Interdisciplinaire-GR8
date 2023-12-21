<?php ob_start(); ?>
<input type="submit" name="action" value="Gestion commandes">
<input type="submit" name="action" value="Gestion articles">
<input type="submit" name="action" value="Gestion commentaires">
<?php
$nav = ob_get_clean();
?>

<?php ob_start(); ?>
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