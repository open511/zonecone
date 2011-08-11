<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(dirname(__FILE__).'/../lib/BasesfGuardAuthActions.class.php');

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php 23319 2009-10-25 12:22:23Z Kris.Wallsmith $
 */
class sfGuardAuthActions extends BasesfGuardAuthActions
{

  public function executeShowform(sfWebRequest $request)
  {

    if (!$this->getUser()->isAuthenticated()){

      $class = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin');
      $this->form = new $class();

      return $this->renderPartial('sfGuardAuth/signin_form', array('form' => $this->form));
    } else {
      return $this->renderText('You are authenticated');
    }
  }


}
