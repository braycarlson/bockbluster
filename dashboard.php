<?php
    $title = "Dashboard";

    include_once "connection.php";
    include_once "component/header.php";
    include_once "compatibility/fetch.php";

    $unauthorized = !isset($_SESSION["ID"]);

    if ($unauthorized)
        header("location: login.php");

    // Pagination
    $sql = "select * from CUSTOMER";
    $result = $connection->query($sql);
    $total = mysqli_num_rows($result);
    $limit = 10;
    $amount = ceil($total / $limit);

    // Fetch 10 per page
    $sql = "select * from CUSTOMER order by CID desc limit ?";
    $statement = $connection->prepare($sql);
    $statement->bind_param("s", $limit);
    $statement->execute();
    $statement->store_result();

    $customers = get($statement);
?>

<main>
    <h1 class="mt-8 mb-12 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
        <a href="dashboard.php">Dashboard</a>
    </h1>

    <div class="flex justify-center">
        <div class="mb-8 xl:w-96">
            <input type="search" id="customer_search" placeholder="Search" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding
            border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
        </div>
    </div>

    <div class="flex justify-evenly">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table id="customer" class="min-w-full">
                        <thead class="border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">name</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">phone</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">dob</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">membership</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">rental</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">history</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">edit</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php include_once("get_customer.php"); ?>
                        </tbody>
                    </table>

                    <div class="inline-flex justify-center gap-1 min-w-full mb-8 mt-12">
                        <a href="#" id="previous_customer" class="inline-flex h-8 w-8 items-center justify-center rounded border border-gray-100">
                            <span class="sr-only">previous page</span>

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd">
                            </svg>
                        </a>

                        <div>
                            <label class="sr-only">Page</label>
                            <input type="number" id="counter" class="h-8 w-12 rounded border border-gray-100 p-0 text-center text-xs font-medium [-moz-appearance:_textfield] [&::-webkit-outer-spin-button]:m-0 [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:m-0 [&::-webkit-inner-spin-button]:appearance-none" value="1" readonly disabled>
                        </div>

                        <a href="#" id="next_customer" class="inline-flex h-8 w-8 items-center justify-center rounded border border-gray-100">
                            <span class="sr-only">next page</span>

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd">
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex space-x-2 justify-center mt-8 mb-24">
        <a href="insert_customer_form.php">Insert</a>
    </div>
</main>

<?php
    include_once("component/footer.php");
?>
