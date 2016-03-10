<?php if (!empty($text)) : ?>
<section class="widget video">
	<video width="100%" height="auto" controls loop webkit-playsinline autoplay>
  		<source src="<?=$text;?>" type="video/mp4" />
	</video>
</section>
<?php endif; ?>
