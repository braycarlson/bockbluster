<?php
    $title = "Rental History";

    include_once "connection.php";
    include_once "component/header.php";
    include_once "compatibility/fetch.php";

    $CID = $_GET["CID"];

    $sql = "select * from RENT where CID=? order by rented desc";
    $statement = $connection->prepare($sql);
    $statement->bind_param("s", $CID);
    $statement->execute();
    $statement->store_result();

    $history = get($statement);
?>

<main>
    <h1 class="mt-8 mb-12 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
        Rental History
    </h1>

    <div class="flex justify-evenly">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table id="customer" class="min-w-full">
                        <thead class="border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">name</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">cid</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">sid</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">rented</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">return</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php include_once("get_rental_history.php"); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
