<?php if (!empty($gallery)) : ?>
<section class="video_gallery">
<div class="fullscreen-scrolling" id="scrolling-video">
<ul>
<?php foreach ($gallery as $ind => $video) :
?>
<li>
<div style="width: 100%">
<video width="auto" height="auto" controls webkit-playsinline loop >
  <source src="<?=@$video['video']['value'][0]['text'];?>" type="video/mp4">
</video>
</div>
</li>
<?php endforeach; ?>
</ul>
</div>
</section>
<?php endif; ?>
