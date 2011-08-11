<?php

/**
 * RwNotification form base class.
 *
 * @method RwNotification getObject() Returns the current form's model object
 *
 * @package    roadwork
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRwNotificationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'user_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => false)),
      'rw_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RwRoadwork'), 'add_empty' => false)),
      'route_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RwUserRoute'), 'add_empty' => false)),
      'is_sent'    => new sfWidgetFormInputCheckbox(),
      'rw_status'  => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'))),
      'rw_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RwRoadwork'))),
      'route_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RwUserRoute'))),
      'is_sent'    => new sfValidatorBoolean(array('required' => false)),
      'rw_status'  => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('rw_notification[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RwNotification';
  }

}
