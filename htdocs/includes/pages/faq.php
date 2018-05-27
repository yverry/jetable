<?php

$faq = '
<div id="content">
<h1>'._("Frequently asked questions").'</h1>

  <ol id="faq-menu">
  <li> <a href="#principe">'._(" What is the principle of a disposable email address?").'</a> </li>
  <li> <a href="#utilite">'._(" What's the use of a disposable email address?").'></a> </li>
  <li> <a href="#logs">'._(" Do you keep logs on this service?").'</a> </li>
  <li> <a href="#pub">'._(" Do you append ads to forwarded emails?").'</a> </li>
  </ol>

  <dl id="faq-answer">
  <dt id="principe">'._("What is the principle of a disposable email address?").'</dt>
  <dd>'._("A disposable email address is a redirection towards your actual email address, and it has a limited lifespan. During all the time specified when you created it, emails sent to this address will be forwarded to your actual address.").'</dd>

  <dt id="utilite">'._("What's the use of a disposable email address?").'</dt>
    <dd>'._("A disposable email address can be used for several reasons.").'
      <ul>
          '._("<li>You want to use a service on a web site that requires a confirmation through email, and you know that this site will sell your address to third parties; with a disposable email address, you can confirm the link that was sent, yet you won't receive any advertisement that would be sent afterwards.</li> <li>You want to participate in a forum, and receive replies through email, yet you don't want your email address to be gathered by robots. Thus the robots will only get the disposable address, and after a while you won't receive any more ads.</li>").'
      </ul>
    </dd>

    <dt id="logs">'. _("Do you keep logs on this service?").'</dt>
    <dd>'. _("Yes, but for legal reasons only. No email address is going to be sold.").'</dd>

    <dt id="pub">'. _("Do you append ads to forwarded emails?").'</dt>
    <dd>'. _("No. Jetable.org is a service provided by the french non-profit association APINC (Association for a Non-Commercial Internet), and the service is totally exempt of ads. This is why there are no banners on our web site either.").'</dd>

  </dl>
</div>';

$output->add($faq);
?>
