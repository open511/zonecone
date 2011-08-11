<?php

/**
 * VGMLCollection
 * 
 * Collection of Vgml objects
 */
class CSVMTQCollection 
{
  protected $csvmtqCollection;
  protected $roadworks = array();
  public static $sourceId;

  public static function loadSource($source){

	
	$csvs = new CSVMTQCollection();

	$csvs->csvmtqCollection = fopen($source->url, "r");
	
	/*
			while (($buffer = fgets($handle, 4096)) !== false) {
				$data = explode(",", $buffer);
				if (count($data) > 2){

	$csvs->vgmlCollection = simplexml_load_file($source->url);*/

	
	self::$sourceId = $source->id;
	$csvs->parseSource();
	
	return $csvs->roadworks;
  }

  protected function parseSource(){

    while (($line = fgets($this->csvmtqCollection, 4096)) !== false) {
	  if (strlen($line) > 5){
        if ($roadwork = CSVMTQ::buildRw($line)){
	      if ($roadwork->rwStatus != RwRoadwork::$rwStatusEnum['no_change']){
            $this->roadworks[] = $roadwork;
	      }
        } else {
        	 echo "ERROR -  invalid roadwork\n";
        	 //todo : throw some exception here..
        } 
      }
    } 

/*
    foreach ($this->vgmlCollection->Document->Folder as $folder) {
      foreach ($folder->Placemarks->Placemark as $place) {
        if ($roadwork = VGML::buildRw($place)){
	      if ($roadwork->rwStatus != RwRoadwork::$rwStatusEnum['no_change']){
            $this->roadworks[] = $roadwork;
	      }
        } else {
        	 echo "ERROR -  invalid roadwork\n";
        	 //todo : throw some exception here..
        }  
      }
    }*/	
  }
}

/**
 * CSV object (following usual display of the MTQ)
 * 
 * CSVMTQ object + function needed to build a roadwork object from a CSV line
 */
class CSVMTQ
{
	private $rawData;  //C'est RawVFML pour l'autre
	private $rawGeom;
	private $geomType;
	private $coordinates;
	private $visibility;
	private $infoSideBar;
	private $rawDescription;
	protected $name;
	protected $formattedGeom;
	protected $description;
	protected $roadName;
	protected $endDate;
	protected $startDate;
	protected $url;
	protected $restriction;
	protected $rwUpdates;

	function __construct($csvLine){

		$this->rawData = explode(",", str_replace('"', '', $csvLine));
		$return_value = $this->buildGeom();		
		$this->extractDates();
		$this->extractRoadName();
		$this->extractName();

		
		
	}


	/**
	 * buildRw
	 * 
	 * function to call to build a roadwork object given a vgml object
	 */	
	public static function buildRw($csvLine){

	  $csv = new CSVMTQ($csvLine);

      //Let's exclude rw with no geometry...
	  if (is_null($csv->formattedGeom)){
		echo "Pas de formatted geom \n";
		return false;
	  }

	  if(!($roadwork = Doctrine::getTable('rwRoadwork')->getTableByGeom($csv->formattedGeom))){

	    $roadwork = new rwRoadwork();
		$roadwork->rwStatus = RwRoadwork::$rwStatusEnum['is_new']; // 
        echo "Nouveau chantier trouvé : ". $csv->name ."\n";
	  } else {
		//TODO (optional) : array of modified fields is not used currently
		//TODO IMPORTANT : VERIF OF UPDATE DISABLED FOR THE MOMENT!!!		
        //$modifs = $csv->isModified($roadwork);
        //if (count($modifs)>0){
		//  $roadwork->rwStatus = RwRoadwork::$rwStatusEnum['is_updated'];
        //  echo "Update d'un chantier existant : ". $csv->name ."\n";
		//} else{
		  $roadwork->rwStatus = RwRoadwork::$rwStatusEnum['no_change'];
          //echo "Chantier existant non changé : ". $roadwork->name ."\n";
		//}
    	
	  }
	
	
	//TODO : il faudrait remonter ça avant la vérif d'update
		$extention = null;
		$connectionSize = $csv->searchMtqExtention($extention, $roadwork);
		
	
      if (is_null($extention)){
	    $roadwork->name = $csv->name;
	    $roadwork->description = $csv->description;
	    $roadwork->url = $csv->url;
	    $roadwork->restriction = $csv->restriction;	
	    $roadwork->road_name = $csv->roadName;	
	  } else {
		
		echo "***********J'ai une extention " . $extention->name . "\n";
		$roadwork->name = $extention->roadname . " - " . $extention->name;

	    $roadwork->url = $extention->mtq_url;
	    $roadwork->description = $extention->identification . "<br/>" . $extention->localisation ;	
	    $roadwork->road_name = $extention->roadname;
	    $roadwork->restriction = $extention->restriction;		
	    $roadwork->direction = $extention->direction;
	    $roadwork->workaround = $extention->workaround;
	  }

//TODO if date match a date format, then insert in timestamp field, else in the text one.
      //$roadwork->raw_description = $csv->rawDescription;

	  $roadwork->end_date = $csv->endDate;	
	  $roadwork->start_date = $csv->startDate;

	  $roadwork->source_id = CSVMTQCollection::$sourceId;
	  $roadwork->is_active = true;     
	  
      $roadwork->saveWithGeom($csv->formattedGeom); 

	  return $roadwork;
	}  

