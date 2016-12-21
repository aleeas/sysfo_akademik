<script type="text/javascript">
    $(function() {

        $('select[name="jurusan_id"]').change(function() {

            $.getJSON("<?php echo site_url('rpc/get_mahasiswa_by_jurusan') ?>/" + $(this).val(), '', function(data) {
                $('#mahasiswa-box option:not(:first)').remove()

                $.each(data, function(i, o) {
                    $('<option value="'+o.id+'">'+o.username+' - '+o.name+'</option>').appendTo($('#mahasiswa-box'));
                });

            });

        });

        $('select[name="jurusan_id"]').change(function() {

            $.getJSON("<?php echo site_url('rpc/get_matkul_by_jurusan') ?>/" + $(this).val(), '', function(data) {
                $('#matkul-box option:not(:first)').remove()

                $.each(data, function(i, o) {
                    $('<option value="'+o.id+'">'+'Semester '+o.semester+' - '+'('+o.code_matkul+') - '+o.name+'</option>').appendTo($('#matkul-box'));
                });

            });

        });

    });
</script>
<form action="" method="post" enctype="multipart/form-data">
    <div class="toolbar">
        <div class="middle">
            <h1><?php echo ( ($CI->uri->rsegments[2] == 'add') ? _('Tambah') : _('Edit') ) . ' ' . l(humanize($CI->_name)) ?></h1>
        </div>
    </div>
    <div>
        <?php echo xview_error() ?>
    </div>

    <fieldset class="three">
        <div class="center">
            <div>
                <label class="mandatory"><?php echo _('Jurusan Untuk Mahasiswa & Matkul') ?></label>
                <?php echo form_dropdown('jurusan_id', $jurusan_options, array(), 'id="jurusan-box"') ?>
            </div>
            <div>
                <label class="mandatory"><?php echo _('NIM & Nama Mahasiswa') ?></label>
                <?php echo form_dropdown('mahasiswa_id', $mahasiswa_options, array(), 'id="mahasiswa-box"') ?>
            </div>
        </div>
        <div class="right">
            <div>
                <label class="mandatory"><?php echo _('Kode & Mata Kuliah') ?></label>
                <?php echo form_dropdown('matkul_id', $matkul_options, array(), 'id="matkul-box"') ?>
            </div>
            <div>
                <label class="mandatory"><?php echo _('Nilai Matkul') ?></label>
                <?php echo form_dropdown('nilai_id', $nilai_options, array(), 'id="nilai-box"') ?>
            </div>
        </div>
    </fieldset>
    <div>
        <input type="submit" value="<?php echo l('Simpan') ?>" />
        <?php echo back_button() ?>
    </div>
</form>