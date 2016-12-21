<script type="text/javascript">
    $(function() {

        $('select[name="fakultas_id"]').change(function() {

            $.getJSON("<?php echo site_url('rpc/get_jurusan_by_fakultas') ?>/" + $(this).val(), '', function(data) {
                $('#jurusan-box option:not(:first)').remove()

                $.each(data, function(i, o) {
                    $('<option value="'+o.id+'">'+o.name+'</option>').appendTo($('#jurusan-box'));
                });

            });

        });
    });
</script>
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
        <div class="left">
            <div>
                <label><?php echo _('Upload Foto Mahasiswa') ?></label>
                <div><img src="<?php echo data_url($image) ?>" width="300" height="" alt="" /></div>
                <input type="file" value="" name="image" />
            </div>
        </div>
        <div class="center">
            <div>
                <label class="mandatory">NIM</label>
                <input type="text" value="<?php echo set_value('username') ?>" name="username" />
            </div>
            <div>
                <label class="mandatory">Password</label><br>
                <input type="password" value="" name="password" style=" font-size: 1.2 em ;min-height: 20px;"/>
            </div>
            <div>
                <label class="mandatory"><?php echo _('Nama Mahasiswa') ?></label>
                <input type="text" value="<?php echo set_value('name') ?>" name="name" />
            </div>
            <div>
                <label class="mandatory"><?php echo _('Fakultas') ?></label>
                <?php echo form_dropdown('fakultas_id', $fakultas_options, array(), 'id="fakultas-box"') ?>
            </div>
            <div>
                <label class="mandatory"><?php echo _('Jurusan') ?></label>
                <?php echo form_dropdown('jurusan_id', $jurusan_options, array(), 'id="jurusan-box"') ?>
            </div>
            <div>
                <label class="mandatory"><?php echo _('Tahun Akademik') ?></label>
                <?php echo form_dropdown('year_data', $years) ?>
            </div>
        </div>
        <div class="right">
            <div>
                <label>Hak Akses</label>
                <?php echo form_dropdown('group', $group_items) ?>
            </div>
            <div>
                <label>Nama Universitas</label>
                <?php echo form_dropdown('org', $org_items) ?>
            </div>
            <div>
                <label>Agama</label>
                <?php echo form_dropdown('agama', $religion_items) ?>
            </div>
            <div>
                <label>Aktif</label>
                <?php echo xform_boolean('active') ?>
            </div>
            <div>
                <label><?php echo _('Alamat Mahasiswa') ?></label>
                <textarea rows="7" cols="40" name="address"><?php echo set_value('address') ?></textarea>
            </div>
        </div>
        <div>
            <?php echo form_submit('', 'Simpan') ?>
            <?php echo back_button() ?>
        </div>
    </fieldset>
</form>