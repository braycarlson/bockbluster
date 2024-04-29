<?php
    $title = "Update staff";

    include_once("connection.php");
    include_once "compatibility/fetch.php";
    include_once("component/header.php");

    $unauthorized = !isset($_SESSION["ID"]);

    if ($unauthorized)
        header("location: login.php");

    $name = isset($_GET["name"]);

    if ($name) {
        $sql = "select * from VIDEO_GAMES where name=?";
        $statement = $connection->prepare($sql);
        $statement->bind_param("s", $_GET["name"]);
        $statement->execute();
        $statement->store_result();

        $game = fetch($statement);
    } else {
        echo "Please enter a game's name to update.";
        return;
    }

    include_once("component/footer.php");
?>

<main>
    <h1 class="mt-8 mb-12 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
        <a href="update_game_form.php?name=<?= $game["name"]; ?>"><?= $game["name"]; ?></a>
    </h1>

    <div class="flex items-center justify-center h-fit">
        <div class="w-full max-w-xl">
            <form action="update_game.php" method="post" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" value="<?= $game["name"]; ?>" placeholder="John Doe">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="year_released">Year Released</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="year_released" name="year_released" type="text" value="<?= $game["year_released"]; ?>" placeholder="1993">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="overview">Overview</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="overview" name="overview" type="text" value="<?= $game["overview"]; ?>" placeholder="Overview">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="developer">Developer</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="developer" name="developer" type="text" value="<?= $game["developer"]; ?>" placeholder="Nintendo">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="genre">Genre</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="genre" name="genre" type="text" value="<?= $game["genre"]; ?>" placeholder="Action">
                </div>

                <div class="mb-12">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Image</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="image" name="image" type="file">
                </div>

                <input id="old_name" name="old_name" type=hidden value="<?= $game["name"]; ?>">
                <input id="old_image" name="old_image" type=hidden value="<?= $game["image"]; ?>">

                <div class="flex items-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type=submit name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</main>
