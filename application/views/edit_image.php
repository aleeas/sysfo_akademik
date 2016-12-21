<script type="text/javascript">
    $(function() {
        $('.image-container').hover(function() {
            var pos = $(this).position();
            
            var left = 0, top = 0;
            left = pos.left;
            top = pos.top;
            
            $('#btn-delete').css({
                'left': left + 10,
                'top': top + 10
            }).attr('href', '<?php echo site_url($CI->uri->segments[1] . '/delete_image/' . $CI->uri->segments[3]) ?>/' + $(this).attr('data-ref') + '?nonce=<?php echo $_GET['nonce'] ?>').show();
            
            $('#btn-default').css({
                'left': left + 140,
                'top': top + 10
            }).attr('href', '<?php echo site_url($CI->uri->segments[1] . '/default_image/' . $CI->uri->segments[3]) ?>/' + $(this).attr('data-ref') + '?nonce=<?php echo $_GET['nonce'] ?>').show();
            
        }, function(evt) {
            var pos = $('#btn-delete').position();
            
            if (evt.pageX >= pos.left && evt.pageX <= pos.left + $('#btn-delete').width() &&
                evt.pageY >= pos.top && evt.pageY <= pos.top + $('#btn-delete').height()) {
                return false;
            }
            
            pos = $('#btn-default').position();
            if (evt.pageX >= pos.left && evt.pageX <= pos.left + $('#btn-default').width() &&
                evt.pageY >= pos.top && evt.pageY <= pos.top + $('#btn-default').height()) {
                return false;
            }
            
            $('#btn-delete').hide();
            $('#btn-default').hide();
        });
    });
</script>
<style type="text/css">
    i.image-container { width: 160px; height: 120px;  }

    #btn-delete, #btn-default { 
        display: block; 
        background: url(<?php echo theme_url('images/icon_delete.png') ?>); 
        width: 18px; 
        height: 18px; 
        position: absolute; 
        text-indent: -9999px;
        overflow: hidden;
    }

    #btn-default {
        background: url(<?php echo theme_url('images/icon_add.png') ?>); 
    }
</style>

<div class="toolbar"> 
    <div class="middle"> 
        <h1>Foto Foto</h1>
    </div> 
</div>

<form enctype="multipart/form-data" action="<?php echo site_url($CI->_get_uri('add_image') . '/' . $CI->uri->rsegments[3] . '?nonce=' . $nonce['nonce']) ?>" method="POST">
    <?php echo xview_error() ?>
    
    <fieldset>
        <a href="#" id="btn-delete" title="Delete" style="display: none;">Delete</a>
        <a href="#" id="btn-default" title="Set Default" style="display: none;">Set Default</a>

        <?php foreach ($images as $image): ?>
            <i style="background-image: url(<?php echo data_url($image['thumb']) ?>); float: left; margin: 5px;" class="image-container" data-ref="<?php echo $image['id'] ?>"></i>
        <?php endforeach ?>
    </fieldset>  
    <fieldset>
        <div>   
            <input type="file" name="image" />
            <input type="submit" value="Upload" />
        </div>
    </fieldset>
</form>

<?php echo back_button() ?>