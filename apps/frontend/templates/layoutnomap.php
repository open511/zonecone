<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<?php include_http_metas() ?>
		<?php include_metas() ?>
		<?php //include_title() ?>
		<link rel="shortcut icon" href="/favicon.ico" /><?php include_stylesheets() ?>
		<script src="http://code.jquery.com/jquery-1.6.1.min.js" type="text/javascript"></script>
		<script src="http://code.jquery.com/ui/1.8.13/jquery-ui.min.js" type="text/javascript"></script>
		<?php include_javascripts() ?>
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

		<div class="ui-layout-center">
			<div class="mainnomap">
				<div class="contentnomap">
								<?php echo $sf_content; ?>
				</div>
			</div>	
		</div>
	</body>
</html>
