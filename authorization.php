<?php
    include_once("connection.php");
    include_once("compatibility/password.php");

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "select ID, name, password, manager, SID from STAFF where username=?";
    $statement = $connection->prepare($sql);
    $statement->bind_param("s", $username);
    $statement->execute();
    $statement->bind_result($ID, $name, $hash, $manager, $SID);
    $statement->store_result();
    $statement->fetch();

    if ($statement->num_rows == 1) {
        $verified = password_verify($password, $hash);

        if ($verified) {
            $_SESSION["ID"] = $ID;
            $_SESSION["name"] = $name;
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
            $_SESSION["manager"] = $manager;
            $_SESSION["SID"] = $SID;
            $_SESSION["authorization"] = 1;

            $location = "dashboard.php";
            $message = "You have logged in.";

            $query = "?message=" . $message . "&location=" . $location;
            header("location: success.php" . $query);
        } else {
            $errno = $statement->errno;
            $message = $statement->error;

            $query = "?errno=" . $errno . "&message=" . "The username or password you entered was incorrect";
            header("location: error.php" . $query);
        }
    } else {
        $errno = $statement->errno;
        $message = $statement->error;

        $query = "?errno=" . $errno . "&message=" . "The username or password you entered was incorrect";
        header("location: error.php" . $query);
    }
?>
