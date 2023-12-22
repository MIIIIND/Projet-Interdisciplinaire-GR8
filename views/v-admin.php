<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <link rel="stylesheet" href="/Projet-Interdisciplinaire-GR8/views/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🎁</text></svg>"/>
  <title>Isims Parc | Administration</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php require '_header.html';?>
    <h2>Administration des magasins</h2>
    <div class="big-box">
        <!-- Modification Form -->
        <form class="small-box" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h3>Modification Magasin</h3>

            <!-- Nom Dropdown -->
            <div>
                <label for="nom">Nom</label>
                <select id="nom" name="nom">
                    <?php echo $nomOptions; ?>
                </select>
            </div>

            <div style="margin-bottom: 20px;"></div>

            <div>
                <label for="nomTextBox">Nom</label>
                <input type="text" id="nomTextBox" name="nomTextBox" />
            </div>

            <!-- Type Dropdown -->
            <div>
                <label for="type">Type</label>
                <select id="type" name="type">
                    <?php echo $typeOptions; ?>
                </select>
            </div>

            <div class="button-container">
            <input type="submit" class="centered-button" name="modifier" value="Modifier">
            </div>
        </form>
        
        <!-- Ajout Magasin Form -->
        <form class="small-box" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <h3>Ajout de Magasin</h3>
            <div>
                <label for="nomMagasin">Nom</label>
                <input type="text" id="nomMagasin" name="nomMagasin" />
            </div>
            <div>
                <label for="typeMagasin">Type</label>
                <select id="typeMagasin" name="typeMagasin">
                    <?php echo $typeOptions; ?>
                </select>
            </div>
            <div class="button-container">
                <input type="submit" class="centered-button" name="ajout" value="Ajout">
            </div>
        </form>
        
        <form class="small-box" action="c-admin.php" method="post">
            <div class="button-container">
                <input type="submit" class="centered-button"  name="GestionModo" value="Gestion Moderateur">
            </div>
        </form>

        <!-- Ajout Type de magasin Form -->
        <!-- ======================================= -->    
        <form class="small-box" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <h3>Ajout de type de magasin</h3>
            <div>
                <label for="AjoutTypeMagasin">Nom</label>
                <input type="text" id="AjoutTypeMagasin" name="AjoutTypeMagasin" />
            </div>
            <div class="button-container">
                <input type="submit" class="centered-button" name="ajoutType" value="Ajout">
            </div>
        </form>

        <form class="small-box" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <h3>Suppression de Type de magasin</h3>
            <p></p>
            <div>
                <label for="typeToDelete">Type</label>
                <select id="typeToDelete" name="typeToDelete">
                    <?php echo $typeDeleteOptions; ?>
                </select>
            </div>
            <div class="button-container">
                <input type="submit" class="centered-button" name="supprimer" value="Supprimer">
            </div>
        </form>
        
        <form class="small-box" action="c-admin.php" method="post">
            <div class="button-container">
                <input type="submit" class="centered-button" name="statistique" value="Statistique">
            </div>
        </form>
    </div>
<?php require '_footer.html'; ?>
</body>
</html>