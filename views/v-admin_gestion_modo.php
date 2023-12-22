<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
  <link rel="stylesheet" href="/Projet-Interdisciplinaire-GR8/views/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🎁</text></svg>"/>
  <title>Isims Parc | Gestion modérateur</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php require '_header.html' ?>
    <ul>
        <li><a href="c-admin.php">Retour</a></li>
    </ul>
    <div class="container">
        <div class="columns-container">
            <!-- Add Moderator Form -->
            <div class="column">
                <div class="content-box">
                    <form method="post" action="">
                        <p style="line-height:10.8pt">Ajouter Modo</p>
                        <p><span>Nom</span><span class="interaction-box"><input type="text" id="NomTextboxAjout" name="NomTextboxAjout"></span></p>
                        <p><span>Prenom</span><span class="interaction-box"><input type="text" id="PrenomTextboxAjout" name="PrenomTextboxAjout"></span></p>
                        <p><span>Login</span><span class="interaction-box"><input type="text" id="LoginTextboxAjout" name="LoginTextboxAjout"></span></p>
                        <p><span>Magasin</span><span class="interaction-box">
                        <select id="MagasinSelectAjout" name="MagasinSelectAjout">
                                <option value="" disabled selected>Select a Magasin</option>
                                <?php foreach ($magasins as $magasin): ?>
                                    <option value="<?php echo htmlspecialchars($magasin['shop_name']); ?>">
                                        <?php echo htmlspecialchars($magasin['shop_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </span></p>
                        <p><span>MDP</span><span class="interaction-box"><input type="text" id="MDPTextboxAjout" name="MDPTextboxAjout"></span></p>
                        <input type="submit" name="ajout" class="custom-button" value="Ajout">
                    </form>
                </div>
            </div>

        <!-- Delete Moderator Form -->
    <div class="column">
        <div class="content-box">
            <form method="post" action="">
                <p>Sup Modo</p>
                <p><span>Nom</span><span class="interaction-box">
                <select id="NomSelectSup" name="NomSelectSup"> <!-- Corrected name attribute -->
                        <option value="" disabled selected>Select a Nom</option>
                        <?php foreach ($noms as $nom): ?>
                            <option value="<?php echo htmlspecialchars($nom['second_name']); ?>">
                                <?php echo htmlspecialchars($nom['second_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </span></p>
                <button type="submit" name="delete_modo" class="custom-button">Sup</button>
            </form>
        </div>
    </div>

            <!-- Modify Moderator Form -->
            <div class="column">
                <div class="content-box">
                    <form method="post" action="">
                        <p>Modif modo</p>
                        <p><span>Nom</span><span class="interaction-box">
                        <select id="NomSelectSup2" name="NomSelectSup">
                                <option value="" disabled selected>Select a Nom</option>
                                <?php foreach ($noms as $nom): ?>
                                    <option value="<?php echo htmlspecialchars($nom['second_name']); ?>">
                                        <?php echo htmlspecialchars($nom['second_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </span></p>
                        <p><span>Nouveau Nom</span><span class="interaction-box"><input type="text" id="PrenomTextboxModif" name="PrenomTextboxModif"></span></p>
                        <p><span>Nouveau Login</span><span class="interaction-box"><input type="text" id="LoginTextboxModif" name="LoginTextboxModif"></span></p>
                        <p><span>Magasin</span><span class="interaction-box">
                        <select id="MagasinSelectAjout2" name="MagasinSelectAjout">
                                <option value="" disabled selected>Select a Magasin</option>
                                <?php foreach ($magasins as $magasin): ?>
                                    <option value="<?php echo htmlspecialchars($magasin['shop_name']); ?>">
                                        <?php echo htmlspecialchars($magasin['shop_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </span></p>
                        <p><span>MDP</span><span class="interaction-box"><input type="text" id="MDPTextboxModif" name="MDPTextboxModif"></span></p>
                        <button type="submit" name="modify_modo" class="custom-button">Modif</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require '_footer.html' ?>
</body>
</html>
