<?php if (!$this->input->is_ajax_request()): ?>
    <div class="header">
        <div class="left">
            <?php echo $this->admin_panel->breadcrumb() ?>
        </div>
        <div class="right">
            <?php echo x_anchor($CI->_get_uri('import') . '/csv', 'Import', 'class="button msgbox"') ?>
            <?php echo x_anchor($CI->_get_uri('add'), 'Tambah', 'class="button msgbox"') ?>
        </div>
        <div class="clear"></div>
    </div>

    <div class="grid-top">
        <div class="left">
            <?php echo x_anchor($CI->_get_uri('delete'), 'Delete', 'class="button msgbox mass-action"') ?>
        </div>
        <div class="right">
            <?php echo xview_filter($filter) ?>
        </div>
        <div class="clear"></div>
    </div>
<?php endif ?>

<?php echo $this->listing_grid->show($items) ?>

<?php if (!$this->input->is_ajax_request()): ?>
    <div class="grid-bottom">
        <div class="left">
            <?php echo $this->pagination->per_page_changer() ?>
        </div>
        <div class="pagination">
            <?php echo $this->pagination->create_links() ?>
        </div>
        <div class="clear"></div>
    </div>
<?php endif ?>
