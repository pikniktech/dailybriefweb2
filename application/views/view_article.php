<style>
html { background-color: initial; max-width: 100%; }
body { overflow: initial; }
.article-body { width: 100%; overflow-y: initial; }
</style>
<!-- PreLoader -->
<div id="loader-wrapper">
  <div id="loader"></div>
  <div class="loader-section section-left"></div>
  <div class="loader-section section-right"></div>
</div>
<div>
  <div id="" class="">
    <div class="">
      <div class="article-body">
        <div class="article-content">
		<h2><?=@$article['data']['article.title']['value'][0]['text'];?></h2>
		<span class="article-info"><?php echo $pub_date;?></span>
		<?=@$article_content; ?>
          <div class="article-tag">
			<?php foreach ($article['tags'] as $tag){ ?>
				<span><a href="/tags/<?=$tag;?>"><?=$tag;?></a></span>
			<?php } ?>
          </div>
        </div>
      </div>
	  
    </div>
  </div>

</div>
<script>

jQuery(function($) {

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

	$('body').addClass('loaded');
	$('.section-block').removeClass('hide');
	$('.main-nav').addClass('hide');
	$('.news-feed').addClass('hide');
  
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


});
</script>
