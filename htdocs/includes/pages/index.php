<?php
$index = '
  <div id="index-container">
    <div id="index">
      <div id="content-email">
        <div id="email-box">
            <form action="./confirm" method="post">
            <p><strong>'. _("Email address: ").'</strong><input type="email" name="email" alt="Email address" /></p>
            <p><strong>'. _("Life span: ").'</strong>

              <select name="time">
              <option value="3600" selected="selected">'. _("One hour").'</option>
              <option value="86400">'. _("One day").'</option>
              <option value="604800">'. _("One week").'</option>
              <option value="2592000">'. _("One month").'</option>
              </select>
              <br/><br/>
              <input type="submit" value="'. _("Create your disposable email address").'" alt="'. _("Create your disposable email address").'" />
              </p>
            </form>
        </div>
      </div>
      <div id="content-box">
        <div id="info-box">

        <h2>'. _("How this service works").'</h2>
          <p>
'. _("To avoid spam, jetable.org provides you with a temporary email address.\nAs soon as it is created, all the emails sent to this address are forwarded to your actual email address.<br /><br />\nYour antispam address will be deactivated after the lifespan you selected comes to its end.").'
</p>

        </div>
        <div id="important-box">
        <h2>'. _("Important").'</h2>
            <p>
            <strong>'. _("NB:").'</strong> '. _("jetable.org").' <strong>'. _("IS NOT").'</strong> '. _("an anonymous email service: email headers are not modified and we keep the logs of this service.").'
            </p>

        </div>
      </div>
    </div>
  </div>
</body>
</html>';

$output->add($index);

?>
