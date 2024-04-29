<?php
    $row = isset($games);
    $authorized = isset($_SESSION["ID"]);
?>

<input type="hidden" id="page" name="page" value="<?= isset($page) ? $page : 1; ?>">
<input type="hidden" id="amount" name="amount" value="<?= isset($amount) ? $amount : 2; ?>">

<?php if ($row): ?>
    <?php foreach($games as $game): ?>
        <div class="lg:w-1/2 sm:w-100 p-4">
            <div class="flex border-4 border-gray-200">
                <img class="boxart" src="<?= $game["image"]; ?>">

                <div class="px-8 py-10 z-10 w-full relative">
                    <h2 class="tracking-widest text-sm title-font font-medium text-indigo-500 mb-4"><?= $game["developer"]; ?></h2>

                    <h1 class="title-font text-lg font-medium text-gray-900 mb-3"><?= $game["name"]; ?></h1>

                    <p class="mb-50 invisible md:visible text-sm"><?= substr($game["overview"], 0, 500) . "..."; ?></p>

                    <p class="mt-4 text-sm text-neutral-400"><?= $game["year_released"]; ?>, <?= $game["genre"]; ?></p>

                    <div class="absolute bottom-8 left-1/2 right-1/2 flex justify-center items-center">
                        <?php if ($authorized): ?>
                            <div>
                                <a href="update_game_form.php?name=<?= urlencode($game["name"]); ?>">
                                    <button>
                                        <svg class="inline w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                </a>
                            </div>

                            <div>
                                <a href="insert_rental_form.php?name=<?= urlencode($game["name"]); ?>">
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline px-10 mx-10">Rent</button>
                                </a>
                            </div>

                            <div>
                                <a href="delete_game.php?name=<?= urlencode($game["name"]); ?>">
                                    <button>
                                        <svg class="inline w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div>
        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">No game(s) found.</td>
    </div>
<?php endif; ?>
