<!-- PreLoader -->
<div id="loader-wrapper">
  <div id="loader"></div>
  <div class="loader-section section-left"></div>
  <div class="loader-section section-right"></div>
</div>
<div id="content-wrapper">
  <!-- Main content goes here -->
  <div class="section-traffic">
	<nav class="app-bar traffic">
	  <div class="app-bar-icon left">
		<i class="fa fa-angle-left"></i>
	  </div>
	  <div class="app-bar-icon right">
		<i class="fa fa-video-camera"></i>
		<i class="fa fa-comment current"></i>
	  </div>
	  <span class="app-bar-title">My <strong>Traffic</strong></span>
	</nav>
	<div class="message-group">
	  <div class="message-body">
		<!-- Message Start -->
		<div class="message-detail">
		  <div class="profile-pic">
			<img src="./assets/images/profile_pic_demo.jpg">
		  </div>
		  <div class="message-content">
			<p><span>08:28</span>Happens everyday...</p>
		  </div>
		</div>
	  </div>
	</div>
	  <div class="message-panel">
		<div class="message-box">
		  <i class="fa fa-smile-o"></i>
		  <input id="message_input" class="message-box" type="text" placeholder="Type a message">
		  <button class="send-message" type="button">Send</button>
		</div>
	  </div>
	<div class="search-map">
	  <input id="pac_input" class="search-box" type="text" placeholder="Search Destination">
	  <i class="fa fa-times close-search-icon"></i>
	</div>
	<div id="googleMap"></div>
  </div>
  <div class="btn-home orange traffic">
	<i class="fa fa-home"></i>
  </div>
  <div class="live-traffic hide">
  	<div class="live-traffic-body">
  	  <h2>Select Your Location</h2>
  	  <div class="traffic-options district">
  		<label for="traffic-district">地區</label>
  		<i class="fa fa-angle-down"></i>
  		<select name="traffic-district">
  		  <option value='' selected>請選擇地區</option>
  		  <?php foreach($district_list as $district){?>
  		  <option value="<?php echo $district?>"><?php echo $district?></option>
  		  <?php } ?>
  		</select>
  	  </div>
  	  <div class="traffic-options place">
  		<label for="traffic-place">地點</label>
  		<i class="fa fa-angle-down"></i>
  		<select name="traffic-place">
  		  <option  value='' selected>請選擇地點</option>
  		</select>
  	  </div>
  	  <div class="live-traffic-video">
  		<div class="live-ltraffic-ocation">Loading...</div>
  		<img id="mainCamImage" src="./assets/images/H207F.JPG">
  	  </div>
  	  <div class="recent-locations">
    		<h2>Recent Location</h2>
    		<div class="mui-row nomargin" id="recentCamContainer">

    		</div>
  	  </div>
    </div>
    <div class="btn-menu-out bounce traffic">
    <i class="fa fa-angle-up"></i>
    </div>
  </div>
  <!-- Main Nav Start -->
  <?php $this->load->view("view_main_menu");?>
  <!-- Main Nav End -->
</div>

<div id="tplCamHistoryItem" style="display:none">
  <div class="mui-col-xs-4">
	<div class="cameras-location">
	  <div class="placeText"></div>
	  <div class="location-pic"></div>
	</div>
  </div>
</div>

<script>


var cam_list = [];
<?php foreach($cam_list as $cam){?>
	cam_list.push({
		'district': '<?php echo $cam->properties->district ?>',
		'name': '<?php echo $cam->properties->name ?>',
		'image': '<?php echo $cam->properties->image ?>',
	});
<?php }?>

// scroll back to top
$('#message_input').on('focus', function () { window.scrollTo(0, 0) })

//Message Animation
$('.send-message').click(function() {
	var $newMessage = '<div class="message-detail" style="opacity:0"><div class="profile-pic"><img src="./assets/images/profile_pic_demo.jpg"></div><div class="message-content"><p><span>08:28</span>Happens everyday...</p></div></div>';
	$('.message-body').append($newMessage);
	$('.message-detail').last().animate({
	  opacity: 1
	}, 500, function(){
	});
});


function refreshPlaceList()
{
	$("select[name=traffic-place] option:gt(0)").remove();

	var district = $("select[name=traffic-district]").val();
	if(district == "")
		return;

	for(var i=0; i<cam_list.length; i++)
	{
		if(cam_list[i].district == district)
			$("select[name=traffic-place]").append("<option value='" + cam_list[i].name + "'>" + cam_list[i].name + "</option>");
	}
}

function updateCam()
{
	var place = $("select[name=traffic-place]").val();
	if(place == "")
		return;

	//save viewed cam to cookie
	var cam_history = readCookie("cam_history");
	var cam_history_array = [];
	if(cam_history != null && cam_history != "")
		cam_history_array = cam_history.split(",");

	if(cam_history_array.indexOf(place) < 0)
		cam_history_array.push(place);

	while(cam_history_array.length > 6)
		cam_history_array.shift();

	cam_history = cam_history_array.join();
	createCookie("cam_history", cam_history, 60);


	for(var i=0; i<cam_list.length; i++)
	{
		if(cam_list[i].name == place)
		{
			$("div.live-ltraffic-ocation").html(cam_list[i].name);
			$("#mainCamImage").fadeOut(1000);
			$("#mainCamImage").attr('src', cam_list[i].image).fadeIn(1000);
			break;
		}
	}
}

