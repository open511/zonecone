<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('RwMtqExtention', 'doctrine');

/**
 * BaseRwMtqExtention
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $mtq_id
 * @property integer $rw_id
 * @property string $mtq_url
 * @property string $name
 * @property timestamp $start_date
 * @property timestamp $end_date
 * @property timestamp $mtq_update
 * @property string $roadname
 * @property string $direction
 * @property string $localisation
 * @property string $identification
 * @property string $restriction
 * @property string $workaround
 * @property string $area
 * @property RwRoadwork $RwRoadwork
 * 
 * @method integer        getId()             Returns the current record's "id" value
 * @method string         getMtqId()          Returns the current record's "mtq_id" value
 * @method integer        getRwId()           Returns the current record's "rw_id" value
 * @method string         getMtqUrl()         Returns the current record's "mtq_url" value
 * @method string         getName()           Returns the current record's "name" value
 * @method timestamp      getStartDate()      Returns the current record's "start_date" value
 * @method timestamp      getEndDate()        Returns the current record's "end_date" value
 * @method timestamp      getMtqUpdate()      Returns the current record's "mtq_update" value
 * @method string         getRoadname()       Returns the current record's "roadname" value
 * @method string         getDirection()      Returns the current record's "direction" value
 * @method string         getLocalisation()   Returns the current record's "localisation" value
 * @method string         getIdentification() Returns the current record's "identification" value
 * @method string         getRestriction()    Returns the current record's "restriction" value
 * @method string         getWorkaround()     Returns the current record's "workaround" value
 * @method string         getArea()           Returns the current record's "area" value
 * @method RwRoadwork     getRwRoadwork()     Returns the current record's "RwRoadwork" value
 * @method RwMtqExtention setId()             Sets the current record's "id" value
 * @method RwMtqExtention setMtqId()          Sets the current record's "mtq_id" value
 * @method RwMtqExtention setRwId()           Sets the current record's "rw_id" value
 * @method RwMtqExtention setMtqUrl()         Sets the current record's "mtq_url" value
 * @method RwMtqExtention setName()           Sets the current record's "name" value
 * @method RwMtqExtention setStartDate()      Sets the current record's "start_date" value
 * @method RwMtqExtention setEndDate()        Sets the current record's "end_date" value
 * @method RwMtqExtention setMtqUpdate()      Sets the current record's "mtq_update" value
 * @method RwMtqExtention setRoadname()       Sets the current record's "roadname" value
 * @method RwMtqExtention setDirection()      Sets the current record's "direction" value
 * @method RwMtqExtention setLocalisation()   Sets the current record's "localisation" value
 * @method RwMtqExtention setIdentification() Sets the current record's "identification" value
 * @method RwMtqExtention setRestriction()    Sets the current record's "restriction" value
 * @method RwMtqExtention setWorkaround()     Sets the current record's "workaround" value
 * @method RwMtqExtention setArea()           Sets the current record's "area" value
 * @method RwMtqExtention setRwRoadwork()     Sets the current record's "RwRoadwork" value
 * 
 * @package    roadwork
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRwMtqExtention extends sfMapFishRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('rw_mtq_extention');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'rw_mtq_extention_id',
             'length' => 8,
             ));
        $this->hasColumn('mtq_id', 'string', 12, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 12,
             ));
        $this->hasColumn('rw_id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 8,
             ));
        $this->hasColumn('mtq_url', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('name', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('start_date', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('end_date', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('mtq_update', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('roadname', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('direction', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('localisation', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('identification', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('restriction', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('workaround', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('area', 'string', null, array(
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
             'local' => 'rw_id',
             'foreign' => 'id',
             'onDelete' => 'cascade'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}