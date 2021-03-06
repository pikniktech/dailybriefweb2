<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php if ($is_referral || $is_mobile) : ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<?php endif; ?>
	<link rel="canonical" href="<?=$canonical;?>" >
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">

<meta property="fb:pages" content="1233319620030723" />



    <link href="/assets/css/mui.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/default.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="/assets/css/overrides.css" rel="stylesheet" type="text/css" />
    <!--<link href="/assets/css/jquery.fullPage.css" rel="stylesheet" type="text/css" />-->
    <script src="//cdn.muicss.com/mui-0.2.3/js/mui.min.js"></script>
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<!--    <script src="/assets/script/jssor.slider.min.js"></script> -->
    <script src="/assets/script/jquery.nicescroll.js"></script>
    <script src="/assets/script/jquery.rframe.js"></script>
    <script src="/assets/script/jquery.fullPage.min.js?v=1.0"></script>
    <!-- <script src="/assets/script/jquery.slimscroll.min.js"></script> -->
    <script src="https://maps.googleapis.com/maps/api/js"></script>

	<!-- script src="/assets/script/itemslide.min.js"></script -->


    <script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
    <script async custom-element="amp-image-lightbox" src="https://cdn.ampproject.org/v0/amp-image-lightbox-0.1.js"></script>
    <script async custom-element="amp-lightbox" src="https://cdn.ampproject.org/v0/amp-lightbox-0.1.js"></script>
    <script async custom-element="amp-instagram" src="https://cdn.ampproject.org/v0/amp-instagram-0.1.js"></script>
    <script async custom-element="amp-twitter" src="https://cdn.ampproject.org/v0/amp-twitter-0.1.js"></script>
    <script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>
    <script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
    <script async custom-element="amp-fit-text" src="https://cdn.ampproject.org/v0/amp-fit-text-0.1.js"></script>
    <script async custom-element="amp-audio" src="https://cdn.ampproject.org/v0/amp-audio-0.1.js"></script>
    <style>body {opacity: 0}</style><noscript><style>body {opacity: 1}</style></noscript>
    <script async src="https://cdn.ampproject.org/v0.js"></script>

    <script src="/assets/script/dragdealer.js"></script>
	<script src="/assets/script/common.js"></script>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="/assets/script/wScratchPad.min.js"></script>
	<script src="/assets/script/maxwise.js"></script>
	<title>DailyBrief</title>
  </head>
  <body>
	<?$this->load->view($partial_view);?>

<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
<script>
<?php if (!$is_referral && !$is_mobile && !$is_webview && !$webview) : ?>
if (window.location.hash != 'rFrame') {
	var options = {
		device: 'iPhone6',
		forkme: false,
		toolbar: true // off the toolbar
	}
	$.rFrame(options);
}
<?php endif; ?>
</script>
  </body>
</html>
