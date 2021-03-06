<?php

/**
 * RwRoadwork
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    roadwork
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class RwRoadwork extends BaseRwRoadwork
{



 public static $geometryColumn = array('geom' => 4326);
 
 static public $rwStatusEnum = array(
   'is_updated' => 'u',
   'is_new' => 'n',
   'is_deleted' => 'd',
   'is_deactivated' => 'a',
   'is_reactivated' => 'r',
   'no_change' => '0',
   'error'  => 'e'
 );

 static public $rwSeverityTextEnum= array(
    1 => 'BLOQUANT',
    2 => 'GÊNANT',
    3 => 'NON GÊNANT',
 );

 static public $rwSeverityColorEnum= array(
    1 => '822',
    2 => 'dA0',
    3 => '091',
 );


 public $wasNew = false;
 public $rwStatus;  //must be a value from $rwStatusEnum
 public $updatedFields; 
 
 public function wasNew(){
   return $wasNew;
 }

  public function saveWithGeom($WktGeom){

    try {
      $this->save(); 
	  Doctrine_Core::getTable('RwRoadwork')->updateGeometry($WktGeom, $this->getId());
	  } 
	  catch (Exception $e) {
		//TODO : mieux gérer le catch ici... Notamment gérer le fait que si update ne marche pas, 
		//l'entrée n'aura pas de géomtrie...
		    echo 'Exception reçue : ',  $e->getMessage(), "\n";
	  }
	
	//TODO mettre une valeur de retour...
}
 
 public function getPublicAttributes(){

	 $geom = $this->getGeom();

//TODO Ameliorer ceci avec une regex...	 
    if (substr($geom, 0, 10) == "LINESTRING"){
      $type = "LINESTRING";
	   $theline = substr(substr($geom, 0, strlen($geom)-1), 11);
	   $coordinates = explode(",", $theline);
	 } else {
	 	$type = "POINT"; 
	   $theline = substr(substr($geom, 0, strlen($geom)-1), 6);
	   $coordinates = explode(",", $theline);	
	    }	 

		if (is_null($this->getStartDate())){
			$startDate = $this->getStartDateText();
		} else {
			$startDate = $this->getStartDate();
		}

		if (is_null($this->getEndDate())){
			$endDate = $this->getEndDateText();
		} else {
			$endDate = $this->getEndDate();		
		}
		
		if (is_null($this->getSeverity())){
			$severity = 2;
		} else {
			$severity = $this->getSeverity();
		}

            $display = $this->getShortDescription();

    $publicArray = array(
      'id'           => $this->getId(),
      'name'         => $this->getName(),
      'type'         => $type,
      'coordinates'  => $coordinates,
      'startDate'	 => $startDate,
      'endDate'	     => $endDate,
      'startDate'    => $startDate,
      'endDate'      => $endDate,
      'startDateText' => $this->getFormattedStartDate(),
      'endDateText' => $this->getFormattedEndDate(),
      'severity'     => $severity,
      'is_active'    => $this->getIsActive(),
      'is_night'	 => $this->getIsNight(),
      'is_uncertain' => $this->getIsUncertain(),
      'short_display' => $display,
     );
   
     return $publicArray;    
 }


  public function getFormattedStartDate(){

                //It might seem crazzy to use the Text value at first. But for Ville de Montreal, I set the timestamp based on the text date
                //However text date are usually fuzzy like "end of august", so we prefer display the data provided by the source
                //than a value entered manually to allow SQL query but that might not be accurate
                if (strlen($this->getStartDateText()) > 0){
                        $startDate = $this->getStartDateText();
                } else {
                        //DateTime object seems not to support fr locale, so we have to go thru strftime
                        $startDate = strftime('%e %B %Y', $this->getDateTimeObject('start_date')->format('U'));
                }

    return $startDate;

  }

  public function getFormattedEndDate(){

                if (strlen($this->getEndDateText()) > 0){
                        $endDate = $this->getEndDateText();
                } else {
                         $endDate = strftime('%e %B %Y', $this->getDateTimeObject('end_date')->format('U'));
                }
    return $endDate;
  }

  public function getIconName(){
    $iconName = "";
    if ($this->getIsActive() == false && $this->getIsUncertain() == false){
      $iconName .= "inactive";
    } else {
      if ($this->getIsNight() == true){
        $iconName .= "night-";
      } else{
        $iconName .= "day-";
      }
      if (strlen($this->severity) == 1){
        $iconName .= $this->getSeverity();
      } else {
        $iconName .= "2";
      }
      if ($this->getIsUncertain() == true){
         $iconName .= "-uncertain";
      }
    }

    return $iconName;
  }

  public function getShortDescription(){

     if (strlen($this->restriction) > 20) { $display= $this->restriction; }
     elseif (strlen($this->description) > 20) { $display= $this->description;}
     else {$display = "";}

     $display = str_replace("<br/><br/>", "<br/>", $display);
     $display = strip_tags($display, "<br/>");
     $display = str_replace("<br/>", "|", $display);
     $display = substr($display, 0, 120) . "... ";
     $display = str_replace("|", "<br/>", $display);

     return $display;
 
  }
}
