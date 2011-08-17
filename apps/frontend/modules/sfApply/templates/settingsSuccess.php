<?php slot('sf_apply_login') ?>
<?php end_slot() ?>
<?php use_helper("I18N") ?>
<div class="sf_apply sf_apply_settings">
<h2><?php echo __("Account Settings") ?></h2>

<div class="text">
<div class="explication">
<p>Les options sont assez simples : Voulez-vous recevoir des notifications automatiques (apparition et suppression de chantier) concernant les trajets que vous avez sauvegarder?</p></div>

<form method="POST" action="<?php echo url_for("sfApply/settings") ?>" name="sf_apply_settings_form" id="sf_apply_settings_form">
<ul>
<?php echo $form ?>
<li>
<input type="submit" value="<?php echo __("Save") ?>" /> <?php echo(__("or")) ?>
<?php echo link_to(__('Cancel'), sfConfig::get('app_sfApplyPlugin_after', '@homepage')) ?>
</li>
</ul>
</form>
</div>

<div class="text">
<h2><?php echo __('Forgot your password?', null, 'sf_guard') ?></h2>
<div class="explication">
<p>
<?php echo __('Text to go to resent request'); ?>
</p>
</div>

<form method="GET" action="<?php echo url_for("sfApply/resetRequest") ?>" name="sf_apply_reset_request" id="sf_apply_reset_request">
<input type="submit" value="<?php echo __("Reset Password") ?>" />
</form>
</div>


<div class="text">
<h2><?php echo __('Autodestruction') ?></h2>
<div class="explication">
<p>
Le boutton ci-dessous vos permet de supprimer votre compte. En cliquant dessus votre compte ainsi que les donn&eacute;es sauvegard&eacute;es seront supprim&eacute;s. Vous n'existerez plus... du moins pour RoNoMo!
</p></div>

<?php echo link_to(__('[Autodestruction!]'), 'sfApply/delete', array('method' => 'delete', 'confirm' => __('Are you sure? This will delete your account!'))); ?>
</div>
</div>
