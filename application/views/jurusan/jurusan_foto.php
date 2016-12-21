<!-- Block Gallery -->
<div id="picture" class="gallery">
    <h1><span>Foto</span>
        <?php if ($self == true): ?>
            <a href="<?php echo site_url('jurusan/edit_jurusan_foto') ?>" class="edit">Edit</a>
        <?php endif ?>
    </h1>
    <?php if (!@empty($main['url'])): ?>
        <div class="main"><a href="<?php echo data_url($main['url']) ?>" rel="gallery"><img src="<?php echo data_url($main['small_url']) ?>" alt="<?php $main['title'] ?>" width="280" height="209" title="<?php echo $main['title'] ?>" /></a></div>
    <?php else: ?>
        <div class="main"><a href="<?php echo data_url($CONFIG['jurusan']['default_picture']) ?>" rel="gallery"><img src="<?php echo data_url($CONFIG['jurusan']['default_picture']) ?>" alt="<?php echo $CONFIG['jurusan']['no_picture'] ?>" width="280" height="209" title="<?php echo $CONFIG['jurusan']['no_picture'] ?>" /></a></div>
    <?php endif ?>
    <div class="thumbnail">
        <ul class="list_flat">
            <?php foreach ($jurusan_fotos as $jurusan_foto): ?>
            <li><a href="<?php echo data_url($jurusan_foto['url']) ?>" rel="gallery"><img src="<?php echo data_url($jurusan_foto['thumb_url']) ?>" alt="<?php echo $jurusan_foto['title'] ?>" width="56" height="41" title="<?php echo $jurusan_foto['title'] ?>" /></a></li>
            <?php endforeach ?>
            
            <?php if (($count = $CONFIG['jurusan']['max_pictures'] - count($jurusan_fotos) - 1) > 0): ?>
                <?php for($i=0;$i<$count;$i++): ?>
                    <li><a href="<?php echo data_url($CONFIG['jurusan']['default_picture']) ?>" rel="gallery"><img src="<?php echo data_url($CONFIG['jurusan']['default_picture']) ?>" alt="<?php echo $CONFIG['jurusan']['no_picture'] ?>" width="56" height="41" title="<?php echo $CONFIG['jurusan']['no_picture'] ?>" /></a></li>
                <?php endfor ?>
            <?php endif ?>
        </ul>
    </div>
</div>