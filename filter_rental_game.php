<?php
    include_once "connection.php";
    include_once "compatibility/fetch.php";

    $query = "%" . $_GET["search"] . "%";

    $sql = "select * from VIDEO_GAMES where name LIKE ? limit 10";
    $statement = $connection->prepare($sql);
    $statement->bind_param("s", $query);
    $statement->execute();
    $statement->store_result();

    $games = get($statement);

    ob_start();
    include_once "get_rental_game.php";
    $html = ob_get_contents();
    ob_end_clean();

    echo json_encode(
        array(
            "html" => $html
        )
    );
?>
