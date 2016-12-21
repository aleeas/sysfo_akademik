<ul class="breadcrumb">
    <li><a href="<?php echo ($self->home_url) ? site_url($self->home_url) : base_url() ?>">Home</a></li>
    <?php foreach($breadcrumb as $bc): ?>
    <?php if (empty ($bc['uri'])): ?>
    <li><a href="#"><?php echo l($bc['title']) ?></a></li>
    <?php else: ?>
    <li><a href="<?php echo site_url($bc['uri']) ?>"><?php echo l($bc['title']) ?></a></li>
    <?php endif ?>
    <?php endforeach ?>
</ul>