<?php $row = isset($customers) ?>

<input type="hidden" id="page" name="page" value="<?= isset($page) ? $page : 1; ?>">
<input type="hidden" id="amount" name="amount" value="<?= isset($amount) ? $amount : 2; ?>">

<?php if ($row): ?>
    <?php foreach($customers as $customer): ?>
        <tr class="bg-white border-b">
            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><?= $customer["name"]; ?></td>
            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><?= $customer["phone"]; ?></td>
            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><?= $customer["dob"]; ?></td>

            <?php if ($customer["membership"]): ?>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg></td>
            <?php else: ?>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg></td>
            <?php endif; ?>

            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><a href="insert_rental_form.php?CID=<?= $customer["CID"]; ?>"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"></path></svg></a></td>
            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><a href="rental_history.php?CID=<?= $customer["CID"]; ?>"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg></td>
            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><a href="update_customer_form.php?CID=<?= $customer["CID"]; ?>"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></a></td>
            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><a href="delete_customer.php?CID=<?= $customer["CID"]; ?>"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></a></td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <div>
        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">No customer(s) found.</td>
    </div>
<?php endif; ?>
