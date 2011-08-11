<?php

/**
 * RwMtqExtention form.
 *
 * @package    roadwork
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RwMtqExtentionForm extends BaseRwMtqExtentionForm
{
  public function configure()
  {

    $this->setWidget('rw_id', new sfWidgetFormInputText());


    $this->setValidator('rw_id', new sfValidatorString());

  }
}
