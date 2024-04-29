<?php
    $title = "Get store";

    include_once "connection.php";
    include_once "component/header.php";
    include_once "compatibility/fetch.php";

    $unauthorized = !isset($_SESSION["ID"]);

    if ($unauthorized)
        header("location: login.php");

    $ID = $_SESSION["ID"];

    $sql = "select SID, name from STORE";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $statement->store_result();

    $stores = get($statement);
?>

<?php
    $row = isset($stores);
    $authorized = isset($_SESSION["ID"]);
?>

<main>
    <section>
        <h1 class="mt-8 mb-12 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
            <a href="get_store.php">Store</a>
        </h1>

        <div class="flex items-center justify-center">
            <div class="p-6 rounded-lg shadow-lg bg-white w-full max-w-xl min-h-full max-h-fit h-1/2">
                <?php if ($row): ?>
                    <form id="stores" method="get" action="fetch_store.php" class="mb-8">
                        <select id="store" name="store" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option selected disabled hidden></option>
                            <?php foreach($stores as $store): ?>
                                <option value=<?= $store["SID"]; ?>><?= $store["name"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                <?php endif; ?>

                <div id="profile">
                    <?php include_once("get_store_profile.php"); ?>
                </div>
            </div>
        </div>

        <div class="flex space-x-2 justify-center mt-8 mb-32">
            <a href="insert_store_form.php">Insert</a>
        </div>
    </section>
</main>
