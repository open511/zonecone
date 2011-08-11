<?php

class Common 
{
	//TODO A deplacer ailleurs...
	  public static function getMailTransport()
	  {
	    // sfDoctrineApplyPlugin 1.1 uses Zend_Mail instead of SwiftMailer. SwiftMailer 3.0 is
	    // unsupported at this point, and rather than upgrade to 4.0, we're choosing to go with
	    // a framework that we already use for search. Fewer dependencies = better

	    // Example:
	    //
	    // all:
	    //   sfApply:
	    //     mail_transport_class: Zend_Mail_Transport_Smtp
	    //     mail_transport_host: smtp.example.com
	    //     mail_transport_options:
	    //       ssl: tls # Enable SSL
	    //
	    // See also:
	    //
	    // http://framework.zend.com/manual/en/zend.mail.smtp-secure.html
	    // http://micrub.info/2008/09/22/sending-email-with-zend_mail-using-gmail-smtp-services/
	    //
	    // Or just use the default mailer by not configuring these options at all.

	    self::registerZend();

	    $class = sfConfig::get('app_sfApplyPlugin_mail_transport_class', null);
	    $host = sfConfig::get('app_sfApplyPlugin_mail_transport_host', null);
	    $options = sfConfig::get('app_sfApplyPlugin_mail_transport_options', null);
	    if (($class === null) && ($options === null) && ($host === null))
	    {
	      // This actually works - Zend_Mail will accept null and use the default transport
	      return null;
	    }
	    $transport = new $class($host, $options);
	    return $transport;
	  }

	  static private $zendLoaded = false;

	  public static function registerZend()
	  {
	    if (self::$zendLoaded)
	    {
	      return;
	    }

	    # Zend 1.8.0 and thereafter 
	    include_once('Zend/Loader/Autoloader.php');
	    $loader = Zend_Loader_Autoloader::getInstance();
	    // Zend should NOT be the fallback autoloader, that gets in Symfony's way and generates warnings in 1.3
	    $loader->setFallbackAutoloader(false);
	    $loader->suppressNotFoundWarnings(false);

	    self::$zendLoaded = true;
	  }	
	
}

?>
