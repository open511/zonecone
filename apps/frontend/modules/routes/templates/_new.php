<h2>Nouveau trajet</h2>

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