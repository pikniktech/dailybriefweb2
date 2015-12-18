<?php if ($scratch_card['frontimg']['value']['main']['url'] && $scratch_card['backimage']['value']['main']['url']) : ?>
<section class="scratch_card">
<div id="scratch_card-<?=$index;?>">
<iframe width="100%" height=300
    layout="responsive"
    frameborder="0"
    src="/article/scratch_card/<?=$article_id?>?index=<?=$index;?>">
</iframe>
<!--
	<div data-bimg="<?=$scratch_card['frontimg']['value']['main']['url'];?>" data-fimg="<?=$scratch_card['backimage']['value']['main']['url'];?>" id="scratchpad-<?=$index;?>" class="scratchpad"></div>
	<style>
		#scratchpad-<?=$index;?> { width: 100%; height: <?=$scratch_card['frontimg']['value']['main']['dimensions']['height'];?>px; }
	</style>
-->
</div>
</section>
<?php endif; ?>
