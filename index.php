<?php
$urlFile = 'url_storage.txt';

if (file_exists($urlFile)) {
    $url = file_get_contents($urlFile);
    if (!empty(trim($url))) {
        header("Location: " . trim($url));
        exit();
    } else {
        echo "Redirection désactivée.";
    }
} else {
    echo "Redirection désactivée.";
}
?>