<?php $title = 'Detail ' . humanize($CI->_name) ?>
<form action="" method="post">
    <div class="toolbar">
        <div class="middle">
            <h1><?php echo $title ?></h1>
        </div>
    </div>

    <fieldset class="two">
        <?php if (!empty($errors)): ?>
        <div class="error"><?php echo $errors ?></div>
        <?php endif ?>
        <?php $i = 1 ?>
        <?php foreach ($field_data as $field): ?>
            <?php if (!$CI->_is_generated($field->name)): ?>
        <div class="<?php echo ($i++ % 2) ? 'left' : 'right' ?>">
            <div>
                <label><?php echo humanize($field->name) ?></label>
                        <?php if ($field->type == 'int'): ?>
                <input type="text" value="<?php echo set_value($field->name) ?>" name="<?php echo $field->name ?>" class="number" />
                        <?php else: ?>
                <input type="text" value="<?php echo set_value($field->name) ?>" name="<?php echo $field->name ?>" />
                        <?php endif ?>
            </div>
        </div>
            <?php endif ?>
        <?php endforeach ?>

    </fieldset>
</form>

<div>
    <input type="submit" value="<?php echo l('Simpan') ?>" />
    <?php echo back_button() ?>
</div>
