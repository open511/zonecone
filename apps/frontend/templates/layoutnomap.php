<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<?php include_http_metas() ?>
		<?php include_metas() ?>
                <link rel="shortcut icon" type="image/png" href="http://ronomo.net/favicon.png" />
                <?php include_stylesheets() ?>
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
			


			//}

			?>	
			
			});
		//]]>
		</script>
		<title>RoNoMo - &Eacute;vitez les chantiers routiers!</title>
	</head>
	<body>
		<div id="header" class="ui-layout-north">
			<div id="title">
			  <div id="logo"><img src="/images/logo.png" alt="logo"/></div>
			  <h1>
		    	    <a href="/">RoNoMo<span>.net</span></a>
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
		<div class="ui-layout-center">
                        <div class="mainnomap">
                                <div class="contentnomap">
                                                                <?php echo $sf_content; ?>
                                </div>
                        </div>
                </div>

		</div>
	</body>
</html>
