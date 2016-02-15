<!-- PreLoader -->
<!--<div id="loader-wrapper">
  <div id="loader"></div>
  <div class="loader-section section-left"></div>
  <div class="loader-section section-right"></div>
</div>-->
<div id="content-wrapper">
  <!-- Main content goes here -->
	  <div id="slider_container">
		  <!-- Slides Container -->
			  <? foreach($article_list as $article){?>
				<? if(isset($article['widget_url'])){?>
					<div class="section iframe-section">
						<iframe src="<?= $article['widget_url']?>" ></iframe>
						<div class="mask" onclick="window.location='<?= $article['action_url']?>'"></div>
					</div>
				<? } else { ?>
					<? if($article['cover_image'] != ""){?>
					  <div class="section" onclick="openArticle('<?=$article['id']?>', '<?=$article['slug']?>')">
						  <div class="section-block orange hide">
							<div>What's Trending</div>
						  </div>
						  <img u=image src="<?= $article['cover_image']?>" />
					  </div>
					<? }else if($article['cover_video'] != ""){?>
						<div class="section" onclick="openArticle('<?=$article['id']?>', '<?=$article['slug']?>')">
						  <div class="section-block orange hide">
							<div>What's Trending</div>
						  </div>
						  <video width="100%" height="100%" autoplay loop muted class="cover_video">
							<source src="<?=$article['cover_video'] ?>" type="video/mp4">
						  </video>
						</div>
					<? } ?>
				<? } ?>
			  <?php } ?>

	  </div>
    <!-- Arrow Navigator -->
    <div class="btn-menu-out bounce scrollDown">
      <i class="fa fa-angle-up"></i>
    </div>
	  <!-- Jssor Slider End -->
  </div>
  <div class="btn-home orange">
	<i class="fa fa-home"></i>
  </div>
  <!-- Main Nav Start -->
  <?php $this->load->view("view_main_menu");?>
</div>
<script>
jQuery(function($) {
	//PreLoading items, animations
	/*setTimeout(function(){
		$('body').addClass('loaded');
	}, 2000);*/

	//video play
	var $video = $('.cover_video');
		$video.on('canplaythrough', function() {
		this.play();
	});

	//Show Section Block
	//setTimeout(function(){
		$('.section-block').removeClass('hide');
	//}, 3000);
	//setTimeout(function(){
		$('.main-nav').addClass('hide');
		$('.news-feed').addClass('hide');
	//}, 1000);

	//Slider
  function initialization(){
    $('#slider_container').fullpage({
      continuousVertical: true
    });
  }
  initialization();

  $('.scrollDown').click(function(e){
  	e.preventDefault();
  	$.fn.fullpage.moveSectionDown();
  });

	var keys = {37: 1, 38: 1, 39: 1, 40: 1};

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

	disableScroll();
});

function openArticle(id, slug)
{
	window.location = "/article/" + id + "/" + slug;
}

</script>
