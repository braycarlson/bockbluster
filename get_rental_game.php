<?php $row = isset($games); ?>

<?php if ($row): ?>
    <?php foreach($games as $game): ?>
        <li id="game" class="py-1 hover:cursor-pointer hover:bg-blue-200"><?= $game["name"]; ?></li>
    <?php endforeach; ?>
<?php endif; ?>
