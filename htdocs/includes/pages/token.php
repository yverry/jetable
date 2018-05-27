<?php

$o_token = '<div id="content">';
include '../includes/generatemail.php';


# bullshit ...

$sql = new Sql();

$token = (string) $arg[2];
$sql_token = 'SELECT email,lifespan,token from '.$sql_table_confirm.' WHERE token = ? LIMIT 1;';
$mark = array($token);
$row = $sql->fetch($sql_token,$mark);

$expire_time = time() ;


if($sql->columnCount() == FALSE || $row == FALSE) {
    $email = 'Unknown';
} else {
    $email_fromtoken = $row['email'];
    $lifespan = $row['lifespan'];
    $expire_time += $lifespan;

    $email = generatealiasforemail($email_fromtoken, 15, $domainarray);
    $timestamp = time();
    $creatime  = $timestamp;
    $exptime   = $timestamp + $lifespan;
    $remote_ip = $_SERVER["REMOTE_ADDR"];
    $emailparts = explode('@', $email);

    $sql_del = 'DELETE FROM `'.$sql_table_confirm.'` WHERE token = ?';
    $mark = array($token);
    $sql->execute($sql_del,$mark);

    // Insert some record, need to be more smart
    //$sql_ins = "INSERT INTO $sql_table (`domain_name`,`local_part`,`remote_name`,`creatime`,`exptime`,`remote_ip`) VALUES('$emailparts[1]', '$emailparts[0]', '$email_fromtoken', NOW(), NOW() + INTERVAL ".$lifespan." second, '$remote_ip');";
    $sql_ins = "INSERT INTO $sql_table (`domain_name`,`local_part`,`remote_name`,`creatime`,`exptime`,`remote_ip`) VALUES(?,?,?,NOW(),NOW() + INTERVAL ? second,?)";
    $mark = array($emailparts[1], $emailparts[0], $email_fromtoken, $lifespan, $remote_ip);
    $sql->execute($sql_ins,$mark);

    try {
	    $sql_ins = "INSERT INTO $sql_table_trust (`email`,`exptime`) VALUES(?,NOW() + INTERVAL ? second)"; // trust email six month
	    $mark = array($email_fromtoken,15552000);
	    $sql->execute($sql_ins,$mark);
    } catch(PDOException $e) {
      if($e->getCode() == 23000) { // handle duplicate
        $sql_ins = "UPDATE $sql_table_trust SET exptime = NOW() + INTERVAL 15552000 second WHERE email = '$email_fromtoken'"; // trust email six month
        $sql->execute($sql_ins);
      }
    }
	


    $stats = new Stats();
    $stats->add_active_alias();

}

$o_token .= '<h1>'.gettext('Confirmation').'</h1>';
$o_token .= '<div id="confirmation">';

$o_token .= '  <p>'.gettext('Your alias is valid until ').date('Y-m-d H:i:s O T',$expire_time).'<span id="aliasgenerated">'.$email.'</span></p>';
$o_token .= '</div>';

$output->add($o_token);

?>
