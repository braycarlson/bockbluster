<?php
    $title = "Login";

    include_once("connection.php");
    include_once("component/header.php");

    $authorized = isset($_SESSION["ID"]);

    if ($authorized)
        header("location: dashboard.php");
?>

<main>
    <h1 class="mt-8 mb-12 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
        <a href="login.php">Login</a>
    </h1>

    <div class="flex items-center justify-center h-fit">
        <div class="p-6 rounded-lg shadow-lg bg-white w-full max-w-sm">
            <form action="authorization.php" method=post>
                <div class="form-group mb-6">
                    <label for="username" class="form-label inline-block mb-2 text-gray-700">Username</label>
                    <input id="username" name="username" type="username" placeholder="Username" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                </div>

                <div class="form-group mb-6">
                    <label for="password" class="form-label inline-block mb-2 text-gray-700">Password</label>
                    <input id="password" name="password" type="password" placeholder="Password" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                </div>

                <div class="flex justify-between items-center mb-6">
                    <div class="form-group form-check">
                        <input id="checkbox" type="checkbox" class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain cursor-pointer">
                        <label for="checkbox" class="mr-4 form-check-label inline-block text-gray-800">Remember me</label>
                    </div>

                    <a href="#" class="text-blue-600 hover:text-blue-700 focus:text-blue-700 transition duration-200 ease-in-out">Forgot password?</a>
                </div>

                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline px-10">Sign in</button>
            </form>
        </div>
    </div>
</main>

<?php
    include_once("component/footer.php");
?>
