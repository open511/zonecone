<?php

class manageGeomFile 
{
	
	public static function getGeom($filename){
		if (preg_match("/(.*)\.kml/", $filename)){
			$kml = simplexml_load_file(sfConfig::get('sf_upload_dir') . '/routes/' . $filename);
	
			$root = $kml->Document;

			//TODO Very very brutal... :p Couold find a better way to parse KML...
			$coordinates = array();
			manageGeomFile::readFolder($root, $coordinates);
			
			$exploder = explode (" ", $coordinates[0]);
			$imploder = array();
			foreach ($exploder as $element){
			  	$atomic = explode(",", $element);
					if (isset($atomic[0]) && isset($atomic[1])){
				  $imploder[] =  $atomic[0] . " " . $atomic[1];
			  }
			}

			$result = "LINESTRING(" . implode (",", $imploder) .")";
			

			return $result;
		}
	}
	
	public static function readFolder($base, &$array){
		$array = array();
		foreach ($base as $content){
			if (isset($content->Folder)){
				manageGeomFile::readFolder($content->Folder, &$array);
			}
			else{
				if (isset($content->Placemark->LineString)){
					$meuh = "";
					$meuh = $content->Placemark->LineString->coordinates;
				  $array[] = (string)$meuh;
				}
			}
		}
	}			
	
}

?>
