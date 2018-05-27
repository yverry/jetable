<?php

function make_seed() #php.net/srand
{
    list($usec, $sec) = explode(' ', microtime());
    return (float) $sec + ((float) $usec * 100000);
}

function generatevalidmail ($length, $domainarray)
{
    $availableloginchars = 'abcdefghijklmnopqrstuvwxyz0123456789';

    srand(make_seed());
    $domain = $domainarray[rand()%count($domainarray)];

    $email = '';
    for ($i=0; $i<$length; $i++) {
        $email .= $availableloginchars[rand()%strlen($availableloginchars)];
    }

    $email .= '@';
    $email .= $domain;

    return $email;
}

function emailisvalid($adresse) 
{ 
    $return = false;
    $emailregexp='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#'; 

    if(preg_match($emailregexp,$adresse)) {
        $return = true; 
    }
    return $return;
}

function generatealiasforemail($email, $length, $domainarray)
{
    global $sql_table;  
    global $limitnbalias;

    if (!emailisvalid($email)) {
        $returnvalue = "-1";
    } else {

	$sql = new Sql();
        $query = "SELECT COUNT(*) as nb FROM $sql_table WHERE remote_name=? AND exptime > NOW()";
	$mark = array($email);
        $nbaliasalreadyexisting = $sql->fetch($query,$mark);

        if ($limitnbalias) {
            if ($nbaliasalreadyexisting['nb'] >= MAX_ALIAS) {
                $returnvalue = "-2";
            }
            else {
                $returnvalue = generatevalidmail ($length, $domainarray);
            }
        }
        else {
            $returnvalue = generatevalidmail ($length, $domainarray);  
	}

    }

    return $returnvalue;
}

function generatetoken($length=25) {

    $token = '';
    $availableloginchars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $maxchar = strlen($availableloginchars);
    for ($i=0; $i<$length; $i++) {
        $token .= substr($availableloginchars,mt_rand(0,$maxchar),1);
    }
    return $token;


}
function sendtoken($to,$lang,$token) {

    $from = 'noreply@jetable.org';
    $subject = gettext('e-mail confirmation');
    $urltoken = "http://jetable.org/$lang/token/";
    $urltoken .= $token;

    $content = gettext("Hi,\nTo enable your jetable alias you need to follow this URL:\n");
    $content .= "------------------------\n";
    $content .= "$urltoken\n";
    $content .= "------------------------\n";
    $content .= gettext("\n\nBest Regards\nJetable.org team");

    $headers = "From: $from \r\n";
    $headers .= "To: $to \r\n";
    $headers .= "Reply-To: $from \r\n";
    $headers .= "Subject: $subject \r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $return = mail($to,$subject,$content,$headers);

    return $return;
}
function email_is_trusted($conn_mysql,$email) {

    $sql = 'select count(1) as nb from jetable_trust WHERE email = ?';
    $mark = array($email);
    $res = $sql->fetch($sql,$mark);

    return $res['nb'];
}

?>
