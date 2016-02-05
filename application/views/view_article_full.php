<style>
html { background-color: initial; max-width: 100%; }
body { overflow: initial; <?php if ($is_mobile || true) { ?>background: #000;<?php } ?> }
.article-body { width: 100%; overflow-y: initial; background: #eee; }
.btn-home { display: none !important; }
<?php if ($fullscreen) : ?>
.article-content { padding: 0 !important; }
<?php endif;?>
</style>
<?php //$is_mobile = (@$_GET['test'] == 1) ? true : $is_mobile; ?>
<!-- PreLoader -->
<div id="loader-wrapper">
  <div id="loader"></div>
  <div class="loader-section section-left"></div>
  <div class="loader-section section-right"></div>
</div>
<div <?=($fullscreen ? 'class="fullscreen"': '');?>>
  <div id="" class="">
    <div class="" style="<?php if ($webview && !$is_mobile) { ?>width: 600px; 
    margin: 0 auto;
    background: #ccc;<?php } ?>">
      <div class="article-body">
		<?php if(!$is_webview){?>
<!--
			<?php if ($category) : ?>
				<div class="section-block orange" style="background: <?=$category['topbar_color'];?>">
				  <div><?=$category['name'];?></div>
				</div>
			<?php endif; ?>
-->
			<?php if ($featured_video || $featured_image || $featured_video_gallery) : ?>
				<div class="article-visual">
				<?php if ($featured_video) : ?>
					<img u=image src="<?=$featured_video;?>" class="visual-image" />
				<?php elseif ($featured_image) : ?>
					<img u=image src="<?=$featured_image;?>" class="visual-image" />
				<?php elseif (@$featured_video_gallery) : ?>
					<?=$featured_video_gallery;?>				
				<?php endif; ?>
				</div>
			<?php endif; ?>
		<?php } elseif (!empty($featured_video_gallery)) { ?>
					<?=$featured_video_gallery;?>				
		<?php } ?>
        <div class="article-content">
<?php if (!$fullscreen) : ?>
		<h2><?=@$article['data']['article.title']['value'][0]['text'];?></h2>
		<span class="article-info"><?php echo $pub_date;?></span>
<?php endif; ?>
		<?=@$article_content; ?>
<?php if (!$fullscreen) : ?>          
	<div class="article-tag">
			<?php foreach ($article['tags'] as $tag) : ?>
				<span><a href="/tags/<?=$tag;?>"><?=$tag;?></a></span>
			<?php endforeach; ?>
          </div>
<?php endif; ?>
        </div>
      </div>
	  
    </div>
  </div>
  <div class="btn-home orange">
    <i class="fa fa-home"></i>
  </div>
  <!-- Main Nav Start -->
  <?php if(!$is_webview){?>
  <?php // $this->load->view("view_main_menu");?>
  <?php } ?>
  <!-- Main Nav End -->
</div>
<script>

jQuery(function($) {
	<?if(!$is_webview){?>
	if (typeof Dragdealer != "undefined") {
	  new Dragdealer('image-carousel', {
		steps: 3,
		speed: 0.3,
		loose: true,
		requestAnimationFrame: true
	  });
	}
	<?}?>
	
	var $scroller = $(".article-body");
	$scroller.bind('touchstart', function (ev) {
	  var $this = $(this);
	  var scroller = $scroller.get(0);

	  if ($this.scrollTop() === 0) $this.scrollTop(1);
	  var scrollTop = scroller.scrollTop;
	  var scrollHeight = scroller.scrollHeight;
	  var offsetHeight = scroller.offsetHeight;
	  var contentHeight = scrollHeight - offsetHeight;
	  if (contentHeight == scrollTop) $this.scrollTop(scrollTop-1);
	});

	<?php if($is_webview){?>
		$('body').addClass('loaded');
		$('.section-block').removeClass('hide');
		$('.main-nav').addClass('hide');
		$('.news-feed').addClass('hide');
	<?}else{?>
	  //PreLoading items, animations
	  setTimeout(function(){
		$('body').addClass('loaded');
	  }, 2000);
		
	  //Show Section Block
	  setTimeout(function(){
		$('.section-block').removeClass('hide');
	  }, 3000);
	  setTimeout(function(){
		$('.main-nav').addClass('hide');
		$('.news-feed').addClass('hide');
	  }, 1000);
	<?}?>
  
  var keys = {37: 1, 39: 1};

  function preventDefault(e) {
    e = e || window.event;
    if (e.preventDefault)
        e.preventDefault();
    e.returnValue = false;
  }

  function preventDefaultForScrollKeys(e) {
      if (keys[e.keyCode]) {
          preventDefault(e);
          return false;
      }
  }

  function disableScroll() {
    if (window.addEventListener) // older FF
        window.addEventListener('DOMMouseScroll', preventDefault, false);
    window.onwheel = preventDefault; // modern standard
    window.onmousewheel = document.onmousewheel = preventDefault; // older browsers, IE
    window.ontouchmove  = preventDefault; // mobile
    document.onkeydown  = preventDefaultForScrollKeys;
  }

  // Responsive Part
  var $window = $(window).on('resize', function(){
    var winHeight = $(window).height();
    var winWidth = $('html').width();
    $('#image-carousel').height(winHeight);
    $('.article-visual').height(winHeight).width(winWidth);
  }).trigger('resize');

});
</script>
