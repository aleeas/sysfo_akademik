<?php if (!$CI->input->is_ajax_request()): ?>
    <div class="toolbar">
        <div class="middle">
            <h1>Daftar Mahasiswa</h1>
        </div>							
        <div class="left">
            <?php echo x_anchor($CI->_get_uri('delete'), l('Delete'), 'class="icon delete mass-action"') ?>
            <?php echo x_anchor($CI->_get_uri('add'), l('Tambah'), 'class="icon new"') ?>
        </div>
        <div class="right">
            <?php echo xview_filter($filter) ?>
        </div>
    </div>
<?php endif ?>
<?php $id = uniqid('listing_') ?>
<div id="<?php echo $id ?>">
    <?php echo $this->listing_grid->show($items) ?>
</div>

<?php if (!$CI->input->is_ajax_request()): ?>
    <div class="toolbar">
        <div class="left">
            <?php //echo $this->admin_panel->breadcrumb() ?>
        </div>
        <div class="right">
            <div class="pagination">
                <?php echo $this->pagination->create_links() ?>
            </div>
        </div>
    </div>
<?php endif ?>
<script type="text/javascript">
    $(function() {
        xn.helper.stylize('#<?php echo $id ?>');
    });
</script>
