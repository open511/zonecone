<?php

/**
 * routes actions.
 *
 * @package    roadwork
 * @subpackage routes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class routesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->rw_user_routes = Doctrine_Core::getTable('RwUserRoute')->getTableByParameter('user_id', $this->getUser()->getGuardUser()->getId());
    $this->rw_roadworks = array();
	  foreach  ($this->rw_user_routes as $rw_user_route){
		  //echo "J'ai la route " . $rw_user_route->getId() . "<br/>";
		  $count = Doctrine_Core::getTable('RwRoadwork')->countRwNear($rw_user_route->getGeom());
		
		  $this->rw_roadworks[$rw_user_route->getId()] = $count[0];
	  }

    if ($request->isXmlHttpRequest()){    
      return $this->renderPartial('routes/index', array('rw_user_routes' => $this->rw_user_routes, 'rw_roadworks' => $this->rw_roadworks));
    }
          
  }

  public function executeShow(sfWebRequest $request)
  {
//TODO : il faudrait un token pour accéder à une route plutôt que d'utiliser l'id direct...
//TODO : vraiment pas clean ici. Il faudrait récupérer seulement 1 user_route et non un array... ça fait faire des traitement illogiques
	  $this->rw_user_routes = Doctrine_Core::getTable('RwUserRoute')->getTableWithGeom($request->getParameter('id'));

    $this->forward404If($this->rw_user_routes[0]->getUserId() != $this->getUser()->getGuardUser()->getId());

	  $this->roadworks = Doctrine_Core::getTable('RwRoadwork')->getRwNear($this->rw_user_routes[0]->getGeom());

    $this->forward404Unless($this->rw_user_routes);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new RwUserRouteForm();

    if ($request->isXmlHttpRequest()){    
      return $this->renderPartial('routes/new', array('form' => $this->form));
    }

  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new RwUserRouteForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {

	 $rw_user_routes = Doctrine_Core::getTable('RwUserRoute')->getTableWithGeom($request->getParameter('id'));

    $this->forward404Unless($rw_user_routes, sprintf('Object RwUserRoute does not exist (%s).', $request->getParameter('id')));
    $this->form = new RwUserRouteForm($rw_user_routes[0]);
  }

//Todo comment desactiver une fonction si on ne l'utilise pas (update en l'occurrence)
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($rw_user_route = Doctrine_Core::getTable('RwUserRoute')->find(array($request->getParameter('id'))), sprintf('Object rw_user_route does not exist (%s).', $request->getParameter('id')));
    $this->form = new RwUserRouteForm($rw_user_route);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($rw_user_route = Doctrine_Core::getTable('RwUserRoute')->find(array($request->getParameter('id'))), sprintf('Object rw_user_route does not exist (%s).', $request->getParameter('id')));
    $rw_user_route->delete();

    $this->redirect('routes/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {

    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
    	$myGeom = $form->getGeom();
    	


//TODO : rendre l'nsemble de la transaction d'un bloc avec un commit()
	   $form->unsetGeom();
      $route = $form->save();   

			if (strlen($route->getFile())){
				//We have a file the geom, we'll have to look for the geom in the file... current geom value is dummy
				$myGeom = manageGeomFile::getGeom($route->getFile());
				
			}

		$t = Doctrine_Core::getTable('RwUserRoute')->updateGeometry($myGeom, $route->getId());

      $this->redirect('routes/show?id='.$route->getId());
    }

    
  }
}
