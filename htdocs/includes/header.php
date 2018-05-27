<?php
$header = '<!doctype html>
<head>
  <link rel="stylesheet" type="text/css" href="/style/screen.css"  />
  <meta http-equiv="Content-Type" content="text/HTML; charset=UTF-8"  />
  <meta charset="utf-8" />
  <meta http-equiv="keywords" name="keywords" content="jetable, anti-spam, temporary email address, anonymous, mail, forward, alias" />
  <meta http-equiv="description" content="'._("Create jetable email address to avoid spam").'" />
  <title>Jetable.org - '._($titlename[$page]).'</title>
';

/*
if($titlename[$page] == 'Statistics') {
$header .= '
	<script type="text/javascript" src="/js/enhance.js"></script>	
	<script type="text/javascript">
		// Run capabilities test
		enhance({
			loadScripts: [
				{src: \'/js/excanvas.js\', iecondition: \'all\'},
				\'/js/jquery.js\',
				\'/js/visualize.jQuery.js\',
				\'/js/jetable_stats.js\'
			],
			loadStyles: [
				\'/style/visualize.css\',
				\'/style/visualize-light.css\'
			]	
		});   
    </script>
<script src="/mint/?js" type="text/javascript"></script>

';
}
*/

$header .= '
</head>
<body>
<div id="header">
    <div id="header-logo">
        <a href="http://www.jetable.org"><img alt="'._("Jetable.org - A service provided by Apinc").'" height="86" width="245" src="/img/logo.png"  /></a>
    </div>
    <div id="header-menu">
        <div id="menu-spacer">
            <div id="menu">
                <ul>
                <li><a href="/'.$lang.'/index">'._("Home").'</a> | </li>
                    <li><a href="/'.$lang.'/faq">'._("Faq").'</a> | </li>
                    <li><a href="/'.$lang.'/stats">'. _("Statistics").'</a> | </li>
                    <li><a href="/'.$lang.'/about">'. _("About").'</a> | </li>
                    <!--li><a href="/'.$lang.'/ssl">'. _("SSL").'</a> | </li>-->
              </ul>
            </div>
        </div>
    </div>
</div>
';

$output->add($header);

?>
