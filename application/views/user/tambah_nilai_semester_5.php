<form action="" method="post" enctype="multipart/form-data">
    <div class="toolbar">
        <div class="middle">
            <h1>Tambah Nilai Semester 5 (Lima)</h1>
        </div>
    </div>
    <div>
        <?php echo xview_error() ?>
    </div>

    <fieldset class="three">
        <div class="center">
            <div>
                <label><?php echo _('NIM Mahasiswa') ?></label>
                <?php echo $user['username'] ?>
            </div>
            <div>
                <label><?php echo _('Nama Mahasiswa') ?></label>
                <?php echo $user['name'] ?>
            </div>
            <div>
                <label><?php echo _('Jurusan Mahasiswa') ?></label>
                <?php echo $user['fakultas_name'].' '.$user['jurusan_name'] ?>
            </div>
        </div>
        <div class="right">
            <div>
                <label><?php echo _('Kode & Matkul ').$user['jurusan_name'] ?></label>
                <?php echo form_dropdown('matkul_id', $matkul_options, array(), 'id="matkul-box"') ?>
            </div>
            <div>
                <label><?php echo _('Nilai Matkul') ?></label>
                <?php echo form_dropdown('nilai_id', $nilai_options, array(), 'id="nilai-box"') ?>
            </div>
        </div>
    </fieldset>
    <div>
        <input type="submit" value="<?php echo l('Simpan') ?>" />
        <?php echo back_button() ?>
    </div>
</form>