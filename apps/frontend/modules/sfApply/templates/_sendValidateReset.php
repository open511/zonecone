<?php use_helper('I18N', 'Url') ?>
<?php echo __(<<<EOM
<p>
Nous avons reçu une demande de renvoie de votre nom d'utilisateur et de votre mot de passe pour :
%1%
</p>
<p>
Votre nom d'utilisateur est: %USERNAME%
</p>
<p>
Si vous avez perdu votre mot de passe, vous pouvez en générer un nouveau en cliquant sur le lien ci-dessous
</p>
<p>
%2%
</p>
<p>
Votre mot de passe ne sera pas affecté tant que vous n'aurez pas cliqué sur le lien en question et complété le formulaire de réinitialisation du mot de passe.
</p>
EOM
, array("%1%" => link_to($sf_request->getHost(), $sf_request->getUriPrefix()),
  "%2%" => link_to(url_for("sfApply/confirm?validate=$validate", true), "sfApply/confirm?validate=$validate", array("absolute" => true)),
  "%USERNAME%" => $username)) ?>

