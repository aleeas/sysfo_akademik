<?php echo $this->admin_panel->breadcrumb(array(
array( 'uri' => $CI->_get_uri('listing'), 'title' => humanize(get_class($CI)) ),
array( 'uri' => $CI->uri->uri_string, 'title' => 'Delete record'),
)) ?>

<div class="clear"></div>

<div class="info">
    <?php if (count($ids) > 1): ?>
    Yakin mau menghapus <?php echo count($ids) ?> buah record?
    <?php else: ?>
    Yakin mau dihapus?
    <?php endif ?>
</div>
<br/>
<a href="<?php echo site_url($CI->_get_uri('delete').'/'.$id.'?confirmed=1') ?>" class="button"><?php echo l('OK') ?></a>
<?php echo back_button() ?>