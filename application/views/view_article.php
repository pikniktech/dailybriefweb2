<!-- PreLoader -->
<div id="loader-wrapper">
  <div id="loader"></div>
  <div class="loader-section section-left"></div>
  <div class="loader-section section-right"></div>
</div>
<div id="content-wrapper">
  <div id="image-carousel" class="dragdealer">
    <div class="handle">
      <div class="article-body">
<?php if ($category) : ?>
        <div class="section-block orange" style="background: <?=$category['topbar_color'];?>">
          <div><?=$category['name'];?></div>
        </div>
<?php endif; ?>
<?php if ($featured_video || $featured_image) : ?>
        <div class="article-visual">
		<?php if ($featured_video) : ?>
          	<img u=image src="<?=$featured_video;?>" class="visual-image" />
		<?php elseif ($featured_image) : ?>
          	<img u=image src="<?=$featured_image;?>" class="visual-image" />
		<?php endif; ?>
        </div>
<?php endif; ?>
        <div class="article-content">
		<h2><?=@$article['data']['article.title']['value'][0]['text'];?></h2>
		<span class="article-info"><?php echo $pub_date;?></span>	
		<?=@$article_content; ?>
          <div class="article-tag">
<?php foreach ($article['tags'] as $tag) : ?>
	<span><a href="/tags/<?=$tag;?>"><?=$tag;?></a></span>
<?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="btn-home orange">
    <i class="fa fa-home"></i>
  </div>
  <!-- Newd Feed Start -->
  <div class="news-feed sports">
    <div class="floater sports"></div>
    <div class="news-feed-body sports">
    <ul class="news-feed sports">
      <li class="news-feed-title">Sports <i class="fa fa-cross"></i></li>
      <li><a href="">0:0 逼和國足「美妙一夜」全城力撐 港足守出奇蹟</a></li>
      <li><a href="">NBA 東岸列強「站起來」</a></li>
      <li><a href="">喬帥擒費爸 年終賽4連霸封王</a></li>
    </ul>
  </div>
    <div class="btn-menu-out bounce sports">
      <i class="fa fa-angle-up"></i>
    </div>
  </div>
  <!-- Newd Feed End -->
  <!-- Main Nav Start -->
  <?php $this->load->view("view_main_menu");?>
  <!-- Main Nav End -->
</div>
<script>

jQuery(function($) {
if (typeof Dragdealer != "undefined") {
  new Dragdealer('image-carousel', {
    steps: 3,
    speed: 0.3,
    loose: true,
    requestAnimationFrame: true
  });
}
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

  //disableScroll();

  //Buttons
  $('.btn-home').on('click', function() {
    $('.main-nav').removeClass('hide');
  });
  $('.btn-menu-out.home').on('click', function() {
    $('.main-nav').addClass('hide');
  });
  $('.btn-menu-out.sports').on('click', function() {
    $('.news-feed').addClass('hide');
  });

  // Main Nav - Responsive Part
  var $window = $(window).on('resize', function(){
    var winHeight = $(window).height();
    var winWidth = $('html').width();
    $('#image-carousel').height(winHeight);
    $('.article-visual').height(winHeight).width(winWidth);
  }).trigger('resize');

});
</script>
