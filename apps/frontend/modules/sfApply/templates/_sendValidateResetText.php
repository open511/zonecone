<?php use_helper('I18N', 'Url') ?>
<?php echo __(<<<EOM
Nous avons reçu une demande de renvoie de votre nom d'utilisateur et de votre mot de passe pour :
%1%

Votre nom d'utilisateur est : %USERNAME%

Si vous avez perdu votre mot de passe, vous pouvez en générer un nouveau en cliquant sur le lien ci-dessous
%2%

Votre mot de passe ne sera pas affecté tant que vous n'aurez pas cliqué sur le lien en question et complété le formulaire de réinitialisation du mot de passe.
EOM
, array("%1%" => url_for($sf_request->getUriPrefix()),
  "%2%" => url_for("sfApply/confirm?validate=$validate", true),
  "%USERNAME%" => $username)) ?>

