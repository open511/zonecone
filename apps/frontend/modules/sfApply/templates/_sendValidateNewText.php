<?php use_helper('I18N', 'Url') ?>
<?php echo __(<<<EOM
Merci de vous êtes enregistré sur %1%.

De manière à éviter les abus, nous vous demandons d'activer votre compte en cliquant sur le lien ci-dessous:

%2%

Merci!
EOM
, array("%1%" => $sf_request->getHost(),
  "%2%" => url_for("sfApply/confirm?validate=$validate", true))) ?>
