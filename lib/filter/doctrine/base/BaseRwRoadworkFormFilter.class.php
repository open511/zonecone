<?php

/**
 * RwRoadwork filter form base class.
 *
 * @package    roadwork
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRwRoadworkFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'source_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RwSource'), 'add_empty' => true)),
      'name'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'raw_description' => new sfWidgetFormFilterInput(),
      'road_name'       => new sfWidgetFormFilterInput(),
      'start_date'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'end_date'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'url'             => new sfWidgetFormFilterInput(),
      'restriction'     => new sfWidgetFormFilterInput(),
      'is_active'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_uncertain'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_night'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'update_flag'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'geom'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RwUserRoute'), 'add_empty' => true)),
      'severity'        => new sfWidgetFormFilterInput(),
      'start_date_text' => new sfWidgetFormFilterInput(),
      'end_date_text'   => new sfWidgetFormFilterInput(),
      'description'     => new sfWidgetFormFilterInput(),
      'direction'       => new sfWidgetFormFilterInput(),
      'workaround'      => new sfWidgetFormFilterInput(),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'source_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RwSource'), 'column' => 'id')),
      'name'            => new sfValidatorPass(array('required' => false)),
      'raw_description' => new sfValidatorPass(array('required' => false)),
      'road_name'       => new sfValidatorPass(array('required' => false)),
      'start_date'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'end_date'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'url'             => new sfValidatorPass(array('required' => false)),
      'restriction'     => new sfValidatorPass(array('required' => false)),
      'is_active'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_uncertain'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_night'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'update_flag'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'geom'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RwUserRoute'), 'column' => 'id')),
      'severity'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'start_date_text' => new sfValidatorPass(array('required' => false)),
      'end_date_text'   => new sfValidatorPass(array('required' => false)),
      'description'     => new sfValidatorPass(array('required' => false)),
      'direction'       => new sfValidatorPass(array('required' => false)),
      'workaround'      => new sfValidatorPass(array('required' => false)),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('rw_roadwork_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RwRoadwork';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'source_id'       => 'ForeignKey',
      'name'            => 'Text',
      'raw_description' => 'Text',
      'road_name'       => 'Text',
      'start_date'      => 'Date',
      'end_date'        => 'Date',
      'url'             => 'Text',
      'restriction'     => 'Text',
      'is_active'       => 'Boolean',
      'is_uncertain'    => 'Boolean',
      'is_night'        => 'Boolean',
      'update_flag'     => 'Boolean',
      'geom'            => 'ForeignKey',
      'severity'        => 'Number',
      'start_date_text' => 'Text',
      'end_date_text'   => 'Text',
      'description'     => 'Text',
      'direction'       => 'Text',
      'workaround'      => 'Text',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
