<?php
$o_confirm = '<div id="content">';

include '../includes/generatemail.php';

$post_email = $_POST['email'];
$email = generatealiasforemail($post_email, 15, $domainarray);

if ($email == "-1") {

	$o_confirm .= '<h1><span class="error">'.gettext('Error:').'</span>'. gettext('Invalid email address').'</h1>';
	$o_confirm .= '<div id="confirmation">';
	$o_confirm .= '  <p>'.gettext('The email address you have submitted looks invalid.<br />Your disposable email address could not be created.').'</p>';
	$o_confirm .= '</div>';
}
elseif ($email == "-2") {

	$o_confirm .=  '<h1><span class="error">'.gettext('Error:').'</span>'.gettext(' Too many aliases').'</h1>';
	$o_confirm .=  '<div id="confirmation">';
	$o_confirm .=  '  <p>'.gettext('You already have '). MAX_ALIAS . gettext(' aliases on ') . $post_email . gettext(', your disposable email address could not be created.').'</p>';
	$o_confirm .=  '</div>';
}
else {
	$availablelength = array('3600', '86400', '604800', '2592000');
	if (!in_array((int)$_POST['time'], $availablelength)) {

		$o_confirm .=  '<h1><span class="error">'. gettext('Error:').'</span> '.gettext('Invalid lifespan').'</h1>';
		$o_confirm .=  '<div id="confirmation">';
		$o_confirm .=  '  <p>'.gettext('The lifespan you submitted is invalid, your disposable email address could not be created.').'</p>';
		$o_confirm .=  '</div>';
	}
	else {
		$emailsentparts = explode('@', $post_email);

		if (in_array($emailsentparts[1], $domainarray)) {

			$o_confirm .=  '<h1><span class="error">'.gettext('Error:').'</span>'.gettext(' creation not possible').'</h1>';
			$o_confirm .=  '<div id="confirmation">';
			$o_confirm .=  '  <p>'.gettext('You cannot create a disposable email address that points to a disposable email address.').'</p>';
			$o_confirm .=  '</div>';
		}
		else {
			/*
			 * Send email with a token
			 * or not ...
			 */

			$token = generatetoken();
			$remote_ip = $_SERVER["REMOTE_ADDR"];
			$lifespan = $_POST['time'];
			//$token_sql = 'INSERT INTO '. $sql_table_confirm .' (token,email,lifespan,remote_ip) VALUES(\''.$token.'\',\''.$post_email.'\',\''.$lifespan.'\',\''.$remote_ip.'\');';
			$token_sql = 'INSERT INTO '. $sql_table_confirm .' (token,email,lifespan,remote_ip) VALUES(?,?,?,?)';
			$mark = array($token,$post_email,$lifespan,$remote_ip);
			$sql = new Sql();
			$sql->execute($token_sql,$mark);

			// E-mail already trust ?
			$query = 'SELECT email from '.$sql_table_trust.' WHERE email = \''.$post_email.'\' and exptime > NOW()';
			$result = $sql->fetch($query);

			// redirect if email is valid
			if($result) {
				header('Location: /'.$lang.'/token/'.$token);
			} else {
				sendtoken($post_email,$lang,$token);

				$o_confirm .=  '<h1>'.gettext('Confirmation').'</h1>';
				$o_confirm .=  '<div id="confirmation">';
				$o_confirm .=  '  <p>'.gettext('To authenticate your mail, a validation was sent').'</p>';
				$o_confirm .=  '</div>';

			}

		}
	}
}

$output->add($o_confirm);


?>
