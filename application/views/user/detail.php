<fieldset class="three">
    <div class="left">
        <h1><?php echo _('Foto Mahasiswa') ?></h1>
        <div class="center">
            <img style="box-shadow: #333 0px 0px 8px; -moz-box-shadow: #333 0px 0px 8px; -webkit-box-shadow: #333 0px 0px 8px; border-radius: 2px; -moz-border-radius: 2px; -webkit-border-radius: 2px;" width="300" height="" src="
                 <?php if(!empty($user['image'])): ?>
                     <?php echo data_url($user['image']) ?>
                 <?php else: ?>
                     <?php echo data_url().'default/default.png' ?>
                 <?php endif ?>
                 " /></div>
        <div class="command-group">
            <?php echo x_anchor('user/edit/' . $user['id'], 'Edit Mahasiswa', 'class="button"') ?>
            <?php echo x_anchor('user/download_pdf/' . $user['id'], 'Cetak Nilai ke PDF', 'class="button"') ?>
        </div>
    </div>
    <div class="center">
        <div>
            <label><?php echo _('NIM') ?></label>
            <?php echo $user['username'] ?>
        </div>
        <div>
            <label><?php echo _('Nama Mahasiswa') ?></label>
            <?php echo $user['name'] ?>
        </div>
        <div>
            <label><?php echo _('Fakultas') ?></label>
            <?php echo $user['fakultas_name'] ?>
        </div>
        <div>
            <label><?php echo _('Jurusan') ?></label>
            <?php echo $user['jurusan_name'] ?>
        </div>
    </div>
    <div class="right">
        <div>
            <label><?php echo _('Tahun Akademik') ?></label>
            <?php echo $user['year_data'] ?>
        </div>
        <div>
            <label><?php echo _('Alamat Mahasiswa') ?></label>
            <?php echo $user['address'] ?>
        </div>
    </div>
</fieldset>


<legend><?php echo _('Daftar Nilai ') ?><?php echo $user['name'] ?></legend>
<br>

<fieldset>
    <legend><?php echo _('Semester 1 (Satu)') ?></legend>
    <div class="toolbar">
        <div class="left">
            <a href="<?php echo site_url('user/tambah_nilai_semester_1'.'/'.$user['id'])?>" class="button">Tambah Nilai</a>
        </div>
    </div>

    <div>
        <?php echo $this->nilai_semester_1_list->show($nilai_semester1_items) ?>
    </div>
</fieldset>
<fieldset>
    <legend><?php echo _('Semester 2 (Dua)') ?></legend>
    <div class="toolbar">
        <div class="left">
            <a href="<?php echo site_url('user/tambah_nilai_semester_2'.'/'.$user['id'])?>" class="button">Tambah Nilai</a>		</div>
    </div>
    <div>
        <?php echo $this->nilai_semester_2_list->show($nilai_semester2_items) ?>
    </div>
</fieldset>
<fieldset>
    <legend><?php echo _('Semester 3 (Tiga)') ?></legend>
    <div class="toolbar">
        <div class="left">
            <a href="<?php echo site_url('user/tambah_nilai_semester_3'.'/'.$user['id'])?>" class="button">Tambah Nilai</a>		</div>
    </div>
    <div>
        <?php echo $this->nilai_semester_3_list->show($nilai_semester3_items) ?>
    </div>
</fieldset>
<fieldset>
    <legend><?php echo _('Semester 4 (Satu)') ?></legend>
    <div class="toolbar">
        <div class="left">
            <a href="<?php echo site_url('user/tambah_nilai_semester_4'.'/'.$user['id'])?>" class="button">Tambah Nilai</a>		</div>
    </div>
    <div>
        <?php echo $this->nilai_semester_4_list->show($nilai_semester4_items) ?>
    </div>
</fieldset>
<fieldset>
    <legend><?php echo _('Semester 5 (Satu)') ?></legend>
    <div class="toolbar">
        <div class="left">
            <a href="<?php echo site_url('user/tambah_nilai_semester_5'.'/'.$user['id'])?>" class="button">Tambah Nilai</a>		</div>
    </div>
    <div>
        <?php echo $this->nilai_semester_5_list->show($nilai_semester5_items) ?>
    </div>
</fieldset>
<fieldset>
    <legend><?php echo _('Semester 6 (Satu)') ?></legend>
    <div class="toolbar">
        <div class="left">
            <a href="<?php echo site_url('user/tambah_nilai_semester_6'.'/'.$user['id'])?>" class="button">Tambah Nilai</a>		</div>
    </div>
    <div>
        <?php echo $this->nilai_semester_6_list->show($nilai_semester6_items) ?>
    </div>
</fieldset>
<fieldset>
    <legend><?php echo _('Semester 7 (Tujuh)') ?></legend>
    <div class="toolbar">
        <div class="left">
            <a href="<?php echo site_url('user/tambah_nilai_semester_7'.'/'.$user['id'])?>" class="button">Tambah Nilai</a>		</div>
    </div>
    <div>
        <?php echo $this->nilai_semester_7_list->show($nilai_semester7_items) ?>
    </div>
</fieldset>
<fieldset>
    <legend><?php echo _('Semester 8 (Delapan)') ?></legend>
    <div class="toolbar">
        <div class="left">
            <a href="<?php echo site_url('user/tambah_nilai_semester_8'.'/'.$user['id'])?>" class="button">Tambah Nilai</a>		</div>
    </div>
    <div>
        <?php echo $this->nilai_semester_8_list->show($nilai_semester8_items) ?>
    </div>
</fieldset>
<div class="toolbar">
    <div class="middle">
        <?php echo back_button() ?>
    </div>
</div>
