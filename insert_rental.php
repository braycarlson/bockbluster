<?php
    include_once "connection.php";
    include_once "compatibility/fetch.php";

    $customer = $_POST["customer"];
    $SID = $_SESSION["SID"];
    $search = $_POST["search"];

    // Is this is a customer?
    $sql = "select CID from CUSTOMER where name=?";
    $statement = $connection->prepare($sql);
    $statement->bind_param("s", $customer);
    $statement->execute();
    $statement->store_result();

    $customer = fetch($statement);

    date_default_timezone_set("America/Edmonton");
    $date = date("Y-m-d H:i:s");

    foreach ($search as $game) {
        // Does each game exist in the database?
        $sql = "select name from VIDEO_GAMES where name=?";
        $statement = $connection->prepare($sql);
        $statement->bind_param("s", $game);
        $statement->execute();
        $statement->store_result();

        $result = fetch($statement);
        $success = isset($result);

        if ($success) {
            $name = $result["name"];

            $sql = "insert into RENT (name, SID, CID, rented) values (?, ?, ?, ?)";

            $statement = $connection->prepare($sql);

            $statement->bind_param(
                "ssss",
                $name,
                $SID,
                $customer["CID"],
                $date
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
                    $message = "The row(s) were inserted.";

                    $query = "?message=" . $message . "&location=" . $location;
                    header("location: success.php" . $query);
                }
            } catch (Exception $exception) {
                $errno = $statement->errno;
                $message = $statement->error;

                $query = "?errno=" . $errno . "&message=" . $message;
                header("location: error.php" . $query);
            }
        } else {
            echo "Error:" . $game;
        }
    }
?>
