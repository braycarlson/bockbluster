<?php
    include_once("connection.php");

    $unauthorized = !isset($_SESSION["ID"]);

    if ($unauthorized)
        header("location: login.php");

    $sql = "delete from VIDEO_GAMES where name=?";
    $statement = $connection->prepare($sql);
    $statement->bind_param("s", $_GET["name"]);

    try {
        $statement->execute();

        if ($statement->error) {
            $errno = $statement->errno;
            $message = $statement->error;

            $query = "?errno=" . $errno . "&message=" . $message;
            header("location: error.php" . $query);
        } else {
            $location = "index.php";
            $message = "The row was deleted.";

            $query = "?message=" . $message . "&location=" . $location;
            header("location: success.php" . $query);
        }
    } catch (Exception $exception) {
        $errno = $statement->errno;
        $message = $statement->error;

        $query = "?errno=" . $errno . "&message=" . $message;
        header("location: error.php" . $query);
    }
?>
