<?php $title = 'Add ' . humanize($CI->_name) ?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="toolbar">
        <div class="middle">
            <h1><?php echo ( ($CI->uri->rsegments[2] == 'add') ? _('Add') : _('Edit') ) . ' ' . get_class($CI) ?></h1>
        </div>
    </div>

    <?php if (!empty($errors)): ?>
    <div class="error"><?php echo $errors ?></div>
    <?php endif ?>

    <fieldset class="two">
        <div>
            <label class="mandatory"><?php echo _('Nama Fakultas') ?></label>
            <input type="text" value="<?php echo set_value('name') ?>" name="name" />
        </div>
        <div>
            <label><?php echo _('Informasi') ?></label>
            <textarea rows="6" cols="40" name="informasi"><?php echo set_value('informasi') ?></textarea>
        </div>
        <div class="clear"></div>
    </fieldset>
    <div> 
        <input type="submit" name="" value="Simpan"  />
        <a href="<?php echo $nonce['referer']->url ?>" class="button">Kembali</a>
    </div>
</form>