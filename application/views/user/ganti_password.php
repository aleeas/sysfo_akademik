<form action="" method="post" enctype="multipart/form-data">
    <div class="toolbar">
        <div class="middle">
            <h1>Ganti Password</h1>
        </div>
    </div>
    <div>
        <?php echo xview_error() ?>
    </div>
    <fieldset class="three">
        <div class="right">
        </div>
        <div class="center">
            <div>
                <label>Nama Mahasiswa</label>
                <?php echo $user['name'] ?>
            </div>
            <div>
                <label>NIM Login</label>
                <?php echo $user['username'] ?>
            </div>
            <div>
                <label class="mandatory">Masukkan Password Baru</label>
                <input type="password" value="" name="password" style="width: 348px; font-size: 1.2 em ;min-height: 20px;"/>
            </div>
        </div>
        <div class="clear"></div>
        <div>
            <?php echo form_submit('', 'Simpan') ?>
            <?php echo back_button() ?>
        </div>
    </fieldset>
</form>