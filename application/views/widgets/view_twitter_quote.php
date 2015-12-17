<section class="twitter">
<div class="wrapper"><amp-twitter width=390 height=50 layout="responsive" data-tweetid="<?=$text;?>"></amp-twitter></div>
</section>
<script>
jQuery(document).ready(function($) { 
	$('.article-body section.twitter div.wrapper').width($(window).width() > 500 ? 500 : $(window).width());
});
</script>