	/**
	 * extractDates
	 * 
	 * compute the start and end date from the csv file
	 */
  protected function extractDates(){

	$explodedField = explode(" ", $this->rawData[2]);


    $startDateObj = DateTime::createFromFormat('y/m/d', $explodedField[1]);
	$this->startDate = date_format($startDateObj, 'Y-m-d H:i:s');

    $endDateObj = DateTime::createFromFormat('y/m/d', $explodedField[2]);
	$this->endDate =  date_format($endDateObj, 'Y-m-d H:i:s');
	
	return true;
  }


	/**
	 * extractName
	 * 
	 * Build a name based on the existing date of the csv
	 */
  protected function extractName(){


setlocale(LC_TIME, "fr_CA.utf8");
	$explodedField = explode(" ", $this->rawData[3]);
	$this->name = "Chantier sur la route " . $this->roadName . " du ";

	$startDateObj = DateTime::createFromFormat('y/m/d', $explodedField[1]);
	$this->name .= strftime("%A %e %B %Y", $startDateObj->format('U'));

    $this->name .= " au ";

	$endDateObj = DateTime::createFromFormat('y/m/d', $explodedField[2]);
	$this->name .= strftime("%A %e %B %Y", $endDateObj->format('U'));


	
	return true;
  }



	/**
	 * extractRoadName
	 * 
	 * Extract the road name based on the CSV line
	 */
  protected function extractRoadName(){

	$explodedField = explode(" ", $this->rawData[3]);

    //We try to format something like A-40 is we can match.
    if (preg_match('/^([A-Z]{1})([0-9]{1,5}).*/', $explodedField[0], $match) == 1){
	   $this->roadName = $match[1] . "-" . $match[2];
    } else {
		$this->roadName = $explodedField[0];
    }

	return true;
  }

	/**
	 * isModified
	 * 
	 * evaluate if the currect vgml has some updated fields compared to an existing roadwork
	 * Not the most elegant thing...
	 */
  protected function isModified($roadwork){
	
	$modifiedFiels = array();
	
	if ($roadwork->name != $this->name){
		$modifiedFiels['name'] = $roadwork->name;
		//echo "on a un modif sur le nom\n"; 
	}

	if ($roadwork->description != $this->description){
		$modifiedFiels['description'] = $roadwork->description;
		//echo "on a un modif sur la description\n";
	}
	
	//TO DO : gérer mieux que ça la comparaison des dates. 
/*
	if ($roadwork->end_date_text != $this->endDate){
		$modifiedFiels['end_date_text'] = $roadwork->start_date_text;
		//echo "on a un modif sur la date de fin\n";
	}	

	if ($roadwork->start_date_text != $this->startDate){
		$modifiedFiels['end_date_text'] = $roadwork->start_date_text;
		//echo "on a un modif sur la date de fin\n";
	}
*/	
	if ($roadwork->url != $this->url){
		$modifiedFiels['url'] = $roadwork->url;
		//echo "on a un modif sur l'url\n";
	}	
	
	if ($roadwork->restriction != $this->restriction){
		$modifiedFiels['restriction'] = $roadwork->restriction;
		//echo "on a un modif sur la restriction\n";
	}		

	if ($roadwork->road_name != $this->roadName){
		$modifiedFiels['road_name'] = $roadwork->road_name;
		//echo "on a un modif sur les rues affectee \n";
	}
	
	return $modifiedFiels;
  }


	/**
	 * buildGeom
	 * 
	 * Parse the coordinates of the vgml in order to have a ready to insert string following WKT 
	 */	
	protected function buildGeom (){

    $this->coordinates = $this->rawData[0] . " " . $this->rawData[1];
	$this->geomType = "POINT";	
	$this->formattedGeom = $this->geomType . "(". $this->coordinates. ")";

   return true;  	

  }


  protected function searchMtqExtention(&$extention, $roadwork){

    $returnedCollection = Doctrine:: getTable('RwMtqExtention')->getTableByParameter('rw_id', $roadwork->id);

    if (count($returnedCollection) == 1){
	  $extention = $returnedCollection[0];
	}

    if (count($returnedCollection) > 0){
	  return count($returnedCollection);
	}

    $returnedCollection = Doctrine:: getTable('RwMtqExtention')->getByDateAndRoad($this->startDate, $this->endDate, $this->roadName);

    if (count($returnedCollection) == 1){
	  $extention = $returnedCollection[0];
	  $extention->rw_id = $roadwork->id;
	  $extention->save();
	    
	} else{
		//TODO send an email about this ?...
		echo "Can't find a match between CSV roadword and mtq extention table...\n";
	}

   return count($returnedCollection);
  }
}

?>