<div class="toolbar">
    <div class="middle">
        <h1><?php echo _($fakultas['name']) ?></h1>
    </div>
</div>

<fieldset>
    <div>
        <label><?php echo _('Nama Fakultas') ?></label>
        <?php echo $fakultas['name'] ?>
    </div>
</fieldset>
<fieldset>
    <div>
        <label><?php echo _('Informasi Fakultas') ?></label>
        <?php echo $fakultas['informasi'] ?>
    </div>
</fieldset>
<div class="toolbar">
    <?php echo back_button() ?>
</div>