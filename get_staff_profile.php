<?php $row = isset($profile) ?>

<?php if ($row): ?>
    <div class="grid grid-cols-4 mt-4 max-w-full" style="width:800px">
        <div class="col-start-1 col-span-1 font-bold">Staff ID</div>
        <div class="col-start-2 col-span-3"><?= $profile["ID"] ?></div>
    </div>

    <div class="grid grid-cols-4 mt-4 max-w-full" style="width:800px">
        <div class="col-start-1 col-span-1 font-bold">Store</div>
        <div class="col-start-2 col-span-3"><?= $profile["sname"] ?></div>
    </div>

    <div class="grid grid-cols-4 mt-4 max-w-full" style="width:800px">
        <div class="col-start-1 col-span-1 font-bold">Name</div>
        <div class="col-start-2 col-span-3"><?= $profile["name"] ?></div>
    </div>

    <div class="grid grid-cols-4 mt-4 max-w-full" style="width:800px">
        <div class="col-start-1 col-span-1 font-bold">Username</div>
        <div class="col-start-2 col-span-3"><?= $profile["username"] ?></div>
    </div>

    <div class="grid grid-cols-4 mt-4 max-w-full" style="width:800px">
        <div class="col-start-1 col-span-1 font-bold">Address</div>
        <div class="col-start-2 col-span-3"><?= $profile["address"] ?></div>
    </div>

    <div class="grid grid-cols-4 mt-4 max-w-full" style="width:800px">
        <div class="col-start-1 col-span-1 font-bold">Phone</div>
        <div class="col-start-2 col-span-3"><?= $profile["phone"] ?></div>
    </div>

    <div class="grid grid-cols-4 mt-4 max-w-full" style="width:800px">
        <div class="col-start-1 col-span-1 font-bold">Date of Birth</div>
        <div class="col-start-2 col-span-3"><?= $profile["dob"] ?></div>
    </div>

    <div class="grid grid-cols-4 mt-4 max-w-full" style="width:800px">
        <div class="col-start-1 col-span-1 font-bold">Wage</div>
        <div class="col-start-2 col-span-3"><?= $profile["wage"] ?></div>
    </div>

    <div class="grid grid-cols-4 mt-4 max-w-full" style="width:800px">
        <div class="col-start-1 col-span-1 font-bold">Hours</div>
        <div class="col-start-2 col-span-3"><?= $profile["hours"] ?></div>
    </div>

    <hr class="mt-8">

    <div class="grid grid-cols-2 place-items-center mt-8 max-w-full" style="width:800px">
        <a href="update_staff_form.php?ID=<?= $profile["ID"]; ?>">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
        </a>

        <a href="delete_staff.php?ID=<?= $profile["ID"]; ?>">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
        </a>
    </div>
<?php endif; ?>
