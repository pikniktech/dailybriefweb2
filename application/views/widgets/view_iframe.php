<html>
<head>
	<title><?=@htmlentities($article['data']['article.title']['value'][0]['text']);?></title>
	<link href="/assets/css/default.css" rel="stylesheet" type="text/css" />	
	<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="/assets/script/jquery.mobile.custom.min.js"></script>
	<style>
		html, body { margin: 0; padding: 0;}
		figure { margin: 0; }
	</style>
</head>
<body>
	<?php if ($type == 'slider' && $slider) : ?>
        <figure class="cd-image-container" data-height="<?=min($slider['beforeimg']['value']['main']['dimensions']['height'], $slider['afterimg']['value']['main']['dimensions']['height']);?>">
            <img src="<?=$slider['beforeimg']['value']['main']['url'];?>" alt="" class="slider-after-img">
            <span class="cd-image-label" data-type="original"></span>
            <div class="cd-resize-img"><img src="<?=$slider['afterimg']['value']['main']['url'];?>" alt="" class="slider-before-img">
                <span class="cd-image-label" data-type="modified"></span>
            </div>
            <span class="cd-handle"></span>
        </figure>
	<?php elseif ($type == 'scratch_card') : ?>
	<figure data-height="<?=@$scratch_card['backimage']['value']['main']['dimensions']['height'];?>">
	<div data-bimg="<?=@$scratch_card['backimage']['value']['main']['url'];?>" data-fimg="<?=$scratch_card['frontimg']['value']['main']['url'];?>" id="scratchpad-<?=$index;?>" class="scratchpad"></div>
	</figure>
	<style>
		#scratchpad-<?=$index;?> {/* width: 100%; */ height: <?=$scratch_card['frontimg']['value']['main']['dimensions']['height'];?>px; }
	</style>
	<script src="/assets/script/wScratchPad.min.js"></script>   
	<?php endif; ?>
	<script src="/assets/script/maxwise.js"></script>  
	<script>
		jQuery(document).ready(function($) {
			$(parent.document.getElementById('<?=$type;?>-<?=(int)$index;?>')).find('iframe').height($('figure').attr('data-height'));
		});
	</script>
</body>
</html>
