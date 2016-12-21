<?php

function get_region_map($region, $type = 'thumb') {
    if (empty($region)) {
        return '';
    }

    if (!is_array($region)) {
        $CI = &get_instance();
        $region = $CI->db->query('SELECT * FROM region WHERE id = ?', array($region))->row_array();
    }

    $e = explode('/', $region['map']);
    return $e[0] . '/' . $e[1] . '/' . $type . '/' . $e[2];
}

function image_slideshow($images) {
    $CI = &get_instance();
    $module = $CI->uri->rsegments[1];
    $id = $CI->uri->rsegments[3];
    ?>
    <style>
        .image-show {
            width:300px; margin: 0px auto;
        }
    </style>
    <script>
        $(function() {
            $('.image-show').each(function(i, o) {
                $(o).find('i:not(:first):not(:last)').addClass('small-left');
                $(o).find('i:last').addClass('small-right');
            });
        });
    </script>
    <div class="image-show">
        <a href="<?php echo site_url($module.'/show_image/' . $id) ?>" class="msgbox">
            <?php for ($i = 0; $i < 5; $i++): ?>
                <?php $image = @$images[$i] ?>
                <i class="image-container data-image" style="background-image: url(<?php echo data_url(@$image['uri']) ?>);"></i>
            <?php endfor ?>
        </a>
    </div>
    <div class="clear"></div>
    <?php
}

function back_button() {
    $CI = &get_instance();
    return '<a href="'.site_url($CI->nonce->back_track()).'" class="button">'.l('Kembali').'</a>';
}