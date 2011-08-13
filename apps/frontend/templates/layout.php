<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<?php include_http_metas() ?>
		<?php include_metas() ?>
		<?php //include_title() ?>
		<link rel="shortcut icon" href="/favicon.ico" /><?php include_stylesheets() ?>
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
			


			//}

			?>	
			
			});
		//]]>
		</script>
		<title>RoNoMo - Roadwork No More</title>
	</head>
	<body>
		<div id="header" class="ui-layout-north">
			<div id="title">
				<div id="logo"><img src="/images/logo.png" alt="logo"/></div>
				<h1>
				<a href="/">RoNoMo<span>.net</span></a>
			    </h1>
			    <p>
				Évitez les chantiers routiers!
			    </p>
			</div>
			<div id="menu">
				<?php if ($sf_user->isAuthenticated()): ?>
				<div id="m-routes" onclick="showContent('my-routes')">Mes Trajets</div>
				<div id="m-notif" onclick="showContent('my-notif')">Mes Notifications</div>
				<div id="m-new" onclick="showContent('new-route');">Nouveau Trajet</div>

				<div id="logout"><a href="/logout">Se Déconnecter</a></div>
				<div id="options"><a href="/settings">Options</a></div>
				<div id="who"> Connect&eacute;:	<?php echo $sf_user->getGuardUser()->getUsername(); ?></div>
				<?php else: ?>
					<div id="login"><a href="/login">Se connecter</a></div>
					<div id="apply"><a href="/apply">Cr&eacute;er un compte</a></div>
				<?php endif; ?>
			</div>

		</div>
		<div class="ui-layout-west">
			<div id="panels">
				<?php if ($sf_user->isAuthenticated() == 1 ): ?>
				<div class="panel" id ="new-route">
					<div class="content">
					</div>
				</div>
				<div class="panel" id="my-routes">
					<div class="content">
					</div>
				</div>
				<div class="panel" id="my-notif">
					<div class="content">
					</div>
				</div>
				<?php endif; ?>
				<div class="panel" id="default">
					<div class="content">
						<?php if ($sf_user->isAuthenticated() && sfContext::getInstance()->getRouting()->getCurrentRouteName() == "homepage"){
								//echo "showContent('my-routes');";
							} else{
								echo $sf_content;
								
							} ?>
					</div>
				</div>
			</div>
		</div>
		<div class="ui-layout-center">
			<div id="map_canvas"></div>
		</div>
	</body>
</html>
