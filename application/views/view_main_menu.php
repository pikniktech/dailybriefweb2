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
  
<script>
jQuery(function($) {
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
	  
	  if(callPanelID == "traffic")
		  window.location = "/traffic";
	});
});
</script>