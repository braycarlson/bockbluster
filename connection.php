<?php
    if (strpos($_SERVER["DOCUMENT_ROOT"], "/home/carb3660/") === 0) {
        ini_set(
            "session.save_path",
            "/home/carb3660/session"
        );
    }

    session_start();

    $configuration = parse_ini_file("config.ini");

    $host = $configuration["host"];
    $database = $configuration["database"];
    $username = $configuration["username"];
    $password = $configuration["password"];

    $connection = new mysqli(
        $host,
        $username,
        $password,
        $database
    );

    if ($connection->connect_errno) {
        echo $connection->connect_errno;
        exit;
    }

    $connection->set_charset("utf8");
?>
