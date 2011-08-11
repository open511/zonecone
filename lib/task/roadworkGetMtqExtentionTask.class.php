<?php

class roadworkGetMtqExtentionTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'roadwork';
    $this->name             = 'getMtqExtention';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [roadwork:getMtqExtention|INFO] task does things.
Call it with:

  [php symfony roadwork:getMtqExtention|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    $rssFeeds = array(
	   'Abitibi-Temiscamingue' => 'http://www.sit.mtq.gouv.qc.ca/emetteur/Rss/GenererRss.aspx?regn=7000&routes=101;109;111;113;117;382;386;388;390;391;393;395;397;399&lang=fr',
	   'Ile de Montreal et ses acces' => 'http://www.sit.mtq.gouv.qc.ca/emetteur/Rss/GenererRss.aspx?regn=13000&routes=010;013;015;019;020;025;040;520;720;112;117;125;134;138;335&lang=fr',
	   'Bas-Saint-Laurent–Gaspesie–Iles-de-la-Madeleine' => 'http://www.sit.mtq.gouv.qc.ca/emetteur/Rss/GenererRss.aspx?regn=4000&routes=020;085;132;185;191;195;197;198;199;230;232;234;287;289;291;293;295;296;297;298;299&lang=fr',
	   'Chaudiere-Appalaches' => 'http://www.sit.mtq.gouv.qc.ca/emetteur/Rss/GenererRss.aspx?regn=5000&routes=020;073;108;112;116;132;161;165;171;173;175;204;216;218;226;228;263;267;269;271;273;275;276;277;279;281;283;285&lang=fr',
	   'Cote-Nord' => 'http://www.sit.mtq.gouv.qc.ca/emetteur/Rss/GenererRss.aspx?regn=3000&routes=138;172;385;389&lang=fr',
	   'Estrie' => 'http://www.sit.mtq.gouv.qc.ca/emetteur/Rss/GenererRss.aspx?regn=9000&routes=010;055;410;610;108;112;116;141;143;147;161;204;206;208;210;212;214;216;220;222;243;245;247;249;251;253;255;257;263&lang=fr',
	   'Laurentides-Lanaudiere' => 'http://www.sit.mtq.gouv.qc.ca/emetteur/Rss/GenererRss.aspx?regn=10000&routes=015;025;031;040;050;107;117;125;131;138;148;158;309;311;321;323;327;329;333;335;337;339;341;343;344;345;346;347;348;349;364;370&lang=fr',
	   'Laval' => 'http://www.sit.mtq.gouv.qc.ca/emetteur/Rss/GenererRss.aspx?regn=8000&routes=013;015;019;025;040;440;640;117;125;138;148;335;337;339;341;343;344&lang=fr',
	   'Mauricie–Centre-du-Quebec' => 'http://www.sit.mtq.gouv.qc.ca/emetteur/Rss/GenererRss.aspx?regn=1000&routes=020;030;040;055;955;116;122;132;138;139;143;153;155;157;159;161;162;165;216;218;224;226;239;243;255;259;261;263;265;267;348;349;350;351;352;354;359;361;363;367&lang=fr',
	   'Monteregie' => 'http://www.sit.mtq.gouv.qc.ca/emetteur/Rss/GenererRss.aspx?regn=11000&routes=010;015;020;025;030;035;040;530;540;730;104;112;116;122;132;133;134;137;138;139;201;202;203;205;207;209;211;213;215;217;219;221;222;223;224;225;227;229;231;233;235;236;237;239;241;243;325;338;340;342&lang=fr',
	   'Outaouais' => 'http://www.sit.mtq.gouv.qc.ca/emetteur/Rss/GenererRss.aspx?regn=6000&routes=005;050;105;107;117;148;301;303;307;309;315;317;321;323;366&lang=fr',
	   'Quebec Capitale-Nationale' => 'http://www.sit.mtq.gouv.qc.ca/emetteur/Rss/GenererRss.aspx?regn=12000&routes=040;073;440;540;573;740;973;136;138;169;170;175;354;358;360;362;363;365;367;368;369;371;381&lang=fr',
	   'Saguenay–Lac-Saint-Jean' => 'http://www.sit.mtq.gouv.qc.ca/emetteur/Rss/GenererRss.aspx?regn=2000&routes=070;113;155;167;169;170;172;175;372;373;381&lang=fr',
	);
	
	foreach ($rssFeeds as $zone => $rssUrl){
		$feedRws = simplexml_load_file($rssUrl);
		
		//print_r ($feedRws);
		
		echo "************* Feed for $zone \n";
		
		foreach ($feedRws->channel->item as $item){
			if ($item->category == "TravauxRoutier"){
			  echo "Rw found : " . $item->title . "\n";
			
			  $mtqExtentionCollection = Doctrine::getTable('RwMtqExtention')->getTableByParameter('mtq_id', $item->guid);
			  if (count($mtqExtentionCollection) == 0){
                echo "------------- je passe dans le new\n";
			    $mtqExtention = new rwMtqExtention();			    
			  } else {
				$mtqExtention = $mtqExtentionCollection[0];
			}
			
			  $mtqExtention->mtq_id = $item->guid;
			  $mtqExtention->mtq_url = $item->link;
			  $mtqExtention->area = $zone;
			
			  $exploded = explode(":", $item->title);
			
			  $mtqExtention->roadname = $exploded[0];
			
			  $this->extractDataFromLink($mtqExtention);
			
			
			  $mtqExtention->save();
			}
		}
	}

  }

  protected function extractDataFromLink(&$mtqExtention){

   $elements = array(
     'end_date' => "/divDateFin([^>]*)\>(.*)/",
     'start_date' => '/divDateDebut([^>]*)\>(.*)/',
     'direction' => '/divDirection([^>]*)\>(.*)/',
     'localisation' => '/divLocalisation([^>]*)\>(.*)/',
     'identification' => '/divIdentification([^>]*)\>(.*)/',
     'restriction' => '/divEntraves([^>]*)\>(.*)/',
     'workaround' => '/divDetour([^>]*)\>(.*)/',
     'name' => '/divTypeEntrave([^>]*)\>(.*)/',
   );

    $fh = fopen($mtqExtention->mtq_url, "r");
    $buffer = '';
    while (($line = fgets($fh, 4096)) !== false) {
      $buffer .= $line;
    }

    $buffer = str_replace('</div>', "\n", str_replace("\n", '', $buffer));

	foreach ($elements as $key => $regex){
      if (preg_match($regex, $buffer, $match)){

         if ($key == 'end_date'){
		    $value = $match[2] . " 23:59:59";
         } elseif ($key == 'start_date'){
		    $value = $match[2] . " 00:00:00";	
         } else {
	       $value = $match[2];
         }

         $mtqExtention->$key = $value;        
      }


    }
	
  }
}
