<?php
    include_once "connection.php";
    include_once "compatibility/fetch.php";

    $unauthorized = !isset($_SESSION["ID"]);

    if ($unauthorized)
        header("location: login.php");

    $ID = $_GET["employee"];

    if ($ID) {
        $sql = "select *, (select STORE.name from STORE where STAFF.SID=STORE.SID) as sname from STAFF where STAFF.ID=?";
        $statement = $connection->prepare($sql);
        $statement->bind_param("s", $ID);
        $statement->execute();
        $statement->store_result();

        $profile = fetch($statement);

        ob_start();
        include_once "get_staff_profile.php";
        $html = ob_get_contents();
        ob_end_clean();

        echo json_encode(
            array(
                "html" => $html
            )
        );
    }
?>
