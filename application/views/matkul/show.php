<form action="" method="post" enctype="multipart/form-data">
    <div class="toolbar">
        <div class="middle">
            <h1><?php echo ( ($CI->uri->rsegments[2] == 'add') ? _('Tambah') : _('Edit') ) . ' ' . get_class($CI) ?></h1>
        </div>
    </div>
    <div>
        <?php echo xview_error() ?>
    </div>

    <fieldset class="three">
        <div class="center">
            <div>
                <label class="mandatory"><?php echo _('Kode Matkul') ?></label>
                <input type="text" value="<?php echo set_value('code_matkul') ?>" name="code_matkul" />
            </div>
            <div>
                <label class="mandatory"><?php echo _('Nama Matkul') ?></label>
                <input type="text" value="<?php echo set_value('name') ?>" name="name" />
            </div>
            <div>
                <label class="mandatory"><?php echo _('Untuk Jurusan') ?></label>
                <?php echo form_dropdown('jurusan_id', $jurusan_options, array(), 'id="jurusan-box"') ?>
            </div>
        </div>
        <div class="right">
            <div>
                <label class="mandatory"><?php echo _('Jumlah SKS') ?></label>
                <?php echo form_dropdown('sks_id', $sks_options, array(), 'id="sks-box"') ?>
            </div>
            <div>
                <label class="mandatory"><?php echo _('Matkul Untuk Semester') ?></label>
                <?php echo xform_lookup('semester') ?>
            </div>
            <div>
                <label><?php echo _('Nama Dosen Pengajar') ?></label>
                <input type="text" value="<?php echo set_value('dosen_name') ?>" name="dosen_name" />
            </div>
        </div>
    </fieldset>
    <div>
        <input type="submit" value="<?php echo l('Simpan') ?>" />
        <?php echo back_button() ?>
    </div>
</form>