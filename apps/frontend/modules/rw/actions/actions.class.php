<?php

/**
 * rw actions.
 *
 * @package    roadwork
 * @subpackage rw
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class rwActions extends sfActions 
{
  public function executeIndex(sfWebRequest $request)
  {
      $this->roadworks = Doctrine_Core::getTable('RwRoadwork')->getTableWithGeom();
  }

  public function executeShow(sfWebRequest $request)
  {
	 $this->roadworks = Doctrine_Core::getTable('RwRoadwork')->getTableWithGeom($request->getParameter('id'));
	 
    $this->forward404Unless($this->roadworks);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new RwRoadworkForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
  	
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new RwRoadworkForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
  	
	 $roadworks = Doctrine_Core::getTable('RwRoadwork')->getTableWithGeom($request->getParameter('id'));
	      	
    $this->forward404Unless($roadworks, sprintf('Object roadwork does not exist (%s).', $request->getParameter('id')));
    $this->form = new RwRoadworkForm($roadworks[0]);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($roadwork = Doctrine_Core::getTable('RwRoadwork')->find(array($request->getParameter('id'))), sprintf('Object roadwork does not exist (%s).', $request->getParameter('id')));
    $this->form = new RwRoadworkForm($roadwork);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($roadwork = Doctrine_Core::getTable('RwRoadwork')->find(array($request->getParameter('id'))), sprintf('Object roadwork does not exist (%s).', $request->getParameter('id')));
    $roadwork->delete();

    $this->redirect('rw/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {

    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
    	$myGeom = $form->getGeom();
    	
//TODO : rendre l'nsemble de la transaction d'un bloc avec un commit()
	   $form->unsetGeom();
      $roadwork = $form->save();   

		$t = Doctrine_Core::getTable('RwRoadwork')->updateGeometry($myGeom, $roadwork->getId());

      $this->redirect('rw/show?id='.$roadwork->getId());
    }
  }
 
  public function executeNear(sfWebRequest $request)
  {

    if($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT)){

      $path = $request->getPostParameter('geom');
      $this->roadworks = Doctrine_Core::getTable('RwRoadwork')->getRwNear($path);
       
      if ($request->isXmlHttpRequest()){    
       return $this->renderPartial('rw/near', array('roadworks' => $this->roadworks));
      }       
    } else {
//TODO : Throw error here!!
    	$toto = "LINESTRING(-73.63901 45.50988,-73.639580 45.5091700)";
       $this->roadworks = Doctrine_Core::getTable('RwRoadwork')->getRwNear($toto);
    }
  } 
}
