<?php
    $title = "Update customer";

    include_once("connection.php");
    include_once "compatibility/fetch.php";
    include_once("component/header.php");

    $unauthorized = !isset($_SESSION["ID"]);

    if ($unauthorized)
        header("location: login.php");

    $CID = isset($_GET["CID"]);

    if ($CID) {
        $sql = "select * from CUSTOMER where CID=?";
        $statement = $connection->prepare($sql);
        $statement->bind_param("s", $_GET["CID"]);
        $statement->execute();
        $statement->store_result();

        $customer = fetch($statement);

        $membership = $customer["membership"] ? "checked" : "";
    } else {
        echo "Please enter a customer ID to update.";
        return;
    }

    include_once("component/footer.php");
?>

<main>
    <h1 class="mt-8 mb-12 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
        <a href="update_customer_form.php?CID=<?= $customer["CID"]; ?>"><?= $customer["name"]; ?></a>
    </h1>

    <div class="flex items-center justify-center h-fit">
        <div class="w-full max-w-xl">
            <form action="update_customer.php" method=post class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" value="<?= $customer["name"]; ?>" placeholder="John Doe" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="text" value="<?= $customer["email"]; ?>" placeholder="johndoe@example.com" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Phone number</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phone" name="phone" type="tel" value="<?= $customer["phone"]; ?>" placeholder="403-555-5555" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="address">Address</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="address" name="address" type="text" value="<?= $customer["address"]; ?>" placeholder="123 Street, NW, Lethbridge, AB" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="dob">Date of birth</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="dob" name="dob" type="date" value="<?= $customer["dob"]; ?>" placeholder="1975-01-01" required>
                </div>

                <div class="mb-12">
                    <div class="flex items-center">
                        <input id="membership" name="membership" type="checkbox" <?= $membership; ?> class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2">
                        <label for="membership" class="ml-2 text-gray-700 text-sm font-bold">Membership</label>
                    </div>
                </div>

                <input id="CID" name="CID" type=hidden value="<?= $customer["CID"]; ?>">

                <div class="flex items-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type=submit name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</main>
