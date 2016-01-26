<?php $_h = 400; $_w = 600; ?>
<section class="image_gallery">
<amp-carousel width=auto height=<?=$_h;?>>
<?php foreach ($gallery as $image) :
	if (isset($image['img'])) :
		//$h0 = ($image['img']['value']['main']['dimensions']['height']/$image['img']['value']['main']['dimensions']['width'])*$_w;
		//$w0 = $_w;
		$w0 = ($image['img']['value']['main']['dimensions']['width']/$image['img']['value']['main']['dimensions']['height'])*$_h;
		$h0 = $_h;
?>
<amp-img src="<?=$image['img']['value']['main']['url'];?>" width="<?=$w0;?>" height="<?=$h0;?>"></amp-img>
<?php 
	endif;
	endforeach; ?>
</amp-carousel>
</section>
