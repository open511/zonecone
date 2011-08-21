<?php setlocale(LC_ALL, 'fr_CA'); ?>
<p>&nbsp;</p>

<?php if ($sf_user->isAuthenticated() == false):  ?>
	<div class="warning">En cr&eacute;ant un compte sur RoNoMo, vous pourrez b&eacute;n&eacute;ficier de notifications par courriel sur vos trajets favoris. </div>
<?php endif; ?>

<?php 

$nbrw = count($roadworks);

if ($nbrw <= 0) {echo "<h2>Pas de chantier, la voie est libre!<h2>";}
elseif ($nbrw ==1) {echo "<h2>Un chantier &agrave; proximit&eacute;</h2>";}
else{echo "<h2>$nbrw chantiers &agrave; proximit&eacute;</h2>";}

?>

    <?php foreach ($roadworks as $roadwork): ?>
	
	<div class="route">
      <div class="infoicon"><img src='/images/cone-small-<?php echo $roadwork->getIconName();?>.png' alt='cone'/></div>

<p><b><a href="#"  onclick="showMarker(<?php echo $roadwork->getId() ?>)">
      <?php echo $roadwork->getRaw('name') ?></a></b></p> 
      <p><?php if (!is_null($roadwork->getRaw('road_name'))) : ?><b>Rues:</b> <?php echo $roadwork->getRaw('road_name') ?></br><?php endif;?>
             <?php echo "<p>Début: <b>". $roadwork->getFormattedStartDate() ."</b> <br/>";
                   echo "Fin: <b>". $roadwork->getFormattedEndDate() ."</b></p>"; ?>
      <p><?php echo $roadwork->getShortDescription();  ?> <span><a href="<?php echo url_for('rw/show?id='.$roadwork->getId()); ?>"> [plus]</a></span></p>

    </div>
    <?php endforeach; ?>   

 
