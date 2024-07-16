<?php
session_start();
require 'config/config.php';

$urlFile = 'url_storage.txt';
$buttonUrlsFile = 'button_urls.json';

// Charger les URLs, titres et couleurs des boutons
$buttonUrls = json_decode(file_get_contents($buttonUrlsFile), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['password']) && $_POST['password'] === $adminPassword) {
        $_SESSION['logged_in'] = true;
    } elseif (isset($_POST['url'])) {
        file_put_contents($urlFile, trim($_POST['url']));
    } elseif (isset($_POST['disable_redirect'])) {
        file_put_contents($urlFile, '');
    } elseif (isset($_POST['preset_url'])) {
        file_put_contents($urlFile, trim($_POST['preset_url']));
    } elseif (isset($_POST['button']) && isset($_POST['button_url']) && isset($_POST['button_title']) && isset($_POST['button_color'])) {
        $buttonUrls[$_POST['button']] = [
            'url' => trim($_POST['button_url']),
            'title' => trim($_POST['button_title']),
            'color' => trim($_POST['button_color'])
        ];
        file_put_contents($buttonUrlsFile, json_encode($buttonUrls));
    }
}

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    ?>
    <form method="POST">
        <input type="password" name="password" placeholder="Mot de passe">
        <button type="submit">Se connecter</button>
    </form>
    <?php
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <title>Administration</title>
</head>
<body class="bg-dark text-white">
    <div class="container">
        <h1 class="my-4">Administration</h1>
        <form method="POST" class="mb-4">
            <input type="url" name="url" class="form-control" placeholder="Entrez l'URL de redirection">
            <button type="submit" class="btn btn-primary mt-2">Mettre à jour l'URL</button>
        </form>
        <form method="POST" class="mb-4">
            <div class="d-grid gap-2">
                <?php foreach ($buttonUrls as $button => $details) { ?>
                    <div class="input-group mb-2">
                        <button type="submit" name="preset_url" value="<?= $details['url'] ?>" class="btn <?= $details['color'] ?> btn-block"><?= $details['title'] ?></button>
                        <button type="button" class="btn btn-outline-light" onclick="editButton('<?= $button ?>', '<?= $details['url'] ?>', '<?= $details['title'] ?>', '<?= $details['color'] ?>')">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>
                <?php } ?>
            </div>
        </form>
        <form method="POST">
            <input type="hidden" name="disable_redirect" value="1">
            <button type="submit" class="btn btn-danger">Désactiver la redirection</button>
        </form>
    </div>

    <div class="modal" id="editButtonModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier le bouton</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="editButtonForm">
                    <div class="modal-body">
                        <input type="hidden" name="button" id="buttonName">
                        <div class="form-group">
                            <label for="buttonUrl">URL</label>
                            <input type="url" name="button_url" id="buttonUrl" class="form-control" placeholder="Entrez la nouvelle URL">
                        </div>
                        <div class="form-group">
                            <label for="buttonTitle">Titre</label>
                            <input type="text" name="button_title" id="buttonTitle" class="form-control" placeholder="Entrez le nouveau titre">
                        </div>
                        <div class="form-group">
                            <label for="buttonColor">Couleur</label>
                            <select name="button_color" id="buttonColor" class="form-control">
                                <option value="btn-secondary">Gris</option>
                                <option value="btn-primary">Bleu</option>
                                <option value="btn-success">Vert</option>
                                <option value="btn-danger">Rouge</option>
                                <option value="btn-warning">Jaune</option>
                                <option value="btn-info">Cyan</option>
                                <option value="btn-dark">Noir</option>
                                <option value="btn-light">Blanc</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="scripts/script.js"></script>
</body>
</html>
