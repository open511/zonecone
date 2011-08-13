<?php

/**
 * VGMLCollection
 * 
 * Collection of Vgml objects
 */
class VGMLCollection 
{
  protected $vgmlCollection;
  protected $roadworks = array();
  public static $sourceId;

  public static function loadSource($source){
	
	$vgmls = new VGMLCollection();

	$vgmls->vgmlCollection = simplexml_load_file($source->url);
	self::$sourceId = $source->id;
	$vgmls->parseSource();
	
	return $vgmls->roadworks;
  }

  protected function parseSource(){
	
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
    }	
  }
}

/**
 * Vgml
 * 
 * Vgml object + function needed to build a roadwork object from a vgml instance
 */
class VGML
{
	private $rawVgml;
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

	function __construct($vgmlObject){

		$this->rawVgml = $vgmlObject;
		$this->name = $this->rawVgml->name;
		$this->rawDescription = $this->rawVgml->description;
		$this->infoSideBar = $this->rawVgml->info_side_bar;
		$this->visibility = $this->rawVgml->visibility;
		$return_value = $this->buildGeom();		
		$this->extractRawDescription();
	}


	/**
	 * buildRw
	 * 
	 * function to call to build a roadwork object given a vgml object
	 */	
	public static function buildRw($vgmlObject){

	  $vgml = new Vgml($vgmlObject);

      //Let's exclude rw with no geometry...
	  if (is_null($vgml->formattedGeom)){
		echo "Pas de formatted geom \n";
		return false;
	  }

	  if(!($roadwork = Doctrine::getTable('rwRoadwork')->getTableByGeom($vgml->formattedGeom))){

	    $roadwork = new rwRoadwork();
		$roadwork->rwStatus = RwRoadwork::$rwStatusEnum['is_new']; // 
        echo "Nouveau chantier trouvé : ". $vgml->name ."\n";
	  } else {
		//TODO (optional) : array of modified fields is not used currently
        $modifs = $vgml->isModified($roadwork);
        if ($roadwork->getIsActive() == false){
	         //if the roadwork was already there but inactive, it means it's a reactivation
          $roadwork->rwStatus = RwRoadwork::$rwStatusEnum['is_reactivated'];
        } elseif (count($modifs)>0){
		      $roadwork->rwStatus = RwRoadwork::$rwStatusEnum['is_updated'];
          echo "Update d'un chantier existant : ". $vgml->name ."\n";
		    } else{
		      $roadwork->rwStatus = RwRoadwork::$rwStatusEnum['no_change'];
          //echo "Chantier existant non changé : ". $roadwork->name ."\n";
		}
    	
	  }

	  $roadwork->name = $vgml->name;
	  $roadwork->raw_description = $vgml->rawDescription;
	  $roadwork->description = $vgml->description;

//TODO if date match a date format, then insert in timestamp field, else in the text one.
	  $roadwork->end_date_text = $vgml->endDate;	
	  $roadwork->start_date_text = $vgml->startDate;
	  $roadwork->url = $vgml->url;
	  $roadwork->restriction = $vgml->restriction;	
	  $roadwork->road_name = $vgml->roadName;	
	  $roadwork->source_id = VGMLCollection::$sourceId;
	  $roadwork->is_active = true;     
	  
      $roadwork->saveWithGeom($vgml->formattedGeom); 

	  return $roadwork;
	}  

	/**
	 * extractRawDescription
	 * 
	 * extract several information (street, dates, etc) from the raw description
	 */
  protected function extractRawDescription(){
	
	if (preg_match_all('(\<strong\>([^<]*)\<\/strong\>([^<]*))', $this->rawDescription, $arr, PREG_PATTERN_ORDER)){
		for ($i = 0; $i < count($arr[1]); $i++) {
			if (preg_match('/^Date/', $arr[1][$i])){
				$this->startDate = $arr[2][$i];
			} elseif (preg_match('/^Fin/', $arr[1][$i])){
				$this->endDate = $arr[2][$i];
			} elseif (preg_match('/^Entrave/', $arr[1][$i])){
				$this->restriction = $arr[2][$i];
			}	elseif (preg_match('/^Nature/', $arr[1][$i])){
				$this->description = $arr[2][$i];
			}
		}
	}
	
	if (preg_match_all('(href\=\"([^"]*)\")', $this->rawDescription, $arr, PREG_PATTERN_ORDER)){	
		$this->url = $arr[1][0];
	}

	if (preg_match_all('/localisation[^<]*\<strong\>([^<]*)\<\/strong\>(.*)/', str_replace('</div>', "\n", str_replace("\n", '', $this->rawDescription)), $arr, PREG_PATTERN_ORDER)){	
		$this->roadName = $arr[2][0];
	}	
	
	
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

	if ($roadwork->end_date_text != $this->endDate){
		$modifiedFiels['end_date_text'] = $roadwork->start_date_text;
		//echo "on a un modif sur la date de fin\n";
	}	

	if ($roadwork->start_date_text != $this->startDate){
		$modifiedFiels['end_date_text'] = $roadwork->start_date_text;
		//echo "on a un modif sur la date de fin\n";
	}
	
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

    $coordinates = "";

	if (isset($this->rawVgml->LineString->coordinates)){
	  $coordinates = $this->rawVgml->LineString->coordinates;

	} elseif(isset($this->rawVgml->Point->coordinates)) {
	  $coordinates = $this->rawVgml->Point->coordinates;				
	}
	

	if (!($occ = preg_match_all('(([\-0-9]{1,4}\.[0-9]*)\,([\-0-9]{1,4}\.[0-9]*)(\,0)?)', $coordinates, $this->coordinates, PREG_PATTERN_ORDER))){
		echo "Roadwork with no coordinate : " . $this->name . " - Valeur de coordonnées trouvées: $coordinates \n";
		return false;		
	}

	//We don't trust if coordinates is in Linstring or Point structure because it's sometimes false in the vgml file...
    if ($occ == 1){
	  $this->geomType = "POINT";	
	} else{
	  $this->geomType = "LINESTRING";		
	}
	$this->formattedGeom = $this->geomType . "(". $this->convert2Wkt() . ")";

   return true;  	

  }


	/**
	 * convert2Wkt
	 * 
	 * Convert a coordinates strings of vgml into a well-known text geometric representation 
	 * Use $this->coordinates, a multi-dim array where array[1][i] contains long and array[2][i] contains lat
	 */	

  protected function convert2Wkt(){

    $output = "";
    $size = count($this->coordinates[1]);
	for ($i=0; $i < $size; $i++) {
		$output .= $this->coordinates[1][$i] . " " . $this->coordinates[2][$i];
		if ($i < ($size - 1)){
			$output .= ",";
		}
	}
	
	return $output;
  }

}
?>