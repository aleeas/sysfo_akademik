<style>
    fieldset.dashboard { text-align: center; }
    fieldset.dashboard .coloum1 { width: 25%; float: left; text-align: center; }
    fieldset.dashboard .coloum2 { width: 25%; float: left; text-align: center; }
    fieldset.dashboard .coloum3 { width: 25%; float: left; text-align: center; }
    fieldset.dashboard .coloum4 { width: 25%; float: left; text-align: center; }
</style>
<div id="scrolling-text">
            <h3 style="text-align: center">
                Selamat datang di Sistem Informasi Nilai IPS & IPK Online -
				STIKES KESOSI
            </h3>
</div>
<br><br>
<fieldset class="dashboard">
    <div class="coloum1" >  
        <div class="left">
            <div><a href="<?php echo site_url('fakultas/listing') ?>"><img src="<?php echo theme_url('images/icons/fakultas.png') ?>" width="150" height="150" alt="" /></a></div>
            <a class="button" href="<?php echo site_url('fakultas/listing') ?>"><?php echo _('Fakultas') ?></a>
        </div>
    </div>
    <div class="coloum2">
        <div class="left">
            <div><a href="<?php echo site_url('jurusan/listing') ?>"><img src="<?php echo theme_url('images/icons/jurusan.png') ?>" width="150" height="150" alt="" /></a></div>
            <a class="button" href="<?php echo site_url('jurusan/listing') ?>"><?php echo _('Jurusan') ?></a>
        </div>
    </div>
    <div class="coloum3">
        <div class="left">
            <div><a href="<?php echo site_url('user/listing') ?>"><img src="<?php echo theme_url('images/icons/mahasiswa.png') ?>" width="150" height="150" alt="" /></a></div>
            <a class="button" href="<?php echo site_url('user/listing') ?>"><?php echo _('Mahasiswa') ?></a>
        </div>
    </div>
    <div class="coloum4">
        <div class="left">
            <div><a href="<?php echo site_url('matkul/listing') ?>"><img src="<?php echo theme_url('images/icons/matkul.png') ?>" width="150" height="150" alt="" /></a></div>
            <a class="button" href="<?php echo site_url('matkul/listing') ?>"><?php echo _('Matkul') ?></a>
        </div>
    </div>    
</fieldset>