<?php
    $title = "Home";

    include_once "connection.php";
    include_once "component/header.php";
    include_once "compatibility/fetch.php";

    // Pagination
    $sql = "select * from VIDEO_GAMES";
    $result = $connection->query($sql);
    $total = mysqli_num_rows($result);
    $limit = 10;
    $amount = ceil($total / $limit);

    // Fetch 10 per page
    $sql = "select * from VIDEO_GAMES limit ?";
    $statement = $connection->prepare($sql);
    $statement->bind_param("s", $limit);
    $statement->execute();
    $statement->store_result();

    $games = get($statement);
?>

<main>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-8 mx-auto">
            <div class="flex flex-col text-center w-full">
                <h1 class="mb-12 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
                    <a href="index.php">Home</a>
                </h1>
            </div>

            <div class="flex justify-center">
                <div class="mb-8 xl:w-96">
                    <input type="search" id="game_search" placeholder="Search" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                </div>
            </div>

            <div class="flex flex-wrap -m-4">
                <div id="gallery" class="flex flex-wrap w-full">
                    <?php include_once("get_game.php"); ?>
                </div>
            </div>
        </div>

        <div class="inline-flex justify-center gap-1 min-w-full mb-8 mt-12">
            <a href="#" id="previous_game" class="inline-flex h-8 w-8 items-center justify-center rounded border border-gray-100">
                <span class="sr-only">previous page</span>

                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd">
                </svg>
            </a>

            <div>
                <label class="sr-only">Page</label>

                <input type="number" id="counter" class="h-8 w-12 rounded border border-gray-100 p-0 text-center text-xs font-medium [-moz-appearance:_textfield] [&::-webkit-outer-spin-button]:m-0 [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:m-0 [&::-webkit-inner-spin-button]:appearance-none" value="1" readonly disabled>
            </div>

            <a href="#" id="next_game" class="inline-flex h-8 w-8 items-center justify-center rounded border border-gray-100">
                <span class="sr-only">next page</span>

                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd">
                </svg>
            </a>
        </div>

        <div class="flex space-x-2 justify-center mt-8 mb-24">
            <a href="insert_game_form.php">Insert</a>
        </div>
    </section>
</main>

<?php
    include_once("component/footer.php");
?>

