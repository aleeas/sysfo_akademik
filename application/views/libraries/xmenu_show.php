<?php $id = '' ?>
<?php $class_name = '' ?>

<?php if ($menus[0]['parent_id'] == 0): ?>
    <?php $id = uniqid('menu_') ?>
    <?php $class_name = 'menu' ?>
<script type="text/javascript">
    $.fn.menu = function() {};
    $(function() {
        $('#<?php echo $id ?>').menu();
    });
</script>
<?php endif ?>

<ul class="<?php echo $class_name ?>" id="<?php echo $id ?>">
    <?php foreach ($menus as $menu): ?>
    <li <?php echo (empty($menu['children'])) ? '' : ' class="has-children" ' ?>>
        <a href="<?php echo ($menu['uri']) ? site_url($menu['uri']) : site_url($menu['children'][0]['uri']) ?>"><?php echo l($menu['title']) ?></a>
            <?php if (!empty($menu['children'])): ?>
                <?php echo $self->_get_menu($menu['children']); ?>
            <?php endif ?>
    </li>
    <?php endforeach ?>
</ul>