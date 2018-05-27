<?php
$footer = '
    <div id="footer"> <div id="logo-footer">
        
        <a href="http://www.apinc.org"><img alt="'._("A service provided by Apinc").'" height="31" width="88" src="/img/logo-apinc.gif" /></a>         
        </div>
      <div id="footer-menu">
        <p>
        
        '._("Please select your language:").'
        </p>
        <ul>
          
	<li><a href="/en/'. $page.'">English</a> </li>
	<li><a href="/ja/'. $page.'">日本語</a> </li>
	<li><a href="/es/'. $page.'">Español</a> </li>
	<li><a href="/de/'. $page.'">Deutsch</a> </li>
	<li><a href="/eo/'. $page.'">Esperanto</a> </li>
	<li><a href="/pt/'. $page.'">Português</a> </li>
	<li><a href="/nl/'. $page.'">Nederlands</a> </li>
	<li><a href="/it/'. $page.'">Italiano</a> </li>
	<li><a href="/zh/'. $page.'">中文</a> </li>          
	<li><a href="/fr/'. $page.'">Français</a> </li>          
          </ul>
      </div>
      <div id="footer-copyright">
        <p>(c) 2004-'.date('Y').', Jetable.org
        </p>
      </div>
    </div>
<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(["setDomains", ["*.jetable.org","*.www.jetable.org","*.jetable.org","*.www.jetable.org"]]);
  _paq.push([\'trackPageView\']);
  _paq.push([\'enableLinkTracking\']);
  (function() {
    var u="//piwik.verry.org/";
    _paq.push([\'setTrackerUrl\', u+\'piwik.php\']);
    _paq.push([\'setSiteId\', \'8\']);
    var d=document, g=d.createElement(\'script\'), s=d.getElementsByTagName(\'script\')[0];
    g.type=\'text/javascript\'; g.async=true; g.defer=true; g.src=u+\'piwik.js\'; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><p><img src="//piwik.verry.org/piwik.php?idsite=8" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->
  </body>
</html>
';

$output->add($footer);
?>
