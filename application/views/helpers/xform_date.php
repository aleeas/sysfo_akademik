<?php $id = uniqid('date_') ?>
<div id="<?php echo $id ?>">
    <input type="text" class="date" value="<?php echo mysql_to_human(set_value($name)) ?>" />
    <input type="hidden" class="hidden-val" value="<?php echo set_value($name) ?>" name="<?php echo $name ?>" />
</div>