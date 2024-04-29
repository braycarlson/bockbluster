<?php
    include_once("connection.php");

    $unauthorized = !isset($_SESSION["ID"]);

    if ($unauthorized)
        header("location: login.php");

    $manager = isset($_POST["manager"]) ? 1 : 0;

    $sql = "update STAFF set SID=?, name=?, username=?, password=?, address=?, phone=?, dob=?, wage=?, hours=?, manager=? where ID=?";

    $statement = $connection->prepare($sql);

    $statement->bind_param(
        "sssssssssss",
        $_POST["SID"],
        $_POST["name"],
        $_POST["username"],
        $_POST["password"],
        $_POST["address"],
        $_POST["phone"],
        $_POST["dob"],
        $_POST["wage"],
        $_POST["hours"],
        $manager,
        $_POST["ID"]
    );

    try {
        $statement->execute();

        if ($statement->error) {
            $errno = $statement->errno;
            $message = $statement->error;

            $query = "?errno=" . $errno . "&message=" . $message;
            header("location: error.php" . $query);
        } else {
            $location = "get_staff.php";
            $message = "The row was updated.";

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
