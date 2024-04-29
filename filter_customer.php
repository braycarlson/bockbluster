<?php
    include_once "connection.php";
    include_once "compatibility/fetch.php";

    $page = isset($_GET["page"]) ? $_GET["page"] : 1;

    $query = "%" . $_GET["search"] . "%";

    $sql = "select distinct * from CUSTOMER where name LIKE ? order by CID desc limit 10";
    $statement = $connection->prepare($sql);
    $statement->bind_param("s", $query);
    $statement->execute();
    $statement->store_result();

    $customers = get($statement);

    ob_start();
    include_once "get_customer.php";
    $html = ob_get_contents();
    ob_end_clean();

    echo json_encode(
        array(
            "html" => $html
        )
    );
?>
