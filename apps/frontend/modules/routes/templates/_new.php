<h2>Nouveau trajet</h2>

<div id="switch-to-import" class="explication"><p>Entrez un point de d&eacute;part et une destination et cliquez sur "Afficher le trajet".
        Vous pouvez ensuite modifier le trajet &agrave; votre guise en déplaçant le chemin sur la carte.</p>
<?php if ($sf_user->isAuthenticated()): ?>
     <p>Ensuite nommez votre trajet et sauvegardez-le de mani&egrave;re à recevoir des notifications automatiques.</p>
     <p>De fa&ccedil;on altervative, vous pouvez &eacute;lement <b><a href="#import-file" onclick="showImportFile()">importer un fichier (KML)</a></b> 
<?php endif; ?>
</div>

<?php if ($sf_user->isAuthenticated()): ?>
<div id="switch-to-google" class="explication">
     <p>Il est facile d'exporter un fichier KML &agrave; partir de Google Maps (choisir une adresse et ensuite cliquer sur KML) et de nombreux syst&egrave;me GPS permettent l'export en KML. Une fois ce fichier KML obtenu, il vous suffit de le soumettre avec le formulaire ci-dessous.</p>
     <p>Ou alors <b><a href="#trace-route" onclick="showAskGoogle()">d&eacute;finissez votre route sur la carte.</a></b>
</div>
<?php endif; ?>

<div class="ui-widget" style="padding: 8px 0px;" id="error-widget">
	<div class="ui-state-error ui-corner-all" style="padding: 8px;">
		<p id="error-description">
			<strong>Error:</strong> Unable to get directions. Please make sure you have a proper Internet connection and double check "from" and "to" fields.
		</p>
	</div>
</div>
<div class="location-input">
</div>
<div class="reverse-input">
	<div id="reverse-button"></div>
</div>
<div class="form">
<?php include_partial('form', array('form' => $form)) ?>
</div>
<div id="near">
</div>
