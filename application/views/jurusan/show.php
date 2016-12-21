<div>
    <?php echo xview_error() ?>
</div>

<form action="" method="post" enctype="multipart/form-data">
    <div class="toolbar">
        <div class="middle">
            <h1><?php echo ( ($CI->uri->rsegments[2] == 'add') ? _('Tambah') : _('Edit') ) . ' ' . get_class($CI) ?></h1>
        </div>
    </div>
    <fieldset class="three">
        <div class="left">
            <div>
                <i class="image-container data-image" style="background-image: url(<?php echo data_url($image) ?>);"></i>
                <div class="command-group">
                    <?php if (!empty($id)): ?>
                        <?php echo x_anchor('jurusan/edit_image/' . $id . '?nonce='.$nonce['nonce'], 'Tambah Foto-foto', 'class="button"') ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <div class="right">
            <div>
                <label class="mandatory"><?php echo _('Nama Jurusan') ?></label>
                <input type="text" value="<?php echo set_value('name') ?>" name="name"  />
            </div>
            <div>
                <label class="mandatory"><?php echo _('Fakultas') ?></label>
                <?php echo form_dropdown('fakultas_id', $fakultas_options) ?>
            </div>
            <div>
                <label class="mandatory"><?php echo _('Status Aktreditasi') ?></label>
                <?php echo xform_lookup('jurusan_status') ?>
            </div>
            <div>
                <label class="mandatory"><?php echo _('Jenjang') ?></label>
                <?php echo xform_lookup('jurusan_jenjang') ?>
            </div>
        </div>
        <div class="right">
            <div>
                <label class="mandatory"><?php echo _('Nama Kaprodi') ?></label>
                <input type="text" value="<?php echo set_value('kaprodi') ?>" name="kaprodi"  />
            </div>
            <div>
                <label><?php echo _('Tahun Berdiri Jurusan') ?></label>
                <?php echo form_dropdown('year_data', $years) ?>
            </div>
            <div>
                <label class="mandatory"><?php echo _('Alamat Situs Jurusan') ?></label>
                <input type="text" value="<?php echo set_value('web') ?>" name="web"  />
            </div>
            <div>
                <label><?php echo _('Informasi Jurusan') ?></label>
                <textarea rows="7" cols="40" name="informasi_jurusan"><?php echo set_value('informasi_jurusan') ?></textarea>
            </div>
        </div>
    </fieldset>
    <div>
        <input type="submit" value="<?php echo l('Simpan') ?>" />
        <?php echo back_button() ?>
    </div>
</form>
