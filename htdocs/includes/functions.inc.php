<?php
function get_pref_language_array($str_http_languages)
{
  $langs = explode(',',$str_http_languages);
  $qcandidat = 0;
  $nblang = count($langs);

  for ($i=0; $i<$nblang; $i++)
  {
    for ($j=0; $j<count($langs); $j++) {
      $lang = trim($langs[$j]); // Supprime les espaces avant et apr<E8>s $lang
      // Lang est de la forme langue;q=valeur

      if (!strstr($lang, ';') && $qcandidat != 1) {
        // Si la chaine ne contient pas de valeur de pr<E9>f<E9>rence q
        $candidat = $lang;
        $qcandidat = 1;
        $indicecandidat = $j;
      }
      else {
        // On r<E9>cup<E8>re l'indice q
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
?>
