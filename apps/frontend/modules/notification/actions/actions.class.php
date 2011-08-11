<?php

/**
 * notification actions.
 *
 * @package    roadwork
 * @subpackage notification
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class notificationActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
	
	//TODO : por l'instant basé sur sent/unsent... idéalement il faudrait le faire sur seen/unseen
    $this->rw_notifications = Doctrine_Core::getTable('RwNotification')->getUnsentNotifByUser($this->getUser()->getGuardUser()->getId());
    $this->rw_old_notifications = Doctrine_Core::getTable('RwNotification')->getSentNotifByUser($this->getUser()->getGuardUser()->getId());
    if ($request->isXmlHttpRequest()){    
      return $this->renderPartial('notification/index', array('rw_notifications' => $this->rw_notifications, 'rw_old_notifications' => $this->rw_old_notifications));
    }

  }

  public function executeShow(sfWebRequest $request)
  {
    $this->rw_notification = Doctrine_Core::getTable('RwNotification')->find(array($request->getParameter('id')));

	$this->forward404If($this->rw_notification->getUserId() != $this->getUser()->getGuardUser()->getId());

    $this->forward404Unless($this->rw_notification);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new RwNotificationForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new RwNotificationForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($rw_notification = Doctrine_Core::getTable('RwNotification')->find(array($request->getParameter('id'))), sprintf('Object rw_notification does not exist (%s).', $request->getParameter('id')));
    $this->form = new RwNotificationForm($rw_notification);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($rw_notification = Doctrine_Core::getTable('RwNotification')->find(array($request->getParameter('id'))), sprintf('Object rw_notification does not exist (%s).', $request->getParameter('id')));
    $this->form = new RwNotificationForm($rw_notification);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($rw_notification = Doctrine_Core::getTable('RwNotification')->find(array($request->getParameter('id'))), sprintf('Object rw_notification does not exist (%s).', $request->getParameter('id')));
    $rw_notification->delete();

    $this->redirect('notification/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $rw_notification = $form->save();

      $this->redirect('notification/edit?id='.$rw_notification->getId());
    }
  }
}
