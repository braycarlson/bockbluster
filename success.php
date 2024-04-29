<?php
    $title = "Success";
    include_once "component/head.php";

    if ($_GET)
    {
        $is_location = isset($_GET["location"]);
        $is_message = isset($_GET["message"]);

        $location = $is_location ? $_GET["location"] : "";
        $message = $is_message ? $_GET["message"] : "";
    }
?>

<div class="flex items-center justify-center h-screen">
    <div>
        <div class="flex flex-col items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="text-green-600 w-28 h-28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>

            <h1 class="my-2 text-4xl font-bold">Success!</h1>

            <p class="mb-6"><?= $message ?></p>

            <button onclick="history.back()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 rounded focus:outline-none focus:shadow-outline px-10">Go back</button>
        </div>
    </div>
</div>

<?php
    if ($is_location)
        header("refresh:1; url=" . $location);
?>
