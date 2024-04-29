<?php
    $title = "Insert store";

    include_once("connection.php");
    include_once("component/header.php");

    $unauthorized = !isset($_SESSION["ID"]);

    if ($unauthorized)
        header("location: login.php");
?>

<main>
    <h1 class="mt-8 mb-12 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
        <a href="insert_store_form.php">Insert A Store</a>
    </h1>

    <div class="flex items-center justify-center h-fit">
        <div class="w-full max-w-xl">
            <form action="insert_store.php" method=post class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="Bockbluster" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="dob">Address</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="address" name="address" type="text" placeholder="123 Street NW, Lethbridge, AB" required>
                </div>

                <div class="mb-12">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Phone number</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phone" name="phone" type="tel" placeholder="403-555-5555" required>
                </div>

                <div class="flex items-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type=submit name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php
    include_once("component/footer.php");
?>
