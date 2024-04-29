<?php
    $title = "Insert customer";

    include_once("connection.php");
    include_once("component/header.php");

    $unauthorized = !isset($_SESSION["ID"]);

    if ($unauthorized)
        header("location: login.php");
?>

<main>
    <h1 class="mt-8 mb-12 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
        <a href="insert_customer_form.php">Insert A Customer</a>
    </h1>

    <div class="flex items-center justify-center h-fit">
        <div class="w-full max-w-xl">
            <form action="insert_customer.php" method=post class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="John Doe" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="text" placeholder="johndoe@example.com" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Phone number</label>
                    <input class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="phone" name="phone" type="tel" placeholder="403-555-5555" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="address">Address</label>
                    <input class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="address" name="address" type="text" placeholder="123 Street, NW, Lethbridge, AB" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="dob">Date of birth</label>
                    <input class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="dob" name="dob" type="date" placeholder="1975-01-01" required>
                </div>

                <div class="mb-12">
                    <div class="flex items-center">
                        <input id="membership" name="membership" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500">
                        <label for="membership" class="ml-2 text-gray-700 text-sm font-bold">Membership</label>
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
