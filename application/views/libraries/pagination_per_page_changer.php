<?php
/*
 * History
 * =======
 * (dd/mm/yyyy hh:mm) (name)
 * 06/07/2011 10:03   Andi Susilo
 *
 */
?>

<div class="page-changer">
    <span class="left">
        <?php echo l($self->per_page_changer_prefix) ?>
    </span>
    <ul>
        <?php foreach ($self->per_pages as $per_page): ?>
            <li <?php echo ($current_per_page == $per_page) ? 'class="selected"' : '' ?>><a href="<?php echo site_url($CI->uri->uri_string) ?>?per_page=<?php echo $per_page ?>"><?php echo $per_page ?></a></li>
        <?php endforeach ?>
    </ul>
</div>