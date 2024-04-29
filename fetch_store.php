<?php
    include_once "connection.php";
    include_once "compatibility/fetch.php";

    $unauthorized = !isset($_SESSION["ID"]);

    if ($unauthorized)
        header("location: login.php");

    $SID = $_GET["store"];

    if ($SID) {
        $sql = "select * from STORE where SID=?";
        $statement = $connection->prepare($sql);
        $statement->bind_param("s", $SID);
        $statement->execute();
        $statement->store_result();

        $profile = fetch($statement);

        ob_start();
        include_once "get_store_profile.php";
        $html = ob_get_contents();
        ob_end_clean();

        echo json_encode(
            array(
                "html" => $html
            )
        );
    }
?>
