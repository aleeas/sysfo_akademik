<div class="filter-container">
    <form action="" method="post">
        <div class="search">
            <input type="text" name="q" value="<?php echo (isset($filter['q'])) ? $filter['q'] : '' ?>" />
            <a href="?q=">Clear</a>
        </div>
        <?php echo $extra ?>
    </form>
</div>