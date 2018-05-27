<?php
die();
  require_once '../config.tpl.php';
  require_once '../../includes/generatemail.php';

  $post_email = addslashes($_POST['email']);
  $post_time = addslashes($_POST['time']);
  
  $email = generatealiasforemail($post_email, 15, $domainarray);

  if ($email == "-1") {
    echo '1'; // Invalid email adress
  }
  elseif ($email == "-2") {
    echo '2'; // Too many aliases
  }
  else {
    $availablelength = array('3600','86400', '172800', '345600', '518400', '691200');
    if (!in_array($post_time, $availablelength)) {
      echo '3'; // Invalid lifespan
    }
    else {
      $emailsentparts = explode('@', $post_email);
      if (in_array($emailsentparts[1], $domainarray)) {
        echo '4'; // You cannot create a disposable email address that points to a disposable email address
      }
      else {
        $timestamp = time();
        $creatime  = $timestamp;
        $exptime   = $timestamp + $post_time;
        $remote_ip = addslashes($_SERVER["REMOTE_ADDR"]);
        $postedemail = addslashes($post_email);
        $emailparts = explode('@', $email);

        $insReq = "INSERT INTO $sql_table (`domain_name`,`local_part`,`remote_name`,`creatime`,`exptime`,`remote_ip`) VALUES('$emailparts[1]', '$emailparts[0]', '$postedemail', NOW(), NOW() + INTERVAL ".$post_time." second, '$remote_ip')";
	$con = mysqli_connect($sql_host, $sql_user, $sql_pass);
        mysqli_select_db($sql_base);
        mysqli_query("$insReq");
        mysqli_close();

        echo $email;

      }
    }
  }
?>
