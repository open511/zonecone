<?php use_helper('I18N', 'Url') ?>
<?php echo __(<<<EOM
<p>
Merci de vous êtes enregistré sur %1%.
</p>
<p>
De manière à éviter les abus, nous vous demandons d'activer votre compte en cliquant sur le lien ci-dessous:
</p>
<p>
%2%
</p>
<p>
Merci!
</p>
EOM
, array("%1%" => link_to($sf_request->getHost(), $sf_request->getUriPrefix()),
  "%2%" => link_to(url_for("sfApply/confirm?validate=$validate", true), "sfApply/confirm?validate=$validate", array("absolute" => true)))) ?>
