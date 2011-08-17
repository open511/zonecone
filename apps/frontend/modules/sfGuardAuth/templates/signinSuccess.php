<?php use_helper('I18N') ?>

<div class="text">
<h2><?php echo __('Signin', null, 'sf_guard') ?></h2>
<?php echo get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?>
</div>

<div class="text">
<h2><?php echo __('Forgot your password?', null, 'sf_guard') ?></h2>
<form method="GET" action="<?php echo url_for("sfApply/resetRequest") ?>" name="sf_apply_reset_request" id="sf_apply_reset_request">
<p>
<?php echo __('Text to go to resent request'); ?>
</p>
<input type="submit" value="<?php echo __("Reset Password") ?>" />
</form>
</div>
