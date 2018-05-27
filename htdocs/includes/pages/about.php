<?php

$about = '
<div id="content">
<h1>'._("About").'</h1>

  <div id="about">
  <p>'._("Jetable.org is a service provided by the APINC (Association for a Non-Commercial Internet) since june 2003.").'</p>

    <ul>
        <li>'.sprintf(_("Administrative director: %s"), "APINC").'</li>
        <li>'.sprintf(_("Webmaster: %s"),"Yann Verry.").'</li>
        <li>'.sprintf(_("Graphical interface, CSS: %s"),"Guy-Philippe Uberos.").'</li>
        <li>'.sprintf(_("PHP coding (for the current version): %s"),"Yann Verry.").'</li>
        <li>'.sprintf(_("PHP coding (for the first version): %s"),"Yann Hamon, Laurent Labat and Rousseau Hervé.").'</li>
        <li>'.sprintf(_("Server maintenance: %s"),"Yann Verry.").'</li>
    </ul>

    <p id="contact">'._("If you want to make any remark, collaboration proposition, gift or insults, the team is reachable at support_@arobase_jetable.org (replace _@arobase_ with @).").'</br>
    '. _("In case of abuse, write to abuse_@arobase_jetable.org (replace _arobase_ with @).").'</p>
  </div>
</div>
';

$output->add($about);

?>
