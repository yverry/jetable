<?php
# -- BEGIN LICENSE BLOCK ---------------------------------------
#
# This file is part of Jetable - APINC
# Yann Verry
#
# Licensed under the GPL version 2.0 license.
# See LICENSE file or
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
#
# -- END LICENSE BLOCK -----------------------------------------


# variables config
# need to be moved in config file
$default_lang = 'en_US';
$lang_httpheader2locale = array('fr' => 'fr_FR', 'fr_FR' => 'fr_FR', 'fr-FR' => 'fr_FR', 'en-US' => 'en_US', 'en' => 'en_US', 'en-gb' => 'en_EN', 'en-us' => 'en_US', 'ja' => 'ja_JP', 'es' => 'es_ES', 'de' => 'de_DE', 'eo' => 'eo', 'pt' => 'pt_PT', 'nl' => 'nl_NL', 'it' => 'it_IT', 'zh' => 'zh_CN');
$titlename = array( 'index' => 'Home', 'faq' => 'Faq', 'about' => 'About', 'confirm' => 'Confirm', 'token' => 'e-mail validation','stats' => 'Statistics','ssl' => 'SSL');

$gettext_domain = 'jetable';


$get_arg = htmlspecialchars($_GET['arg']);

if(isset($get_arg) && $get_arg != "") {
    $arg = explode('/', $get_arg);
    if (count($arg) > 3) { # humm trouble safe now
        header('Location: /');
        exit();
    }
} else {
    include '../includes/language_file.php';
    $arg = 'index';
    $url = $language.'/index';
    header("Location: /$url");
    exit();
}


$lang = $arg[0];

if(array_key_exists($lang,$lang_httpheader2locale)) {
    $language_code = $lang_httpheader2locale[$lang];
} else {
    header('Location: /en/index');
    exit();
}



$page = $arg[1];

$locale = $language_code . '.utf8';


# gettext
$directory = '../gettext';

putenv("LC_ALL=$locale");
setlocale(LC_ALL, $locale);

bindtextdomain($gettext_domain, $directory);
textdomain($gettext_domain);
bind_textdomain_codeset($gettext_domain, 'UTF-8'); 


if (file_exists('../includes/pages/'.$page.'.php')) {

    include '../includes/class.inc.php';
    include './config.tpl.php';

    $output = new Output();

    include '../includes/header.php';
    include '../includes/pages/'.$page.'.php';
    include '../includes/footer.php';

    $output->display();

} else { # 404 -> return to home
    header('Location: /');
}


?>
