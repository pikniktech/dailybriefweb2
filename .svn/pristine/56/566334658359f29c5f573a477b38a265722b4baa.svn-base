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
			  <? foreach($article_list as $article){?>
			    <? $idx = 0?>
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
  <div class="main-nav">
	<div class="floater home"></div>
	<div class="main-nav-body">
	  <div class="mui-row">
		<h2>MENU</h2>
		<div class="mui-col-xs-4 mui-col-md-4">
		  <div class="main-nav-item item-01" id="trending">
		  </div>
		</div>
		<div class="mui-col-xs-4 mui-col-md-4">
		  <div class="main-nav-item item-02" id="weather">
		  </div>
		</div>
		<div class="mui-col-xs-4 mui-col-md-4">
		  <div class="main-nav-item item-03" id="traffic">
		  </div>
		</div>
		<div class="mui-col-xs-4 mui-col-md-4">
		  <div class="main-nav-item item-04" id="business">
		  </div>
		</div>
		<div class="mui-col-xs-4 mui-col-md-4">
		  <div class="main-nav-item item-05" id="food">
		  </div>
		</div>
		<div class="mui-col-xs-4 mui-col-md-4">
		  <div class="main-nav-item item-06" id="technology">
		  </div>
		</div>
		<div class="mui-col-xs-4 mui-col-md-4">
		  <div class="main-nav-item item-07" id="sports">
		  </div>
		</div>
		<div class="mui-col-xs-4 mui-col-md-4">
		  <div class="main-nav-item item-08" id="workplace">
		  </div>
		</div>
		<div class="mui-col-xs-4 mui-col-md-4">
		  <div class="main-nav-item item-09" id="pets">
		  </div>
		</div>
	  </div>
	</div>
	<div class="btn-menu-out bounce home">
	  <i class="fa fa-angle-up"></i>
	</div>
  </div>
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
			window.location = "/article/view/" + artdiv.data("id") + "/" + artdiv.data("slug");
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
	var $mainNavItem = $('.main-nav-item');
	var $floaterHome = $('.floater.home');
	var $mainNavBody = $('.main-nav-body .mui-row');
	var orgHeight = $mainNavItem.width();
	$mainNavItem.css({"height":orgHeight+"px"});
	var contentHeight = $mainNavBody.height();
	var floaterHomeMargin = -(contentHeight/2);
		$floaterHome.css({"margin-bottom":floaterHomeMargin+"px"});
		$mainNavBody.css({"height":contentHeight+"px"});

	var $floaterSports = $('.floater.sports');
	var $sportsBody = $('ul.news-feed.sports');
	var $newsFeedBody = $('div.news-feed-body.sports');
	var newsSportHeight = $sportsBody.height();
	var floaterSportsMargin = -(newsSportHeight/2);
	$floaterSports.css({"margin-bottom":floaterSportsMargin+"px"});
	$newsFeedBody.css({"height":newsSportHeight+"px"});
	}).trigger('resize');

	$('.main-nav-item').click(function(){
	  var callPanelID = $(this).attr('id');
	  $('.news-feed.'+callPanelID).removeClass('hide');
	});
  
  
});


</script>
