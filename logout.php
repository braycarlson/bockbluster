<?php
    include_once("connection.php");

    unset($_SESSION["ID"]);
    unset($_SESSION["name"]);
    unset($_SESSION["username"]);
    unset($_SESSION["password"]);
    unset($_SESSION["manager"]);
    unset($_SESSION["SID"]);
    unset($_SESSION["authorization"]);

    $location = "index.php";
    $message = "You have logged out.";

    $query = "?message=" . $message . "&location=" . $location;
    header("location: success.php" . $query);
?>
