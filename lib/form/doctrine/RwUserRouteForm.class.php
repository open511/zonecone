<?php

/**
 * RwUserRoute form.
 *
 * @package    roadwork
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RwUserRouteForm extends BaseRwUserRouteForm
{
  public function configure()
  {
	
	$this->useFields(array('start_point_name', 'end_point_name', 'name', 'way_points', 'geom', 'user_id'));


	$this->setWidget('geom',new sfWidgetFormInputHidden());
	$this->setWidget('user_id',new sfWidgetFormInputHidden());
	$this->setWidget('way_points',new sfWidgetFormInputHidden());
	$this->setWidget('start_point_name',new sfWidgetFormInputText());
	$this->setWidget('end_point_name',new sfWidgetFormInputText());
	$this->setWidget('name',new sfWidgetFormInputText());
    $this->setValidator('geom',new sfValidatorString());

	
	$this->widgetSchema->setLabels(array(
	  'start_point_name'    => 'D&eacute;part',
	  'end_point_name'      => 'Destination',
	  'name'   => 'Nom du trajet',
	));
	
  }
  
  public function unsetGeom(){
         unset($this['geom']);
  }
  
  public function getGeom(){
         return $this->getValue('geom');
  }
  
}
