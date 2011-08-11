<?php

/**
 * sfGuardUserProfile filter form base class.
 *
 * @package    roadwork
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserProfileFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'email'             => new sfWidgetFormFilterInput(),
      'fullname'          => new sfWidgetFormFilterInput(),
      'validate'          => new sfWidgetFormFilterInput(),
      'send_notification' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'user_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'email'             => new sfValidatorPass(array('required' => false)),
      'fullname'          => new sfValidatorPass(array('required' => false)),
      'validate'          => new sfValidatorPass(array('required' => false)),
      'send_notification' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'user_id'           => 'ForeignKey',
      'email'             => 'Text',
      'fullname'          => 'Text',
      'validate'          => 'Text',
      'send_notification' => 'Boolean',
    );
  }
}
