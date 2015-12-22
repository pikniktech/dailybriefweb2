<?php $_h = 400; ?>
<section class="image_gallery">
<amp-carousel width=auto height=400>
<?php foreach ($gallery as $image) :?>
<amp-img src="<?=$image['img']['value']['main']['url'];?>" width=<?=round(($image['img']['value']['main']['dimensions']['width']/$image['img']['value']['main']['dimensions']['height'])*400);?> height=<?=$_h;?>></amp-img>
<?php endforeach; ?>
</amp-carousel>
</section>
