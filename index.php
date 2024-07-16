<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-THKS622');</script>
<!-- End Google Tag Manager -->

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