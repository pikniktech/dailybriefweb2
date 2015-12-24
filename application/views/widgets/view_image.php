<figure>
	<amp-img src="<?=$image;?>" srcset="<?=$image;?> 1x, <?=@$image2x ? $image2x : $image;?> 2x" layout="responsive" width="<?=$src['dimensions']['width'];?>" placeholder alt="" height="<?=$src['dimensions']['height'];?>" on="tap:headline-img-lightbox"></amp-img>
</figure>
