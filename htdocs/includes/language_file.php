<?php

function get_pref_language_array($str_http_languages) {
	$langs = explode(',',$str_http_languages);
	$qcandidat = 0;
	$nblang = count($langs);

	for ($i=0; $i<$nblang; $i++)
	{
		for ($j=0; $j<count($langs); $j++) {
			$lang = trim($langs[$j]); // Supprime les espaces avant et après $lang
			// Lang est de la forme langue;q=valeur

			if (!strstr($lang, ';') && $qcandidat != 1) {
				// Si la chaine ne contient pas de valeur de préférence q
				$candidat = $lang;
				$qcandidat = 1;
				$indicecandidat = $j;
			}
			else {
				// On récupère l'indice q
				$q = ereg_replace('.*;q=(.*)', '\\1', $lang);

				if ($q > $qcandidat) {
					$candidat = ereg_replace('(.*);.*', '\\1', $lang); ;
					$qcandidat = $q;
					$indicecandidat = $j;
				}
			}
		}

		$resultat[$i] = $candidat;

		$qcandidat=0;
		// On supprime la valeur du tableau
		unset($langs[$indicecandidat]);
		$langs = array_values($langs);
	}
	return $resultat;
}

/*
   if ($_COOKIE['prefslanguageselection']) {
   $language = $_COOKIE['prefslanguageselection'];
   } else if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])) {
 */
if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])) {
	$preflang = get_pref_language_array($_SERVER["HTTP_ACCEPT_LANGUAGE"]);
	$availablelang = array('fr', 'en', 'ja', 'es', 'de', 'eo', 'pt', 'nl', 'it', 'zh');
	$result = array_intersect($preflang, $availablelang);
	if (count($result) != 0) {
		$language = array_shift($result);
	} else {
		$language = $default_lang;
	}

} else {
	$language = $default_lang;
}

$lang_httpheader2langname = array('fr' => 'fr', 'en' => 'en', 'ja' => 'ja', 'es' => 'es', 'de' => 'de', 'eo' => 'eo', 'pt' => 'pt', 'nl' => 'nl', 'it' => 'it', 'zh' => 'zh');
$lang_httpheader2locale = array('fr' => 'fr_FR', 'fr_FR' => 'fr_FR', 'en' => 'en_US', 'en-gb' => 'en_EN', 'en-us' => 'en_US', 'ja' => 'ja_JP', 'es' => 'es_ES', 'de' => 'de_DE', 'eo' => 'eo', 'pt' => 'pt_PT', 'nl' => 'nl_NL', 'it' => 'it_IT', 'zh' => 'zh_CN');

if (!isset($lang_httpheader2langname[$language])) {
	$language = $default_lang;
} else {
	$language = $lang_httpheader2langname[$language];
}

$language_code = $lang_httpheader2locale[$language];

?>
