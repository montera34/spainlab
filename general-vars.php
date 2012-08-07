<?php // main config vars
$general_options = array(
	// vars for meta tags in header
	'metatags' => 'architecture, urbanisme, spain',
	'metaauthor' => 'Spain Lab',
	// vars to avoid more db queries
	'blogname' => get_bloginfo('name'),
	'blogdesc' => get_bloginfo('description'),
	'blogurl' => get_bloginfo('url'),
	'blogtheme' => get_bloginfo('template_directory'),
	// post types
	'pt_a' => 'architects',
	'pt_r' => 'remotes',
	'pt_s' => 'scientifics',
	// stats code
	'stats_code' => 
		'
		<!-- Piwik --> 
		<script type="text/javascript">
		var pkBaseURL = (("https:" == document.location.protocol) ? "https://montera34.com/piwik/" : "http://montera34.com/piwik/");
		document.write(unescape("%3Cscript src=\'" + pkBaseURL + "piwik.js\' type=\'text/javascript\'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		try {
		var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 25);
		piwikTracker.trackPageView();
		piwikTracker.enableLinkTracking();
		} catch( err ) {}
		</script><noscript><p><img src="http://montera34.com/piwik/piwik.php?idsite=25" style="border:0" alt="" /></p></noscript>
		<!-- End Piwik Tracking Code -->
		',
);
?>

