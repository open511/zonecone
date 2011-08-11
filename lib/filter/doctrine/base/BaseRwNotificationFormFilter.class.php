<?php

/**
 * RwNotification filter form base class.
 *
 * @package    roadwork
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRwNotificationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'rw_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RwRoadwork'), 'add_empty' => true)),
      'route_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RwUserRoute'), 'add_empty' => true)),
      'is_sent'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'rw_status'  => new sfWidgetFormFilterInput(),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'user_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'rw_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RwRoadwork'), 'column' => 'id')),
      'route_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RwUserRoute'), 'column' => 'id')),
      'is_sent'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'rw_status'  => new sfValidatorPass(array('required' => false)),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('rw_notification_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RwNotification';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'user_id'    => 'ForeignKey',
      'rw_id'      => 'ForeignKey',
      'route_id'   => 'ForeignKey',
      'is_sent'    => 'Boolean',
      'rw_status'  => 'Text',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}
