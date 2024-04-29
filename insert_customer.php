<?php
    include_once("connection.php");

    $unauthorized = !isset($_SESSION["ID"]);

    if ($unauthorized)
        header("location: login.php");

    $membership = isset($_POST["membership"]) ? 1 : 0;

    $sql = "insert into CUSTOMER (name, email, phone, address, dob, membership) values (?, ?, ?, ?, ?, ?)";

    $statement = $connection->prepare($sql);

    $statement->bind_param(
        "ssssss",
        $_POST["name"],
        $_POST["email"],
        $_POST["phone"],
        $_POST["address"],
        $_POST["dob"],
        $membership
    );

    try {
        $statement->execute();

        if ($statement->error) {
            $errno = $statement->errno;
            $message = $statement->error;

            $query = "?errno=" . $errno . "&message=" . $message;
            header("location: error.php" . $query);
        } else {
            $location = "dashboard.php";
            $message = "The row was inserted.";

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
