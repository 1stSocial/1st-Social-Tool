<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="en" />

<link href="<?= base_url(); ?>assets/css/internal/<?= $board_style; ?>.css" rel="stylesheet" type="text/css" />


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/js/lib/jquery.zrssfeed.min.js" type="text/javascript"></script>
<!-- <script src="http://connect.facebook.net/en_US/all.js#appId=242689285769435&amp;xfbml=1"></script>
<title>All Jobs</title>
 -->
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script type="text/javascript">

var sFacebookAppId = '<?= $fb_app_id; ?>';

FB.init({
appId : sFacebookAppId,
status : true, // check login status
cookie : true, // enable cookies to allow the server to access the session
xfbml : true // parse XFBML
});
</script>

<script type="text/javascript">
window.fbAsyncInit = function() {
FB.Canvas.setAutoGrow();
}
function sizeChangeCallback() {
FB.Canvas.setSize({ width: 810, height: 1400 });
}

 FB.login(function(response) {
   // handle the response
 }, {scope: 'email,user_likes'});
</script>


<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-20719537-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>



</head>
<body>

<script type="text/javascript">
var sBoardUrl = '<?= $board_url; ?>';

$(document).ready(function () {
	$('#jobs').rssfeed(sBoardUrl, {
		limit: 100,
		header: false,
		linktarget: '_blank'
	});

});

</script>

<?= $board_html; ?>

<div id="fb-root"></div>

</body>
</html>