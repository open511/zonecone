<?php

class roadworkSendNotificationTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    //VERY IMPORTANT : Links generated with in email will not be generated if the is not set!
    $_SERVER['SCRIPT_NAME'] = "http://www.zonecone.ca";



    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'prod'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'roadwork';
    $this->name             = 'sendNotification';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [roadwork:sendNotification|INFO] task does things.
Call it with:

  [php symfony roadwork:sendNotification|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {

    ob_start();

    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

	$context = sfContext::createInstance($this->configuration);
	$this->configuration->loadHelpers('Partial', 'Url');



      //Get Users with unsent notification
	  $users = Doctrine_Core::getTable('RwNotification')->getUsersWithPendingNotif();
	
       foreach ($users as $userId){

	       $rw_notifications = Doctrine_Core::getTable('RwNotification')->getUnsentNotifByUser($userId['user_id']);

         $user_detail = Doctrine_Core::getTable('sfGuardUserProfile')->getProfileByUserId($userId['user_id']);

         if ($user_detail->getSendNotification() == true){

		       // generate HTML part
		       $context->getRequest()->setRequestFormat('html');
		       $html  = get_partial("notification/mail", array('rw_notifications' => $rw_notifications));
		       //$message->setBody($html, 'text/html');
	
	   	       // generate plain text part
		       $context->getRequest()->setRequestFormat('txt');
		       $plain = get_partial("notification/mail", array('rw_notifications' => $rw_notifications));
		       //$message->addPart($plain, 'text/plain');

		       $transport = common::getMailTransport();
		       $message = new Zend_Mail();
		       $message->setSubject("Nouveaux chantiers!");

			     // Render message parts
			     $message->setBodyHtml($html, 'text/html');
			     $message->setBodyText($plain, 'text/plain');
			     $message->setFrom('robot@zonecone.ca', 'ZoneCone Robot');
			     $message->addTo($rw_notifications[0]->getSfGuardUser()->getEmailAddress(), 
			       $rw_notifications[0]->getSfGuardUser()->getFirstName() . " " . $rw_notifications[0]->getSfGuardUser()->getLastName());
			     $message->send($transport);

         }
		
		   foreach ($rw_notifications as $rw_notification){
		     $rw_notification->is_sent = true;
             $rw_notification->save();
		   }
		
	     } 

	$out2 = ob_get_contents();

	ob_end_clean();

	echo $out2;

  }


}
