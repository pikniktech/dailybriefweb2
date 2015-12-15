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
      <div class="live-traffic hide">
        <div class="floater traffic"></div>
        <div class="live-traffic-body">
          <h2>Select Your Location</h2>
          <div class="traffic-options district">
            <label for="traffic-district">地區</label>
            <i class="fa fa-angle-down"></i>
            <select name="traffic-district">
              <option selected>請選擇地區</option>
              <option value="hkisland">香港島</option>
              <option value="kowloon">九龍</option>
              <option value="new-territories">新界</option>
            </select>
          </div>
          <div class="traffic-options place">
            <label for="traffic-place">地點</label>
            <i class="fa fa-angle-down"></i>
            <select name="traffic-place">
              <option selected>請選擇地點</option>
              <option value="c1">海底隧道香港入口</option>
              <option value="c2">香港仔海旁道近魚市場</option>
              <option value="c3">香港仔隧道香港仔入口</option>
              <option value="c4">香港仔隧道灣仔入口</option>
              <option value="c5">菲林明道近港灣道</option>
              <option value="c6">干諾道中近信德中心</option>
            </select>
          </div>
          <div class="live-traffic-video">
            <div class="live-ltraffic-ocation">海底隧道香港入口</div>
            <img src="./assets/images/H207F.JPG">
          </div>
          <div class="recent-locations">
            <h2>Recent Location</h2>
            <div class="mui-row nomargin">
              <div class="mui-col-xs-4">
                <div class="cameras-location">
                  <div class="placeText">海底隧道香港入口</div>
                  <div class="location-pic place-01"></div>
                </div>
              </div>
              <div class="mui-col-xs-4">
                <div class="cameras-location">
                  <div class="placeText">香港仔海旁道近魚市場</div>
                  <div class="location-pic place-02"></div>
                </div>
              </div>
              <div class="mui-col-xs-4">
                <div class="cameras-location">
                  <div class="placeText">香港仔隧道香港仔入口</div>
                  <div class="location-pic place-03"></div>
                </div>
              </div>
              <div class="mui-col-xs-4">
                <div class="cameras-location">
                  <div class="placeText">香港仔隧道灣仔入口</div>
                  <div class="location-pic place-04"></div>
                </div>
              </div>
              <div class="mui-col-xs-4">
                <div class="cameras-location">
                  <div class="placeText">菲林明道近港灣道</div>
                  <div class="location-pic place-05"></div>
                </div>
              </div>
              <div class="mui-col-xs-4">
                <div class="cameras-location">
                  <div class="placeText">干諾道中近信德中心</div>
                  <div class="location-pic place-06"></div>
                </div>
              </div>
          </div>
        </div>
        <div class="btn-menu-out bounce traffic">
          <i class="fa fa-angle-up"></i>
        </div>
      </div>
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
      <!-- Main Nav End -->
    </div>
    <script>
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
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
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

      // Main Nav - Responsive Part
    	var $window = $(window).on('resize', function(){
        $('#googleMap').height($(window).height());
        $('.section-traffic').height($(window).height());

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

        var $liveTrafficVideo = $('.live-traffic-video img');
        var cameraHeight = $liveTrafficVideo.height();
        $('.live-traffic-video').height(cameraHeight);
        var $orgTrafficHeight = $('.recent-locations div div.mui-col-xs-4');
        var $camerasLocation = $('.cameras-location');
        var orgTrafficHeight = $orgTrafficHeight.width();
        $camerasLocation.height(orgTrafficHeight);

        var orgplaceText = $('.placeText').height();
        var locationCenterText = (orgTrafficHeight - orgplaceText)/2;
        $('.placeText').css({"padding-top":locationCenterText+"px"});

        var $floaterTraffic = $('.floater.traffic');
        var $trafficBody = $('.live-traffic-body');
        var newTrafficHeight = $trafficBody.height();
        var floaterTrafficMargin = -(newTrafficHeight/2);
        $floaterTraffic.css({"margin-bottom":floaterTrafficMargin+"px"});
        $trafficBody.css({"height":newTrafficHeight+"px"});

    	}).trigger('resize');

      $('.main-nav-item').click(function(){
          var callPanelID = $(this).attr('id');
          $('.news-feed.'+callPanelID).removeClass('hide');
      });

    });
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
</script>
