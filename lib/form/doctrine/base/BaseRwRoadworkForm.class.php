<?php

/**
 * RwRoadwork form base class.
 *
 * @method RwRoadwork getObject() Returns the current form's model object
 *
 * @package    roadwork
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRwRoadworkForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'source_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RwSource'), 'add_empty' => false)),
      'name'            => new sfWidgetFormTextarea(),
      'raw_description' => new sfWidgetFormTextarea(),
      'road_name'       => new sfWidgetFormTextarea(),
      'start_date'      => new sfWidgetFormDateTime(),
      'end_date'        => new sfWidgetFormDateTime(),
      'url'             => new sfWidgetFormTextarea(),
      'restriction'     => new sfWidgetFormTextarea(),
      'is_active'       => new sfWidgetFormInputCheckbox(),
      'update_flag'     => new sfWidgetFormInputCheckbox(),
      'geom'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RwUserRoute'), 'add_empty' => false)),
      'severity'        => new sfWidgetFormInputText(),
      'start_date_text' => new sfWidgetFormTextarea(),
      'end_date_text'   => new sfWidgetFormTextarea(),
      'description'     => new sfWidgetFormTextarea(),
      'direction'       => new sfWidgetFormTextarea(),
      'workaround'      => new sfWidgetFormTextarea(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'source_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RwSource'))),
      'name'            => new sfValidatorString(),
      'raw_description' => new sfValidatorString(array('required' => false)),
      'road_name'       => new sfValidatorString(array('required' => false)),
      'start_date'      => new sfValidatorDateTime(array('required' => false)),
      'end_date'        => new sfValidatorDateTime(array('required' => false)),
      'url'             => new sfValidatorString(array('required' => false)),
      'restriction'     => new sfValidatorString(array('required' => false)),
      'is_active'       => new sfValidatorBoolean(array('required' => false)),
      'update_flag'     => new sfValidatorBoolean(array('required' => false)),
      'geom'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RwUserRoute'))),
      'severity'        => new sfValidatorInteger(array('required' => false)),
      'start_date_text' => new sfValidatorString(array('required' => false)),
      'end_date_text'   => new sfValidatorString(array('required' => false)),
      'description'     => new sfValidatorString(array('required' => false)),
      'direction'       => new sfValidatorString(array('required' => false)),
      'workaround'      => new sfValidatorString(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('rw_roadwork[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RwRoadwork';
  }

}
