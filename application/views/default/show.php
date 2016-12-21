<?php if (!empty($id)): ?>
    <?php $title = 'Rubah ' . humanize(get_class($CI)) ?>
<?php else: ?>
    <?php $title = 'Tambah ' . humanize(get_class($CI)) ?>
<?php endif ?>

<?php if ($CI->input->is_ajax_request()): ?>
    <?php
    echo $this->admin_panel->breadcrumb(array(
    array('uri' => $CI->_get_uri($CI->uri->rsegments[2]), 'title' => humanize(get_class($CI))),
    array('uri' => $CI->uri->uri_string, 'title' => $title),
    ))
    ?>
<?php else: ?>
<h3><?php echo $title ?></h3>
<?php endif ?>
<div class="clear"></div>

<div class="container-show">
    <form action="<?php echo current_url() ?>" method="post" class="ajaxform">
        <?php if (!empty($errors)): ?>
        <div class="error">
                <?php echo $errors ?>
        </div>
        <?php endif ?>
        <fieldset>
            <?php foreach ($field_data as $field): ?>
                <?php if (!$CI->_is_generated($field->name)): ?>
            <div>
                <label><?php echo humanize($field->name) ?></label>
                        <?php if ($field->type == 'int'): ?>
                <input type="text" value="<?php echo set_value($field->name) ?>" name="<?php echo $field->name ?>" class="number" <?php if (empty($next)) {
                                $next = true;
                echo '  ';
                            } ?> />
        <?php else: ?>
                <input type="text" value="<?php echo set_value($field->name) ?>" name="<?php echo $field->name ?>" <?php if (empty($next)) {
                            $next = true;
                echo '  ';
            } ?> />
                        <?php endif ?>
            </div>
    <?php endif ?>
<?php endforeach ?>
            <div>
                <label>Active</label>
<?php echo xform_boolean('active') ?>
            </div>
        </fieldset>
        <div>
            <input type="submit" value="<?php echo l('Simpan') ?>" />
<?php echo back_button() ?>
        </div>
    </form>
</div>
