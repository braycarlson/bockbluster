<?php
    $title = "Rental";

    include_once "connection.php";
    include_once "component/header.php";
    include_once "compatibility/fetch.php";

    $is_game = isset($_GET["name"]);
    $is_customer = isset($_GET["CID"]);

    if ($is_game) {
        $name = $_GET["name"];

        $sql = "select * from VIDEO_GAMES where name=?";
        $statement = $connection->prepare($sql);
        $statement->bind_param("s", $name);
        $statement->execute();
        $statement->store_result();

        $game = fetch($statement);
    }

    if ($is_customer) {
        $CID = $_GET["CID"];

        $sql = "select * from CUSTOMER where CID=?";
        $statement = $connection->prepare($sql);
        $statement->bind_param("s", $CID);
        $statement->execute();
        $statement->store_result();

        $customer = fetch($statement);
    }
?>

<main>
    <h1 class="mt-8 mb-12 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
        <a href="#">Rental</a>
    </h1>

    <div class="flex items-center justify-center h-fit">
        <div class="w-full max-w-lg">
            <form action="insert_rental.php" method="post" id="rental_form" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <?php if ($is_customer): ?>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="customer">Customer</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="customer" name="customer" type="text" value="<?=$customer["name"]; ?>" placeholder="John Doe" readonly>

                        <input id="CID" name="CID" type="hidden" value="<?=$customer["CID"]; ?>">
                    </div>
                <?php endif; ?>

                <?php if ($is_game): ?>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="customer">Customer</label>
                    </div>

                    <div id="rental_customer_section" class="relative">
                        <div id="rental_customer_dropdown" class="flex justify-center items-center">
                            <div class="mb-6 w-full">
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="rental_customer_search" name="customer" type="text" placeholder="Search">

                                <ul id="rental_customer_suggestion" class="h-40 overflow-y-auto hidden shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <div id="available">
                                        <?php include_once("get_rental_customer.php"); ?>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="search">Game(s)</label>
                </div>

                <div id="rental_game_section" class="relative">
                    <div id="rental_game_dropdown" class="flex justify-center items-center">
                        <div class="mb-6 w-full">
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="rental_game_search" name="search[]" value="<?= $is_game ? $game["name"] : "" ?>" type="text" placeholder="Search">

                            <ul id="rental_game_suggestion" class="h-40 overflow-y-auto hidden shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <div id="available">
                                    <?php include_once("get_rental_game.php"); ?>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>

                <div id="game_control" class="mt-8 w-full flex items-center justify-center space-x-14">
                    <button id="new_game_rental" class=" w-1/4 bg-green-400 hover:bg-green-700 text-white font-bold py-2 px-2 rounded focus:outline-none focus:shadow-outline" type=button name="new_game">+</button>
                    <button id="delete_game_rental" class="w-1/4 bg-violet-400 hover:bg-violet-700 text-white font-bold py-2 px-2 rounded focus:outline-none focus:shadow-outline" type=button name="delete_game">-</button>
                </div>

                <div class="w-full flex items-center justify-center">
                    <button id="submit" class="mt-12 w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type=submit name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</main>
