<?php

/**
 * RwUserRoute form base class.
 *
 * @method RwUserRoute getObject() Returns the current form's model object
 *
 * @package    roadwork
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRwUserRouteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'user_id'          => new sfWidgetFormInputText(),
      'name'             => new sfWidgetFormTextarea(),
      'distance_within'  => new sfWidgetFormInputText(),
      'way_points'       => new sfWidgetFormTextarea(),
      'transport_type'   => new sfWidgetFormTextarea(),
      'usage'            => new sfWidgetFormTextarea(),
      'geom'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RwRoadwork'), 'add_empty' => false)),
      'start_point_name' => new sfWidgetFormTextarea(),
      'end_point_name'   => new sfWidgetFormTextarea(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'          => new sfValidatorInteger(array('required' => false)),
      'name'             => new sfValidatorString(),
      'distance_within'  => new sfValidatorInteger(),
      'way_points'       => new sfValidatorString(array('required' => false)),
      'transport_type'   => new sfValidatorString(array('required' => false)),
      'usage'            => new sfValidatorString(array('required' => false)),
      'geom'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RwRoadwork'))),
      'start_point_name' => new sfValidatorString(),
      'end_point_name'   => new sfValidatorString(),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('rw_user_route[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RwUserRoute';
  }

}
