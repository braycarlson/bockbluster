<?php
    include_once("connection.php");
    include_once("compatibility/password.php");

    $unauthorized = !isset($_SESSION["ID"]);

    if ($unauthorized)
        header("location: login.php");

    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $manager = isset($_POST["manager"]) ? 1 : 0;

    $sql = "insert into STAFF (SID, name, username, password, address, phone, dob, wage, hours, manager) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $statement = $connection->prepare($sql);

    $statement->bind_param(
        "ssssssssss",
        $_POST["SID"],
        $_POST["name"],
        $_POST["username"],
        $password,
        $_POST["address"],
        $_POST["phone"],
        $_POST["dob"],
        $_POST["wage"],
        $_POST["hours"],
        $manager
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
