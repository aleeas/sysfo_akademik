<?php $title = 'Detail ' . humanize(get_class($CI)) ?>

<?php
echo $this->admin_panel->breadcrumb(array(
    array('uri' => $CI->_get_uri($CI->uri->rsegments[2]), 'title' => humanize(get_class($CI))),
    array('uri' => $CI->uri->uri_string, 'title' => $title),
))
?>

<div class="clear"></div>
<h3><?php echo $title ?></h3>

<div class="clear"></div>

<div class="container-show">
    <fieldset>
        <?php foreach ($field_data as $field): ?>
            <?php if (!$CI->_is_generated($field->name)): ?>
                <div class="clear" style="min-height: 30px;">
                    <label><?php echo humanize($field->name) ?></label>
                    <span><?php echo $data[$field->name] ?></span>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    </fieldset>
</div>