function setCamByPos(pos)
{
	var url = '/traffic/doGetCamByLngLat?lng=' + pos.lng + "&lat=" + pos.lat;
	$.ajax({
		url: url,
		dataType: "json",
	}).done(function(response){
		//console.log(response);
		$("select[name=traffic-district]").val(response.data.district);
		refreshPlaceList();
		$("select[name=traffic-place]").val(response.data.name);
		updateCam();
	});
}

function setDefaultCam()
{
	//preset first camera
	var first_district = $("select[name=traffic-district] option:eq(1)").val();
	if(first_district)
	{
		$("select[name=traffic-district]").val(first_district);
		refreshPlaceList();
		var first_place = $("select[name=traffic-place] option:eq(1)").val();
		if(first_place)
		{
			$("select[name=traffic-place]").val(first_place);
			updateCam();
		}
	}

}

jQuery(function($) {


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

  //GoogleMap
  function initialize() {
	var mapCanvas = document.getElementById('googleMap');
	var mapOptions = {
	  center: new google.maps.LatLng(44.5403, -78.5463),
	  zoom: 13,
	  disableDefaultUI: true,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	}

	var infoWindow = new google.maps.InfoWindow({map: map});
	// Try HTML5 geolocation.
	if (navigator.geolocation) {
	  navigator.geolocation.getCurrentPosition(function(position) {
		var pos = {
		  lat: position.coords.latitude,
		  lng: position.coords.longitude
		};

		infoWindow.setPosition(pos);
		infoWindow.setContent('Location found.');
		map.setCenter(pos);

		setCamByPos(pos);
	  }, function() {
		handleLocationError(true, infoWindow, map.getCenter());
		setDefaultCam();
	  });
	} else {
	  // Browser doesn't support Geolocation
	  handleLocationError(false, infoWindow, map.getCenter());
	  setDefaultCam();
	}

	var map = new google.maps.Map(mapCanvas, mapOptions);
	var trafficLayer = new google.maps.TrafficLayer();
	trafficLayer.setMap(map);
  }
  google.maps.event.addDomListener(window, 'load', initialize);

  function handleLocationError(browserHasGeolocation, infoWindow, pos) {
	infoWindow.setPosition(pos);
	infoWindow.setContent(browserHasGeolocation ?
						  'Error: The Geolocation service failed.' :
						  'Error: Your browser doesn\'t support geolocation.');
  }

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

  //schedule update the cam image
  setInterval(function(){
	  var imgsrc = $("#mainCamImage").attr('src');
	  d = new Date();
	  imgsrc = updateQueryStringParameter(imgsrc, "t", d.getTime());
	  $("#mainCamImage").attr('src', imgsrc);
  }, 60000);

	//load cam history
	var cam_history = readCookie("cam_history");
	var cam_history_array = [];
	if(cam_history != null && cam_history != "")
		cam_history_array = cam_history.split(",");


	console.log(cam_history_array);

	//recentCamContainer
	//tplCamHistoryItem
	$("#recentCamContainer").html('');
	for(var i=0; i<cam_history_array.length; i++)
	{
		for(var j=0; j<cam_list.length; j++)
		{
			if(cam_list[j].name == cam_history_array[i])
			{
				var cam_html = $("#tplCamHistoryItem").html();
				var cam_element = $(cam_html).appendTo($("#recentCamContainer"));
				cam_element.find(".placeText").html(cam_list[j].name);
				cam_element.find(".location-pic").css('background-image', 'url(' + cam_list[j].image + ')');
				break;
			}
		}
	}

  //Buttons for Traffic
  $('.close-search-icon').on('click', function(){
	var text = '';
	$('.search-box').attr('value', text);
  })
  $('.btn-menu-out.traffic').on('click', function() {
	$('.live-traffic').addClass('hide');
  });

  $('.fa-video-camera').on('click', function(){
	$('.live-traffic').removeClass('hide');
  });

  $('div.app-bar-icon.left').click(function(){
	window.location = "/";
  });

  // Responsive Part
	var $window = $(window).on('resize', function(){
	$('#googleMap').height($(window).height());
	$('.section-traffic').height($(window).height());

  // Traffic Overlay
  var $trafficBody = $('.live-traffic-body');
  $trafficBody.height($(window).height());
	var $liveTrafficVideo = $('.live-traffic-video img');
	var cameraHeight = $liveTrafficVideo.height();
	$('.live-traffic-video').height(cameraHeight);
	var $orgTrafficHeight = $('.recent-locations div div.mui-col-xs-4');
	var $camerasLocation = $('.cameras-location');
	var orgTrafficHeight = $orgTrafficHeight.width();
	$camerasLocation.height(orgTrafficHeight);

  // Traffic Overlay - Location Pic & Text
  var locationPicHeight = $('.location-pic').width();
  $('.location-pic').height(locationPicHeight);

	var orgplaceText = $('.placeText').height();
	var locationCenterText = (orgTrafficHeight - orgplaceText)/2;
	$('.placeText').css({"padding-top":locationCenterText+"px"});

	}).trigger('resize');

  $("select[name=traffic-district]").change(function(){
	  refreshPlaceList();
  });

  $("select[name=traffic-place]").change(function(){
	  updateCam();
  });

});

</script>
