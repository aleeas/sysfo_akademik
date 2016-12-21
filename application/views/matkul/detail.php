<fieldset class="three">
    <div class="center">
        <div>
            <label><?php echo _('Kode Matkul') ?></label>
            <?php echo $matkul['code_matkul'] ?>
        </div>
        <div>
            <label><?php echo _('Nama Matkul') ?></label>
            <?php echo $matkul['name'] ?>
        </div>
        <div>
            <label><?php echo _('Matkul Untuk Jurusan') ?></label>
            <?php echo $matkul['jurusan_name'] ?>
        </div>
        <div>
            <label><?php echo _('Jumlah SKS') ?></label>
            <?php echo $matkul['sks_id'].' SKS' ?>
        </div>
         <div>
            <label><?php echo _('Nama Dosen Pengajar') ?></label>
            <?php echo $matkul['dosen_name'] ?>
        </div>
    </div>
</fieldset>
<div class="toolbar">
    <div class="middle">
        <?php echo back_button() ?>
    </div>
</div>