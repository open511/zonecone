<?php

/**
 * RwUserRoute filter form base class.
 *
 * @package    roadwork
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRwUserRouteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'          => new sfWidgetFormFilterInput(),
      'name'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'distance_within'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'way_points'       => new sfWidgetFormFilterInput(),
      'transport_type'   => new sfWidgetFormFilterInput(),
      'usage'            => new sfWidgetFormFilterInput(),
      'geom'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RwRoadwork'), 'add_empty' => true)),
      'start_point_name' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'end_point_name'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'user_id'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'name'             => new sfValidatorPass(array('required' => false)),
      'distance_within'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'way_points'       => new sfValidatorPass(array('required' => false)),
      'transport_type'   => new sfValidatorPass(array('required' => false)),
      'usage'            => new sfValidatorPass(array('required' => false)),
      'geom'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RwRoadwork'), 'column' => 'id')),
      'start_point_name' => new sfValidatorPass(array('required' => false)),
      'end_point_name'   => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('rw_user_route_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RwUserRoute';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'user_id'          => 'Number',
      'name'             => 'Text',
      'distance_within'  => 'Number',
      'way_points'       => 'Text',
      'transport_type'   => 'Text',
      'usage'            => 'Text',
      'geom'             => 'ForeignKey',
      'start_point_name' => 'Text',
      'end_point_name'   => 'Text',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}
