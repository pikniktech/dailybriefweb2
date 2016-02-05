<?php if (!empty($gallery)) : ?>
<section class="video_gallery" style="background: #000;">
<div class="fullscreen-scrolling" id="scrolling-video" style="height: inherit">
<ul>
<?php foreach ($gallery as $ind => $video) :
?>
<li style="height: inherit">
<div style="width: 100%; height: inherit">
<video width="auto" height="auto" style="height: inherit; min-width: 320px; overflow: hidden;" controls webkit-playsinline loop >
  <source src="<?=@$video['video']['value'][0]['text'];?>" type="video/mp4">
</video>
</div>
</li>
<?php endforeach; ?>
</ul>
</div>
</section>
<?php endif; ?>
