<?php $row = isset($customers); ?>

<?php if ($row): ?>
    <?php foreach($customers as $customer): ?>
        <li id="customer" class="py-1 hover:cursor-pointer hover:bg-blue-200"><?= $customer["name"]; ?></li>
    <?php endforeach; ?>
<?php endif; ?>
