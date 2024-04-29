<?php
    include_once("connection.php");

    $unauthorized = !isset($_SESSION["ID"]);

    if ($unauthorized)
        header("location: login.php");

    $is_image = $_FILES["image"]["size"] > 0;

    if ($is_image) {
        $path = $_FILES["image"]["tmp_name"];
        $filename = $_FILES["image"]["name"];
        $extension = explode(".", $filename);
        $extension = strtolower(end($extension));

        $image = "images/demo/" . $filename;
        $destination = "./images/demo/" . $filename;

        $success = move_uploaded_file($path, $destination);

        if ($success) {
            $sql = "insert into VIDEO_GAMES (name, year_released, overview, developer, genre, image) values (?, ?, ?, ?, ?, ?)";

            $statement = $connection->prepare($sql);

            $statement->bind_param(
                "ssssss",
                $_POST["name"],
                $_POST["year_released"],
                $_POST["overview"],
                $_POST["developer"],
                $_POST["genre"],
                $image
            );

            try {
                $statement->execute();

                if ($statement->error) {
                    $errno = $statement->errno;
                    $message = $statement->error;

                    $query = "?errno=" . $errno . "&message=" . $message;
                    header("location: error.php" . $query);
                } else {
                    $location = "index.php";
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
        }
    }
?>
