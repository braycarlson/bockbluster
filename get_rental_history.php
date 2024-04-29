<?php $row = isset($history) ?>

<?php if ($row): ?>
    <?php foreach($history as $rental): ?>
        <?php
            $query = "name=" . urlencode($rental["name"]) . "&CID=" . $rental["CID"] . "&SID=" . $rental["SID"];
        ?>

        <tr class="<?= $color ?> border-b">
            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><?= $rental["name"]; ?></td>
            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><?= $rental["CID"]; ?></td>
            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><?= $rental["SID"]; ?></td>
            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><?= $rental["rented"]; ?></td>

            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                <a href="delete_rental.php?<?= $query ?>">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 11l3-3m0 0l3 3m-3-3v8m0-13a9 9 0 110 18 9 9 0 010-18z"></path>
                    </svg>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <div>
        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">No rental(s) found.</td>
    </div>
<?php endif; ?>
