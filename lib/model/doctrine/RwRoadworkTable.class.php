<?php

/**
 * RwRoadworkTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class RwRoadworkTable extends sfMapFishTable 
{
    /**
     * Returns an instance of this class.
     *
     * @return object RwRoadworkTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('RwRoadwork');
    }

    /**
     * Same as regular get Table but process the geom field to fetch as a WKT entity
     * Parameter ID allow to get a record by its ID
     * @return object RwRoadworkTable
     */
    public function getTableWithGeom($id = null) {

//TODO have the field name and 4326 set as configuration constants
//TODO also : it might be possible to avoir the "select(*) and the from statement...
    	
      $q = mfQuery::create('geom', 4326)
		  ->select('*')
        ->from('rwRoadwork');
        
      //if(isset($id)){
      //	$q->addWhere("id = ?", $id);	
      //}

     $q->where("is_active = ?", true)
        ->orWhere("is_active = false AND date_trunc('day', \"end_date\") >= CURRENT_DATE");
	     
	   return $q->execute();     
	 }



	    /**
	     * Retrieve one object. 
	     * @return object RwRoadworkTable (should return a RW object insteat but stay like that for histical reason :p)
	     */
	    public function getRwById($id) {
    //TODO change in order to retrieve just an object instead of the table... but the behaviour of the caller will change...
	//TODO have the field name and 4326 set as configuration constants
	//TODO also : it might be possible to avoir the "select(*) and the from statement...

	      $q = mfQuery::create('geom', 4326)
			  ->select('*')
	        ->from('rwRoadwork');

	      	$q->addWhere("id = ?", $id);	

		   return $q->execute();     
		 }

    /**
     * Same as regular get Table but get only "public" field to be displayed in an API Query
     * Parameter ID allow to get a record by its ID
     * @return object RwRoadworkTable
     */
    public function getJsonTableWithGeom($id = null) {

      $rws = $this->getTableWithGeom();
		$output = array();

      foreach ($rws as $i => $rw){
         $output[$i] =  $rw->getPublicAttributes();
      }

      return $output;    	
	 }
	 
	 
    /**
     * Returns an instance of this class.
     * Retrieves only a record with the exact same geom
     *
     * @return object RwRoadwork element
     */	 
    public function getTableByGeom($geom) {
    	
      $q = mfQuery::create('geom', 4326)
		  ->select('*')
        ->from('rwRoadwork')
        ->where('geom = GEOMETRYFROMTEXT(?, ?)', array($geom, '4326'));
	     
	   return $q->fetchOne();     
	 }	 
	 
    /**
     * Returns an instance of this class.
     * Retrieves roadworks close enough of the geometry received as parameter
     *
     * @return object RwRoadworkTable
     */		 
    public function getRwNear($geom) {
    	
      $q = mfQuery::create('geom', 4326)
		  ->select('*')
        ->from('rwRoadwork')
        ->where('ST_DWithin(ST_GeomFromText(\''. $geom .'\', 4326), geom,  0.002)');
	     
	   return $q->execute();     
	 }	 	 

    /**
     * Count the number of roadwork near a given geom
     *
     * @return object array
     */		 
    public function countRwNear($geom) {

        //Can't get DISTINCT clause working with the ORM, so let's go for some raw SQL!
		return Doctrine_Manager::getInstance()->getCurrentConnection()
		  ->fetchArray('SELECT COUNT(id) from rw_roadwork where ST_DWithin(ST_GeomFromText(\''. $geom .'\', 4326), geom,  0.002)');
  
	 }
	 
    /**
     * Update the geometry field using WKT statements
     * As it's not possible to insert directly geometry elements with Doctrine
     * the insert is done without the geometry and then the geometry is added with this function
     *
     * @return ???
     */		 	 
	 public function updateGeometry ($geometry, $id){
	 	
	 	 $q = $this->createQuery('a')
          ->update()
          ->set('geom', 'GEOMETRYFROMTEXT(?, ?)', array($geometry, '4326'))
          ->where($this->getIdentifier().' = ?', $id);
          
       return $q->execute();
	 	
	 }
}
