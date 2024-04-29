<?php
    $title = "Insert staff";

    include_once("connection.php");
    include_once "compatibility/fetch.php";
    include_once("component/header.php");

    $unauthorized = !isset($_SESSION["ID"]);

    if ($unauthorized)
        header("Location: login.php");

    $sql = "select name, SID from STORE";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $statement->store_result();

    $stores = get($statement);

    $row = isset($stores);
?>

<main>
    <h1 class="mt-8 mb-12 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
        <a href="insert_staff_form.php">Insert A Staff Member</a>
    </h1>

    <div class="flex items-center justify-center h-fit">
        <div class="w-full max-w-xl">
            <form action="insert_staff.php" method=post class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <?php if ($row): ?>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="SID">Store</label>
                        <select id="SID" name="SID" class="py-2 px-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            <option selected disabled hidden></option>
                            <?php foreach($stores as $store): ?>
                                <option value=<?= $store["SID"]; ?>><?= $store["name"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="John Doe" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Username</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" name="username" type="text" placeholder="johndoe" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password" type="password" placeholder="Password" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="dob">Address</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="address" name="address" type="text" placeholder="123 Street NW, Lethbridge, AB" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Phone number</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phone" name="phone" type="tel" placeholder="403-555-5555" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="dob">Date of Birth</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="dob" name="dob" type="date" placeholder="1975-01-01" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="wage">Wage</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="wage" name="wage" type="text" placeholder="14.00" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="hours">Hours</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="hours" name="hours" type="text" placeholder="8" required>
                </div>

                <div class="mb-12">
                    <div class="flex items-center">
                        <input id="manager" name="manager" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500">
                        <label for="manager" class="ml-2 text-gray-700 text-sm font-bold">Manager</label>
                    </div>
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
