<?php if (!empty($gallery)) : ?>
<?php foreach ($gallery as $ind => $video) :?>
<div class="section" style="background: #000; width: 100%; height: inherit;">
<video class="fullscreen-video"  width="auto" height="auto" style="height: inherit; min-width: 320px; overflow: hidden; width: inherit;" controls webkit-playsinline loop >
  <source src="<?=@$video['video']['value'][0]['text'];?>" type="video/mp4">
</video>
</div>
<?php endforeach; ?>
<?php endif; ?>
