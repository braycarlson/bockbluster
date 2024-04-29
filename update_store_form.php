<?php
    $title = "Update staff";

    include_once("connection.php");
    include_once "compatibility/fetch.php";
    include_once("component/header.php");

    $unauthorized = !isset($_SESSION["ID"]);

    if ($unauthorized)
        header("location: login.php");

    $SID = isset($_GET["SID"]);

    if ($SID) {
        $sql = "select * from STORE where SID=?";
        $statement = $connection->prepare($sql);
        $statement->bind_param("s", $_GET["SID"]);
        $statement->execute();
        $statement->store_result();

        $store = fetch($statement);
    } else {
        echo "Please enter a store ID to update.";
        return;
    }

    include_once("component/footer.php");
?>

<main>
    <h1 class="mt-8 mb-12 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
        <a href="update_store_form.php?SID=<?= $store["SID"]; ?>"><?= $store["name"]; ?></a>
    </h1>

    <div class="flex items-center justify-center h-fit">
        <div class="w-full max-w-xl">
            <form action="update_store.php" method=post class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" value="<?= $store["name"]; ?>" placeholder="John Doe">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="dob">Address</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="address" name="address" type="text" value="<?= $store["address"]; ?>" placeholder="123 Street NW, Lethbridge, AB">
                </div>

                <div class="mb-12">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Phone number</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phone" name="phone" type="text" value="<?= $store["phone"]; ?>" placeholder="403-555-5555">
                </div>

                <input id="SID" name="SID" type=hidden value="<?= $store["SID"]; ?>">

                <div class="flex items-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type=submit name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</main>
