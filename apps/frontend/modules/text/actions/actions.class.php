<?php

/**
 * text actions.
 *
 * @package    roadwork
 * @subpackage text
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class textActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->content = "meuh dans l'action";

  }

  public function executeShow (sfWebRequest $request)
  {

    $param = $_SERVER['REQUEST_URI'];

    $filename = sfConfig::get('app_text_files') . $param; 
    $this->forward404Unless($handle = fopen($filename, "rb"));
    $content = fread($handle, filesize($filename));
    fclose($handle); 

    
    $this->content= $content;

    // $this->content= $_SERVER['REQUEST_URI'] ;

  }

}
