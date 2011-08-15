<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php

  if ($sf_user->isAuthenticated()) {$form->setDefault('user_id', $sf_user->getGuardUser()->getId());}

?>

<?php if ($sf_user->isAuthenticated()): ?>
<input type="button" id="switch-to-import" onclick="showImportFile()" value="Importer un fichier (KML, etc.)">
<input type="button" id="switch-to-google" onclick="showAskGoogle()" value="Tracer votre trajet">
<?php endif;?>

<form class="ui-form" action="<?php echo url_for('routes/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>

	<?php 

	foreach ($form as $widget){


	  if (!$sf_user->isAuthenticated()){

		$form->setWidget('distance_within',new sfWidgetFormInputHidden());
		$form->setWidget('name',new sfWidgetFormInputHidden());
	  }


	  
	  if (!$widget->isHidden()){
	    echo "\n<p id='input_". $widget->renderId() ."'><strong>" . $widget->renderLabel()  . "<br/></strong>";
	  }
	    echo $widget->renderError();
	    echo  $widget->render();
	    echo "</p>";

	} 
	?>

<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<div class="formbutton">
          <input type="button" id="plan-button" value="Afficher le trajet" />
 <?php if ($sf_user->isAuthenticated()): ?>
          <input type="submit" id="save-button" value="Sauvegarder" />
<?php endif; ?>
</div>
</form>
