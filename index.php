<?php

require_once("tracking.php");
TrackInFile("click_data.log");

function IsRedirect() {
    $redirect_file_content = file_get_contents('./redirect.log', FILE_USE_INCLUDE_PATH, NULL, 0, 1);

    switch ($redirect_file_content) {
        case "1":
            return '<meta http-equiv="refresh" content="2;url=instagram://user?username=tekkno_L" />';
            break;
        case "2":
            return '<meta http-equiv="refresh" content="2;url=http://acide.shop" />';
            break;
    }

    return null;
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale = 1.0, user-scalable = no">
    <?=IsRedirect();?>
    <title>
        Qr3.Fr | Wtf BRO
    </title>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-THKS622');</script>
    <!-- End Google Tag Manager -->
</head>

<body>
    <script>
        colors_list = [
            "red",
            "deeppink",
            "orangered",
            "yellow",
            "magenta",
            "darkviolet",
            "lime",
            "cyan",
            "deepskyblue",
            "blue",
        ]

        setInterval(
            function () {
                document.body.style.backgroundColor = colors_list[getRandomInt(colors_list.length)];
            }
        , 10);

        function getRandomInt(max) {
            return Math.floor(Math.random() * max);
        }
    </script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-THKS622"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>	