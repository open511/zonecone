<?php

/**
 * RwRoadwork form.
 *
 * @package    roadwork
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RwRoadworkForm extends BaseRwRoadworkForm
{
  public function configure()
  {
		$this->setWidget('geom',new sfWidgetFormInputHidden());
		$this->setValidator('geom',new sfValidatorString());
  }

  public function unsetGeom(){
         unset($this['geom']);
  }
  
  public function getGeom(){
         return $this->getValue('geom');
  }

}
