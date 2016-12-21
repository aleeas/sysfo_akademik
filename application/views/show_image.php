<script>
    $(function() {
        $(".scrollable").scrollable({
            // easing: 'linear', 
            speed: 700, 
            circular: false, 
            keyboard: true,
            onBeforeSeek: function(e, i) {
//                Nestle.loadPageWithId(i);
                
            },
            onSeek: function(e, i) {
//                Nestle.updateURL();
            }
        });
        
        $('a#scroll-next').click(function(evt) {
            $('.scrollable').data('scrollable').next();
            return evt.preventDefault();
        });
        
        $('a#scroll-prev').click(function (evt) {
            $('.scrollable').data('scrollable').prev();
            return evt.preventDefault();
        });
        
        $('a#scroll-next').trigger('click');
        $('a#scroll-prev').trigger('click');
    });
    
   
    
</script>

<div class="scrollable">
    <div class="items">
        <?php foreach ($images as $image): ?>
            <div class="item">
                <i class="image-container" style="width: 950px; height: 500px; background-image: url(<?php echo data_url($image['uri']) ?>)"></i>
            </div>
        <?php endforeach ?>
    </div>
</div>
<div>
    <a href="#prev" id="scroll-prev">prev</a>
    <a href="#next" id="scroll-next">next</a>
</div>