<?php $_h = 667; $_w = 375; ?>
<?php if (!empty($gallery)) : ?>
<section class="image_gallery_fullscreen">
<div class="fullscreen-scrolling" id="scrolling1">
<ul>
<?php foreach ($gallery as $image) :
	$w0 = $image['img']['value']['main']['dimensions']['width'];
	$h0 = $image['img']['value']['main']['dimensions']['height'];
?>
    	<li>
		<img src="<?=$image['img']['value']['main']['url'];?>" width="100%" />
<!-- <amp-img src="<?=$image['img']['value']['main']['url'];?>" width="<?=$w0;?>" height="<?=$h0;?>"></amp-img> -->
	</li>
<?php endforeach; ?>
</ul>
</div>
<div class="clear"></div>
</section>
<?php endif; ?>
