<fieldset class="three">        
    <div  class="left">
        <h1><?php echo _('Jurusan ') ?><?php echo $jurusan['name'] ?></h1>
        <div class="center">
            <?php echo image_slideshow($images) ?>

            <div class="command-group">
                <?php echo x_anchor('jurusan/edit/' . $jurusan['id'], 'Edit Jurusan', 'class="button"') ?>
            </div>
        </div>
    </div>
    <div class="center">                                    
        <div>
            <label><?php echo _('Nama Jurusan') ?></label>
            <?php echo $jurusan['name'] ?>
        </div>
        <div>
            <label><?php echo _('Fakultas') ?></label>
            <?php echo $jurusan['fakultas_name'] ?>
        </div>
        <div>
            <label><?php echo _('Status Aktreditasi') ?></label>
            <?php echo format_param_short($jurusan['jurusan_status'], 'jurusan_status') ?>
        </div>
        <div>
            <label><?php echo _('Jenjang') ?></label>
            <?php echo format_param_short($jurusan['jurusan_jenjang'], 'jurusan_jenjang') ?>
        </div>   
    </div>
    <div class="right">
        <div>
            <label><?php echo _('Nama Kaprodi Jurusan') ?></label>
            <?php echo $jurusan['kaprodi'] ?>
        </div>
        <div>
            <label><?php echo _('Alamat Situs Jurusan') ?></label>
            <a href="<?php echo $jurusan['web'] ?>" target="_blank"><?php echo $jurusan['web'] ?></a>
        </div>
        <div>
            <label><?php echo _('Informasi Jurusan') ?></label>
            <?php echo $jurusan['informasi_jurusan'] ?>
        </div>
    </div>
</fieldset>
<fieldset>
    <legend><?php echo _('Daftar Mahasiswa Jurusan ') ?><?php echo $jurusan['name'] ?></legend>
    <div>
        <?php echo $this->mahasiswa_list->show($mahasiswa_items) ?>
    </div>    
</fieldset>

<div class="toolbar">
    <div class="middle">
        <a href="javascript:history.back()" class="button"><?php echo _('Back') ?></a>
    </div>
</div>
