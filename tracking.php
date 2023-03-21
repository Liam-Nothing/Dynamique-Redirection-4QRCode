<?php

function TrackInDatabase($database, $table_name, $add_data = false) {
    $cookie_name = "NE_T";
    $cookie_value = uniqid();

    if(!isset($_COOKIE[$cookie_name])) {
        setcookie(
            $cookie_name,
            $cookie_value,
            time() + (10 * 365 * 24 * 60 * 60)
        );
    }else{
        $cookie_value = $_COOKIE[$cookie_name];
    }

    $data = [];
    if ($add_data) {
        $data["ADD_DATA"] = $add_data;
    }

    $data["COOKIE"] = $cookie_value;
    $data["DATE"] = date('d-m-Y H:i:s', $_SERVER['REQUEST_TIME']);
    $data["SERVER"] = $_SERVER;

    unset($data["SERVER"]["USER"]);
    unset($data["SERVER"]["SCRIPT_FILENAME"]);
    unset($data["SERVER"]["SERVER_ADMIN"]);
    unset($data["SERVER"]["SERVER_SOFTWARE"]);
    unset($data["SERVER"]["DOCUMENT_ROOT"]);
    unset($data["SERVER"]["CFG_CLUSTER"]);

    $sqlr = $database->prepare("
    INSERT INTO `".$table_name."`
    (cookie_id, data, code) 
    VALUES (:cookie_id, :data, :code);
    ");

    $sqlr->bindParam(':cookie_id', $data["COOKIE"]);
    $json_data = json_encode($data);
    $sqlr->bindParam(':data', $json_data);
    $sqlr->bindParam(':code', $data["ADD_DATA"]);
    
    // Save data into file if db error
    if (!$sqlr->execute() or !$sqlr->rowCount() > 0) {
        TrackInFile("error_db", $add_data);
    }
}


function TrackInFile($saved_file, $add_data = false) {
    $cookie_name = "NE_T";
    $cookie_value = uniqid();

    if(!isset($_COOKIE[$cookie_name])) {
        setcookie(
            $cookie_name,
            $cookie_value,
            time() + (10 * 365 * 24 * 60 * 60)
        );
    }else{
        $cookie_value = $_COOKIE[$cookie_name];
    }

    $data = [];
    if ($add_data) {
        $data["ADD_DATA"] = $add_data;
    }

    $data["COOKIE"] = $cookie_value;
    $data["DATE"] = date('d-m-Y H:i:s', $_SERVER['REQUEST_TIME']);
    $data["SERVER"] = $_SERVER;

    unset($data["SERVER"]["USER"]);
    unset($data["SERVER"]["SCRIPT_FILENAME"]);
    unset($data["SERVER"]["SERVER_ADMIN"]);
    unset($data["SERVER"]["SERVER_SOFTWARE"]);
    unset($data["SERVER"]["DOCUMENT_ROOT"]);
    unset($data["SERVER"]["CFG_CLUSTER"]);

    $handle = fopen($saved_file, "a+");
    fwrite($handle, json_encode($data) . "\n");
    fclose($handle);
}