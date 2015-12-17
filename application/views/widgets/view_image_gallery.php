
<section class="image_gallery">
<amp-carousel width=auto height=400>
<?php foreach ($gallery as $image) :?>
<amp-img src="<?=$image['img']['value']['main']['url'];?>" width=300 height=400></amp-img>
<?php endforeach; ?>
</amp-carousel>
</section>
