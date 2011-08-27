<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<?php include_http_metas() ?>
		<?php include_metas() ?>
        <meta name="author" content="Stephane Guidoin" />
        <meta name="keywords" content="Montreal, Montréal, Québec, Quebec, Ministère du Transport du Québec, Ville de Montréal, Chantiers, travaux, travaux routiers, roadworks" />
        <meta name="description" content="ZoneCone.ca - Localisation des travaux routiers au Québec selon les trajets" />
        <meta name="icbm" content="45.52600, -73.567811" />
        <meta http-equiv="X-UA-Compatible" content="chrome=IE7">
                <link rel="shortcut icon" type="image/png" href="http://zonecone.ca/favicon.png" />
                <?php include_stylesheets() ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-25266512-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
		<script type="text/javascript">
//<![CDATA[

		var jsonUrl = "<?php echo url_for('api/index', true); ?>";

		<?php
		if ($sf_user->isAuthenticated()) {echo "var isAuthenticated = 1;";}
		else {echo "var isAuthenticated = 0;";}
		?>
		
		
		var rwToDisplay = <?php
		 if (sfContext::getInstance()->getRouting()->getCurrentRouteName() == "rw_show"){
		 echo $sf_request->getParameter('id');
		} else {
			echo "0";
		}
    ?>;

		var routeToDisplay = "<?php
		 if (sfContext::getInstance()->getRouting()->getCurrentRouteName() == "routes_show"){
		 include_slot('geom') ;
		} else {
			echo "0";
		}
		 ?>";
		
		//]]>
		</script>
		<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
		<script src="http://maps.google.com/maps/api/js?libraries=places&amp;sensor=false" type="text/javascript"></script>
		<script src="http://code.jquery.com/jquery-1.6.1.min.js" type="text/javascript"></script>
		<script src="http://code.jquery.com/ui/1.8.13/jquery-ui.min.js" type="text/javascript"></script>
		<?php include_javascripts() ?>

		<script type="text/javascript">
			//<![CDATA[
			$(document).ready(function () {

		 	init(45.45, -74.00, 45.70, -73.30);
			<?php 
			if ($sf_user->isAuthenticated()){
				if (sfContext::getInstance()->getRouting()->getCurrentRouteName() == "homepage"){
					echo "showContent('my-routes');\n";
				} else{
					echo "showContent('default');\n";
				}
			} 	
			
			 if (sfContext::getInstance()->getRouting()->getCurrentRouteName() == "routes_new"){
				echo "showAskGoogle();";
			}		
			
			?>	
			});
		//]]>
		</script>
		<title>ZoneCone - &Eacute;vitez les chantiers routiers!</title>
	</head>
	<body>
		<div id="header" class="ui-layout-north">
			<div id="title">
			  <div id="logo"><img src="/images/logo.png" alt="logo"/></div>
			  <h1>
		    	    <a href="/">ZoneCone<span>.ca</span></a>
			  </h1>
			</div>
                        <div id="nav">
                                <?php if ($sf_user->isAuthenticated()): ?>
                                  <div class="subnav" id="who"> Connect&eacute;: <?php echo $sf_user->getGuardUser()->getUsername(); ?></div>
                                  <div class="subnav" id="options"><a href="/settings">Options</a></div>
                                  <div class="subnav" id="logout"><a href="/logout">Se Déconnecter</a></div>
                                <?php else: ?>
                                        <div class="subnav" id="login"><a href="/login">Se connecter</a></div>
                                        <div class="subnav" id="apply"><a href="/apply">Cr&eacute;er un compte</a></div>
                                <?php endif; ?>


                                <div class="subnav"><a href="/about">&Agrave; propos</a></div>
                                <div class="subnav"><a href="/terms">Utilisation</a></div>
                                <div class="subnav"><a href="/data">Donn&eacute;es</a></div>
                                <div class="subnav"><a href="/faq">FAQ</a></div>
                                <div class="subnav"><a href="/contact">Contact</a></div>
                                <div class="logomo"><a href="http://montrealouvert.net/donnees-ouvertes-questions-frequemment-demandees/?lang=fr">
                                  <img src="/images/horizontal-logo-francais.png" alt="Logo Montreal Ouvert"/></a>
                                </div>
                        </div>

		</div>
		<div class="ui-layout-west">

                                <?php if ($sf_user->isAuthenticated()): ?>
                        <div id="menu">
                                <div id="m-routes"><a href="#routes" onclick="showContent('my-routes')">Trajets sauvegardés</a></div>
                                <!--div id="m-notif"> <a href="#notif" onclick="showContent('my-notif')">Notifications</a></div-->
                                <div id="m-new"><a href="#new"  onclick="showContent('new-route');">Nouveau Trajet</a></div>
                                
                        </div>
                       <?php endif; ?>
 
<div style="padding: 5px 12px;">
<p style="color: #c33; font-size: 12px">Malgré de nombreux tests, il semble que le site ne soit pas compatible avec certaines versions d'Internet Explorer. Si vous le pouvez, essayez avec FireFox, Chrome ou Opera en attendant que le problème soit réglé</p>
</div>
			<div id="panels">
				<?php if ($sf_user->isAuthenticated() == 1 ): ?>
				<div class="panel" id ="new-route">
				</div>
				<div class="panel" id="my-routes">
				</div>
				<div class="panel" id="my-notif">
				</div>
				<?php endif; ?>
				<div class="panel" id="default">
						<?php if ($sf_user->isAuthenticated() && sfContext::getInstance()->getRouting()->getCurrentRouteName() == "homepage"){
								//echo "showContent('my-routes');";
							} else{
								echo $sf_content;
								
							} ?>
				</div>
			</div>
		</div>
		<div class="ui-layout-center">
                        <div id="map_legend">
                          <div class="sublegend"><img src="/images/cone-small-day-1.png" alt="Cone small day severity 1"/> Bloquant (jour)</div>
                          <div class="sublegend"><img src="/images/cone-small-day-2.png" alt="Cone small day severity 2"/>  Gênant (jour)</div>
                          <div class="sublegend"><img src="/images/cone-small-day-3.png" alt="Cone small day severity 3"/>  Non gênant (jour)</div>
                          <div class="sublegend"><img src="/images/cone-small-night-1.png" alt="Cone small night severity 2"/> Bloquant (nuit)</div>
                          <div class="sublegend"><img src="/images/cone-small-night-2.png" alt="Cone small day severity 1"/> Gênant (nuit)</div>
                          <div class="sublegend"><img src="/images/cone-small-inactive.png" alt="Cone small inactive"/>Inactif</div>
                          <div class="sublegend"><span style="font-size: 20px; font-weight: bold;">?</span> Incertain</div>

                        </div>
			<div id="map_canvas"></div>
		</div>
	</body>
</html>
