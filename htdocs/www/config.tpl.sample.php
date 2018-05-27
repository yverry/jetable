<?php

# Config in common
$default_lang = 'fr';
$domainarray[0] = 'jetable.org';
#  $domainarray[1] = 'jetable.net';
#  $domainarray[2] = 'jetable.com';
#  $domainarray[3] = 'bibop.fr';
#  $domainarray[4] = 'chipolex.fr';
#  $domainarray[5] = 'ciscal.fr';
#  $domainarray[6] = 'rizaucurry.fr';

$limitnbalias = 1;
define('MAX_ALIAS',10);

$sql_table = 'jetable_forwarder';
$sql_table_confirm = 'jetable_verify';
$sql_table_trust = 'jetable_trust';

define('ENVIRONMENT',$_SERVER['ENVIRONMENT']);
define('PREFIX',$_SERVER['ENVIRONMENT']);
define('NAME_ACTIVE_ALIAS','jetable:stats:active_alias_'.date('Y-m-d'));
define('NAME_DAILY_ALIAS','jetable:stats:daily_alias_'.date('Y-m-d'));


# Specific
switch(ENVIRONMENT) {

	case 'production':

		define('SQL_HOST','');
		define('SQL_USER','');
		define('SQL_PASS','');
		define('SQL_DB','');

		break;

	case 'development':

		define('SQL_HOST','');
		define('SQL_USER','');
		define('SQL_PASS','');
		define('SQL_DB','');

		break;
	default:
		echo "Missing ENVIRONMENT var";
		die();

}

?>
