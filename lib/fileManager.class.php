<?php

class fileManager 
{
	public static function backupFile ($source){
		$content = file_get_contents($source->url);
		$filename = sfConfig::get('sf_upload_dir').'/sources/' . $source->id . "_" . date("YmdHis");
		$fp = fopen($filename, 'w+');
		fwrite($fp, $content);
		fclose($fp);
	}
}

?>