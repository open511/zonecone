<?php

/**
 * api actions.
 *
 * @package    roadwork
 * @subpackage api
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class apiActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      $this->roadworks = Doctrine_Core::getTable('RwRoadwork')->getJsonTableWithGeom();
      $this->jsonified = json_encode($this->roadworks);
      $this->setLayout(false);
      $this->getResponse()->setContentType('text/json');
  }
}
