<?php $title = 'Detail ' . humanize($CI->_name) ?>

<form action="" method="post">
    <div class="toolbar">
        <div class="middle">
            <h1><?php echo $title ?></h1>
        </div>
    </div>

    <?php echo xview_error() ?>

    <fieldset class="two">
        <div class="left">
            <div>
                <label>Title</label>
                <input type="text" value="<?php echo set_value('title') ?>" name="title" />
            </div>

            <div>
                <label>URI</label>
                <input type="text" value="<?php echo set_value('uri') ?>" name="uri" />
            </div>
        </div>
        <div class="right">
            <div>
                <label>Parent</label>
                <?php echo form_dropdown('parent_id', $parent_options) ?>
                <div class="clear"></div>
            </div>
        </div>
    </fieldset>
    <div>
        <input type="submit" value="<?php echo l('Simpan') ?>" />
        <?php echo back_button() ?>
    </div>
</form>