<!-- PreLoader -->
<div id="loader-wrapper">
  <div id="loader"></div>
  <div class="loader-section section-left"></div>
  <div class="loader-section section-right"></div>
</div>
<div id="content-wrapper">
  <!-- Main content goes here -->
  <div style="position: relative; left: 50%; width: 5000px; text-align: center; margin-left: -2500px;">
	  <!-- Jssor Slider Begin -->
	  <!-- To move inline styles to css file/block, please specify a class name for each element. -->
	  <div id="slider1_container" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 414px; height: 736px;">
		  <!-- Slides Container -->
		  <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 414px;  height: 736px;
	  overflow: hidden;">
			  <? $idx = 0?>
			  <? foreach($article_list as $article){?>
				<? if($article['cover_image'] != ""){?>
				  <div id="article_<?=$idx?>" data-id="<?=$article['id']?>" data-slug="<?=$article['slug']?>">
					  <div class="section-block orange hide">
						<div>What's Trending</div>
					  </div>
					  <img u=image src="<?= $article['cover_image']?>" />
				  </div>
				<? }else if($article['cover_video'] != ""){?>
					<div id="article_<?=$idx?>" data-id="<?=$article['id']?>" data-slug="<?=$article['slug']?>">
					  <div class="section-block orange hide">
						<div>What's Trending</div>
					  </div>
					  <video width="100%" height="100%" autoplay loop muted class="cover_video">
						<source src="<?=$article['cover_video'] ?>" type="video/mp4">
					  </video>
					</div>
				<? } ?>
				<? ++$idx ?>
			  <?php } ?>
		  </div>
		  <!-- Arrow Navigator -->
		  <span data-u="arrowleft" class="jssora22l" data-autocenter="2"></span>
		  <span data-u="arrowright" class="jssora22r bounce" data-autocenter="2"><i class="fa fa-angle-down "></i></span>

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
	setTimeout(function(){
		$('body').addClass('loaded');
	}, 2000);

	//video play
	var $video = $('.cover_video');
		$video.on('canplaythrough', function() {
		this.play();
	});

	//Show Section Block
	setTimeout(function(){
		$('.section-block').removeClass('hide');
	}, 3000);
	setTimeout(function(){
		$('.main-nav').addClass('hide');
		$('.news-feed').addClass('hide');
	}, 1000);

	//Slider
	var options = {
	  $ArrowNavigatorOptions: {
		  $Class: $JssorArrowNavigator$,
		  $ChanceToShow: 2,
		  $AutoCenter: 1
	  },
	  $SlideDuration: 800,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
	  $DragOrientation: 2,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $Cols is greater than 1, or parking position is not 0)
	  $PlayOrientation: 2,
	  $AutoPlay: false,
	  $Loop: 0,                                //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
	  $Idle: 1500                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
	};

	var jssor_slider1 = new $JssorSlider$("slider1_container", options);

	//slider click event
	jssor_slider1.$On($JssorSlider$.$EVT_CLICK,function(slideIndex){
		var artdiv = $("#article_" + slideIndex);
		if(artdiv)
		{
			window.location = "/article/" + artdiv.data("id") + "/" + artdiv.data("slug");
		}
	});

	//responsive code begin
	//you can remove responsive code if you don't want the slider to scale along with window
	function ScaleSlider() {
	  var windowWidth = $(window).width();

	  if (windowWidth) {
		  var windowHeight = $(window).height();
		  var originalWidth = jssor_slider1.$OriginalWidth();
		  var originalHeight = jssor_slider1.$OriginalHeight();

		  if (originalWidth / windowWidth > originalHeight / windowHeight) {
			  jssor_slider1.$ScaleHeight(windowHeight);
		  }
		  else {
			  jssor_slider1.$ScaleWidth(windowWidth);
		  }
	  }
	  else
		  window.setTimeout(ScaleSlider, 30);
	}

	ScaleSlider();

	$(window).bind("load", ScaleSlider);
	$(window).bind("resize", ScaleSlider);
	$(window).bind("orientationchange", ScaleSlider);
	//responsive code end


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


</script>
