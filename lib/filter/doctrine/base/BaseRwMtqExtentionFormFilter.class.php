<?php

/**
 * RwMtqExtention filter form base class.
 *
 * @package    roadwork
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRwMtqExtentionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'mtq_id'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'rw_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RwRoadwork'), 'add_empty' => true)),
      'mtq_url'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'name'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'start_date'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'end_date'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'mtq_update'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'roadname'       => new sfWidgetFormFilterInput(),
      'direction'      => new sfWidgetFormFilterInput(),
      'localisation'   => new sfWidgetFormFilterInput(),
      'identification' => new sfWidgetFormFilterInput(),
      'restriction'    => new sfWidgetFormFilterInput(),
      'workaround'     => new sfWidgetFormFilterInput(),
      'area'           => new sfWidgetFormFilterInput(),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'mtq_id'         => new sfValidatorPass(array('required' => false)),
      'rw_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RwRoadwork'), 'column' => 'id')),
      'mtq_url'        => new sfValidatorPass(array('required' => false)),
      'name'           => new sfValidatorPass(array('required' => false)),
      'start_date'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'end_date'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'mtq_update'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'roadname'       => new sfValidatorPass(array('required' => false)),
      'direction'      => new sfValidatorPass(array('required' => false)),
      'localisation'   => new sfValidatorPass(array('required' => false)),
      'identification' => new sfValidatorPass(array('required' => false)),
      'restriction'    => new sfValidatorPass(array('required' => false)),
      'workaround'     => new sfValidatorPass(array('required' => false)),
      'area'           => new sfValidatorPass(array('required' => false)),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('rw_mtq_extention_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RwMtqExtention';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'mtq_id'         => 'Text',
      'rw_id'          => 'ForeignKey',
      'mtq_url'        => 'Text',
      'name'           => 'Text',
      'start_date'     => 'Date',
      'end_date'       => 'Date',
      'mtq_update'     => 'Date',
      'roadname'       => 'Text',
      'direction'      => 'Text',
      'localisation'   => 'Text',
      'identification' => 'Text',
      'restriction'    => 'Text',
      'workaround'     => 'Text',
      'area'           => 'Text',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
    );
  }
}
