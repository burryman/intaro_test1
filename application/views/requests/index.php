<h2><?php echo $title ?></h2>

<?php foreach ($request as $requests_item): ?>

        <h3><?php echo $requests_item['title'] ?></h3>
        <div class="main">
                <?php echo $requests_item['description'] ?>
        </div>
        <p><a href="<?php echo $requests_item['slug'] ?>">Посмотреть заявку</a></p>

<?php endforeach; ?>