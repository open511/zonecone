<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('RwUserRoute', 'doctrine');

/**
 * BaseRwUserRoute
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property integer $distance_within
 * @property string $way_points
 * @property string $transport_type
 * @property string $usage
 * @property blob $geom
 * @property string $start_point_name
 * @property string $end_point_name
 * @property string $file
 * @property RwRoadwork $RwRoadwork
 * @property RwToRoute $RwToRoute
 * @property Doctrine_Collection $RwNotification
 * 
 * @method integer             getId()               Returns the current record's "id" value
 * @method integer             getUserId()           Returns the current record's "user_id" value
 * @method string              getName()             Returns the current record's "name" value
 * @method integer             getDistanceWithin()   Returns the current record's "distance_within" value
 * @method string              getWayPoints()        Returns the current record's "way_points" value
 * @method string              getTransportType()    Returns the current record's "transport_type" value
 * @method string              getUsage()            Returns the current record's "usage" value
 * @method blob                getGeom()             Returns the current record's "geom" value
 * @method string              getStartPointName()   Returns the current record's "start_point_name" value
 * @method string              getEndPointName()     Returns the current record's "end_point_name" value
 * @method string              getFile()             Returns the current record's "file" value
 * @method RwRoadwork          getRwRoadwork()       Returns the current record's "RwRoadwork" value
 * @method RwToRoute           getRwToRoute()        Returns the current record's "RwToRoute" value
 * @method Doctrine_Collection getRwNotification()   Returns the current record's "RwNotification" collection
 * @method RwUserRoute         setId()               Sets the current record's "id" value
 * @method RwUserRoute         setUserId()           Sets the current record's "user_id" value
 * @method RwUserRoute         setName()             Sets the current record's "name" value
 * @method RwUserRoute         setDistanceWithin()   Sets the current record's "distance_within" value
 * @method RwUserRoute         setWayPoints()        Sets the current record's "way_points" value
 * @method RwUserRoute         setTransportType()    Sets the current record's "transport_type" value
 * @method RwUserRoute         setUsage()            Sets the current record's "usage" value
 * @method RwUserRoute         setGeom()             Sets the current record's "geom" value
 * @method RwUserRoute         setStartPointName()   Sets the current record's "start_point_name" value
 * @method RwUserRoute         setEndPointName()     Sets the current record's "end_point_name" value
 * @method RwUserRoute         setFile()             Sets the current record's "file" value
 * @method RwUserRoute         setRwRoadwork()       Sets the current record's "RwRoadwork" value
 * @method RwUserRoute         setRwToRoute()        Sets the current record's "RwToRoute" value
 * @method RwUserRoute         setRwNotification()   Sets the current record's "RwNotification" collection
 * 
 * @package    roadwork
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRwUserRoute extends sfMapFishRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('rw_user_route');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'rw_user_route_id',
             'length' => 8,
             ));
        $this->hasColumn('user_id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 8,
             ));
        $this->hasColumn('name', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('distance_within', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('way_points', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('transport_type', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('usage', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('geom', 'blob', null, array(
             'type' => 'blob',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('start_point_name', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('end_point_name', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('file', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('RwRoadwork', array(
             'local' => 'geom',
             'foreign' => 'geom'));

        $this->hasOne('RwToRoute', array(
             'local' => 'id',
             'foreign' => 'route_id'));

        $this->hasMany('RwNotification', array(
             'local' => 'id',
             'foreign' => 'route_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}