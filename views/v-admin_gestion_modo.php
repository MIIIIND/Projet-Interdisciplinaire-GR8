<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
  <link rel="stylesheet" href="/Projet-Interdisciplinaire-GR8/views/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🎁</text></svg>"/>
  <title>Isims Parc | Administration modérateur</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    .column {
        margin: 10px;
        background-color: #7493e8a7;
        border-radius: 20px;
        float: left;
        width: 33.33%;
        padding: 15px;
    }
  </style>
</head>
<body>
    <?php require '_header.html' ?>
    <h2>Administration modérateur</h2>
    <ul>
        <li><a href="c-admin.php">Retour</a></li>
    </ul>
    <div class="container">
        <div class="columns-container">
            <!-- Add Moderator Form -->
            <div class="column">
                <div class="content-box">
                    <form method="post" action="">
                        <pt><h3>Ajout de modérateur</h3></p>
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
                        <p><span>Nom</span><span class="interaction-box"><input type="text" id="NomTextboxAjout" name="NomTextboxAjout"></span></p>
                        <p><span>Prenom</span><span class="interaction-box"><input type="text" id="PrenomTextboxAjout" name="PrenomTextboxAjout"></span></p>
                        <p><span>Login</span><span class="interaction-box"><input type="text" id="LoginTextboxAjout" name="LoginTextboxAjout"></span></p>
                        <p><span>Mot de passe</span><span class="interaction-box"><input type="password" id="MDPTextboxAjout" name="MDPTextboxAjout"></span></p>
                        <input type="submit" name="ajout" class="custom-button" value="Ajout">
                    </form>
                </div>
            </div>

        <!-- Delete Moderator Form -->
    <div class="column">
        <div class="content-box">
            <form method="post" action="">
                <p><h3>Suppression de Modérateur</h3></p>
                <p><span>Nom</span><span class="interaction-box">
                <select id="NomSelectSup" name="NomSelectSup"> <!-- Corrected name attribute -->
                        <option value="" disabled selected>Sélectionner un modérateur</option>
                        <?php foreach ($noms as $nom): ?>
                            <option value="<?php echo htmlspecialchars($nom['second_name']); ?>">
                                <?php echo htmlspecialchars($nom['second_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </span></p>
                <button type="submit" name="delete_modo" class="custom-button">Supprimer</button>
            </form>
        </div>
    </div>

            <!-- Modify Moderator Form -->
            <div class="column">
                <div class="content-box">
                    <form method="post" action="">
                        <p><h3>Modification de modérateur</h3></p>
                        <p><span>Modérateur</span><span class="interaction-box">
                        <select id="NomSelectSup2" name="NomSelectSup">
                                <option value="" disabled selected>Sélectionner un modérateur</option>
                                <?php foreach ($noms as $nom): ?>
                                    <option value="<?php echo htmlspecialchars($nom['second_name']); ?>">
                                        <?php echo htmlspecialchars($nom['second_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </span></p>
                        <p><span>Magasin</span><span class="interaction-box">
                        <select id="MagasinSelectAjout2" name="MagasinSelectAjout">
                                <option value="" disabled selected>Sélectionner un magasin</option>
                                <?php foreach ($magasins as $magasin): ?>
                                    <option value="<?php echo htmlspecialchars($magasin['shop_name']); ?>">
                                        <?php echo htmlspecialchars($magasin['shop_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </span></p>
                        <p><span>Nouveau login</span><span class="interaction-box"><input type="text" id="LoginTextboxModif" name="LoginTextboxModif"></span></p>
                        <p><span>Nouveau mot de passe</span><span class="interaction-box"><input type="password" id="MDPTextboxModif" name="MDPTextboxModif"></span></p>    
                        <button type="submit" name="modify_modo" class="custom-button">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require '_footer.html' ?>
</body>
</html>
