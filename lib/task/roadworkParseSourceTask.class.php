<?php

class roadworkParseSourceTask extends sfBaseTask
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
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      new sfCommandOption('sourceid', null, sfCommandOption::PARAMETER_REQUIRED, 'id of the source to use', '1'),
      // add your own options here
    ));

    $this->namespace        = 'roadwork';
    $this->name             = 'parseSource';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [roadwork:parseSource|INFO] task does things.
Call it with:

  [php symfony roadwork:parseSource|INFO]
EOF;

  }

  protected function execute($arguments = array(), $options = array())
  {	
    ob_start();
    //setlocale(LC_TIME, "fr_CA.utf8");

  	$inittime = microtime(true);

    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    // add your code here
    $mySource = Doctrine::getTable('rwSource')
      ->createQuery('a')
      ->where('id = ?', $options["sourceid"])
      ->fetchOne();

    $roadworks = array();
    $rwByUser = array();

    fileManager::backupFile($mySource);

	  $roadworks = array_merge($roadworks, call_user_func($mySource->type . "Collection::loadSource", $mySource));

    $this->getDeletedRoadworks (date("Y-m-d H:i:s", $inittime), &$roadworks, $mySource->id);

	//After this point we have in $roadworks all the new/updated/deleted rw...
    //Insert notifications
    foreach ($roadworks as $i => $rw) {
      if ($rw->rwStatus != RwRoadwork::$rwStatusEnum['no_change'] && $rw->rwStatus != RwRoadwork::$rwStatusEnum['error']){
        $userRoutes = Doctrine::getTable('rwUserRoute')->getImpactedUserRoutes($rw);

        foreach ($userRoutes as $userRoute) {
          $notif = new RwNotification();
          $notif->setRouteId($userRoute->getId());
          $notif->setUserId($userRoute->getUserId());
          $notif->setRwId($rw->getId());
          $notif->setIsSent(false);
          $notif->setRwStatus($rw->rwStatus);
          $notif->save();
        }
      }
    }

    //Send admin mail 
    if (count($roadworks) > 0){

      $context = sfContext::createInstance($this->configuration);
      $this->configuration->loadHelpers('Partial', 'Url');

      $transport = common::getMailTransport();
      $message = new Zend_Mail();
      $message->setSubject("Admin - Chantiers pour " . $mySource->name);

//Attention, the setFrom is overrided by esmtp
      $message->setFrom("robot@zonecone.ca", "ZoneCone Robot");

  // generate HTML part
      $context->getRequest()->setRequestFormat('html');
      $html = get_partial("rw/adminmail", array('roadworks' => $roadworks));

  // Render message parts
      $message->setBodyHtml($html, 'text/html');
//TODO: rendre l'adresse from et to configurable
      $message->addTo('info@zonecone.ca', 'Info ZoneCone');
      $message->send($transport);
    }

     $out2 = ob_get_contents();
     ob_end_clean();

     echo $out2;
  }
  
  protected function getDeletedRoadworks ($startTime, &$roadworks, $sourceId){

//TODO this function could go in the model...
    $deletedRws = Doctrine::getTable('rwRoadwork')
      ->createQuery('a')
      ->where("a.updated_at < ?", $startTime)
      ->andWhere("is_active = ?", true)
      ->andWhere("source_id = ?", $sourceId)
      ->execute();
      
      
    foreach ($deletedRws as $i => $deletedRw){
      	echo "Un Rw supprime : " . $deletedRw->name . "\n";
      	$deletedRw->is_active = false;
      	$deletedRw->rwStatus = RwRoadwork::$rwStatusEnum['is_deleted'];      	
      	$roadworks[] = $deletedRw;
      	$deletedRw->save();      	
    }   
    
    return;   	
  }



 
}
