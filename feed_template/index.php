<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="en" />

<link href="stylesheet.css" rel="stylesheet" type="text/css" />


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js" type="text/javascript"></script>
<script src="jquery.zrssfeed.min.js" type="text/javascript"></script>
<script src="http://connect.facebook.net/en_US/all.js#appId=242689285769435&amp;xfbml=1"></script>
<title>All Jobs</title>

<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
FB.init({
appId : '380458451998046',
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

$(document).ready(function () {
	$('#jobs').rssfeed('http://choiceone.com.au/job/rss.aspx?search=1', {
		limit: 100,
		header: false,
		linktarget: '_blank'
	});

});

</script>






<table width="790px" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td valign="top">
	
	<div id="contentbox">
	<h1>About Us</h1>
	<p>ChoiceOne is a privately owned and fully independent Western Australian organisation. The organisation commenced operations in 1989 as three separate divisions known as Choice Personnel, Meditemp and Taskforce. These divisions focused on administration, medical and engineering and industrial personnel respectively. Our mission was to be an innovative and leading edge Recruitment company. This was a time when Western Australia was in recession, work was scarce and employers utilised the services of a recruitment company in order to reduce the workloads from an influx of applications from candidates.</p>
	<p>Since our inception, the business model has been continually developed through the organisation&rsquo;s recognition of the need to provide our customers with a more tailored human resources approach. Our mission has been changed, reflective of the business strategy and is now &ldquo;to be a dynamic leader, providing the best people solutions through successful lasting partnerships&rdquo;.</p>
	<p>These strategic developments are manifested in changes to our service delivery to include areas such as Selection and Recommendation to the public sector, which was established in 2002 and Human Resources Coaching which was established in 2004 to meet the broader needs of our customers. ChoiceOne has also recently established a Safety Consulting arm to the business. Our organisation has survived and thrived through continual changes in the business and economic climate. Over the last 20 years we have seen changes to the recruitment industry driven by skill shortages, IR Laws, technology changes, industry realignment, economic boom and economic bust, companies in receivership, takeovers and mergers and so much more....</p>
	<p>To see how ChoiceOne can assist you, please call (08) 9215 3888 or visit <a href="http://choiceone.com.au/page/contact-us" target="_blank">Contact Us</a>.</p>
	</div>
	</br>
	
	
	<div id="contentbox">
	<h1>Find us around the web</h1>
	We're everywhere! Click a button below to find ChoiceOne on your favorite social network:<br>
	<a href="https://twitter.com/ChoiceOneAU" target="_blank"><img src="http://1stsocial.com.au/fbapps/buttons/twitter.png"></a><br>
	<a href="http://www.linkedin.com/company/choiceone/" target="_blank"><img src="http://1stsocial.com.au/fbapps/buttons/linkedin.png"></a><br>
	<br>
	</div>
	</br>
	
	
	
	<div id="contentbox">
	
	<h1>Didn't find the job you were looking for?</h1>
	As part of the CareersMultiList network we have access to hunderds of other careers that may interest you.<br> <div class="submitCV-SUBMIT"><a href="http://www.1stsocial.com.au/fbapps/CML/jobsearch/index.php">Click Here</a></div>
	</div>
	</br>
	
	</td>
    <td valign="top" width="520"><div id="jobs"></div></td>
  </tr>
</table>


<?php include("http://1stsocial.com.au/fbapps/footer.txt"); ?> 

<div id="fb-root"></div>

</body>
</html>