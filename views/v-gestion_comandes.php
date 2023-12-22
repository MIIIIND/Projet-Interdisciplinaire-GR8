<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Projet-Interdisciplinaire-GR8/views/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🎁</text></svg>"/>
    <title>Isims Parc | Gestion commandes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php require 'views/_header.html'; ?>
<main>
    <ul>
        <li><a href="/Projet-Interdisciplinaire-GR8/c-modo.php">Retour</a></li>
    </ul>
    <table>
        <tr>
            <th>Client</th>
            <th>Logement</th>
            <th>Article</th>
            <th>Quantité</th>
            <th>État de la commande</th>
        </tr>
    <?php while ($data = $cater->fetch()) : ?>
        <form method="post">
            <tr>
                <td>
                    <input type="hidden" name="order_id" value="<?= $data['order_id'] ?>">
                    <?= $data["first_name"] . ' ' . $data["second_name"] ?>
                </td>
                <td><?= $data["cottage_name"] ?></td>
                <td><?= $data["Souvenir_name"] ?></td>
                <td><?= $data['quantity'] ?></td>
                <td><?= $data['state_name'] ?></td>
                <td>
                    <select name="" id="">
                        <?php $states = $ORDER->getOrderStates(); ?>
                        <?php while ($data = $states->fetch()) : ?>
                            <option value="<?= $data->order_state_id; ?>"><?= $data->state_name; ?></option>
                        <?php endwhile; ?>
                    </select>
                </td>
                <td><input type="submit" name="vali_com" value="Modifier l'état"></td>
                <td><input type="submit" name="facturer" value="facturer"></td>
            </tr>
        </form>
        <?php endwhile; ?>
    </table>
</main>
<?php require 'views/_footer.html'; ?>
</body>
</html>