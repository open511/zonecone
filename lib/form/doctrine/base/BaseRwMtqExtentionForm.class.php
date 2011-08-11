<?php

/**
 * RwMtqExtention form base class.
 *
 * @method RwMtqExtention getObject() Returns the current form's model object
 *
 * @package    roadwork
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRwMtqExtentionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'mtq_id'         => new sfWidgetFormInputText(),
      'rw_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RwRoadwork'), 'add_empty' => true)),
      'mtq_url'        => new sfWidgetFormTextarea(),
      'name'           => new sfWidgetFormTextarea(),
      'start_date'     => new sfWidgetFormDateTime(),
      'end_date'       => new sfWidgetFormDateTime(),
      'mtq_update'     => new sfWidgetFormDateTime(),
      'roadname'       => new sfWidgetFormTextarea(),
      'direction'      => new sfWidgetFormTextarea(),
      'localisation'   => new sfWidgetFormTextarea(),
      'identification' => new sfWidgetFormTextarea(),
      'restriction'    => new sfWidgetFormTextarea(),
      'workaround'     => new sfWidgetFormTextarea(),
      'area'           => new sfWidgetFormTextarea(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'mtq_id'         => new sfValidatorString(array('max_length' => 12)),
      'rw_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RwRoadwork'), 'required' => false)),
      'mtq_url'        => new sfValidatorString(),
      'name'           => new sfValidatorString(),
      'start_date'     => new sfValidatorDateTime(),
      'end_date'       => new sfValidatorDateTime(),
      'mtq_update'     => new sfValidatorDateTime(array('required' => false)),
      'roadname'       => new sfValidatorString(array('required' => false)),
      'direction'      => new sfValidatorString(array('required' => false)),
      'localisation'   => new sfValidatorString(array('required' => false)),
      'identification' => new sfValidatorString(array('required' => false)),
      'restriction'    => new sfValidatorString(array('required' => false)),
      'workaround'     => new sfValidatorString(array('required' => false)),
      'area'           => new sfValidatorString(array('required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('rw_mtq_extention[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RwMtqExtention';
  }

}
