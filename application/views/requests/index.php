<p><a href="<?php $this->load->helper('url'); echo base_url('requests/create') ?>">Оставить заявку</a></p>
<?php foreach ($request as $requests_item): ?>

        <h3><?php echo $requests_item['title'] ?></h3>
        <div class="main">
                <?php echo $requests_item['description'] ?>
        </div>
        <p><a href="<?php $this->load->helper('url'); echo base_url('requests/view/' . $requests_item['slug']) ?>">Посмотреть заявку</a></p>

<?php endforeach; ?>