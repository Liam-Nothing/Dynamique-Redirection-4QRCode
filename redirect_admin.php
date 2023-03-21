<?php

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}

$data_from_client_POST = (array) json_decode(stripslashes(file_get_contents("php://input")));

mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

$return_data = [
    "type" => "none"
];

/*********************************************************************************/

$redirect_file_content = file_get_contents('./redirect.log', FILE_USE_INCLUDE_PATH, NULL, 0, 1);

// var_dump($data_from_client_POST);

if($data_from_client_POST) {


    $myfile = fopen("redirect.log", "w+") or die("Unable to open file!");
    $txt = "0";
    switch ($data_from_client_POST["redirect-id"]) {
        case "1":
            $txt = "1";
            break;
        case "2":
            $txt = "2";
            break;
    }
    fwrite($myfile, $txt);
    fclose($myfile);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirect Panel</title>

    <style>

        /* To disable blank at the to of the page */

        * {
            margin: 0;
            padding: 0;
            font-family: "Raleway", sans-serif;
        }

        /*********************************************************************************/

        button {
            height: 20vh;
            font-size: large;
            border: none;
        }

        button:nth-child(1) {
            background-color: red;
        }

        button:nth-child(2) {
            background-color: purple;
        }

        button:nth-child(3) {
            background-color: lawngreen;
        }

        body {
            position: relative;
            min-height: 100vh;
            background-color: #000;
        }

        header {
            height: 20vh;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-content: center;
            align-items: center;
        }

        main {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-content: center;
            height: 80vh;
        }

        h1 {
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <h1><?=$redirect_file_content?></h1>
    </header>
    <main>
        <button onclick="sendRequest('0')">Nothing</button>
        <button onclick="sendRequest('1')">Instagram</button>
        <button onclick="sendRequest('2')">Acide Shop</button>
    </main>

    <script>
        const url = "";

        function RequestAPI(url, api, data, session = null) {
            let xhr = new XMLHttpRequest();

            xhr.open("POST", url, true);

            xhr.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    location.reload();
                }
            };

            xhr.send(data);
        }

        function sendRequest(value) {
            let data = {};
            let api = "send_redirect";

            data["redirect-id"] = value;

            RequestAPI(url, api, JSON.stringify(data), null);
        }
    </script>
</body>
</html>