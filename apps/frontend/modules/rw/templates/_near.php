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
	
	<?php
	
	if (is_null($roadwork->getStartDate())){
		$startDate = $roadwork->getRaw('start_date_text');
	} else {
		//$startDate = $roadwork->getDateTimeObject('start_date')->format('F');		
                 $startDate = strftime("%B");
	}
	
	if (is_null($roadwork->getEndDate())){
		$endDate = $roadwork->getRaw('end_date_text');
	} else {
		$endDate = $roadwork->getEndDate();		
	}
	?> 
	<div class="route"><p><b><a href="#"  onclick="showMarker(<?php echo $roadwork->getId() ?>)">
      <?php echo $roadwork->getRaw('name') ?></a></b> 
      <span ><a href="<?php echo url_for('rw/show?id='.$roadwork->getId()); ?>">[+]</a></span></p>
      <p><?php if (!is_null($roadwork->getRaw('road_name'))) : ?><b>Rues:</b> <?php echo $roadwork->getRaw('road_name') ?></br><?php endif;?>
	     <?php if (!is_null($startDate)) : ?><b>D&eacute;but:</b>  <?php echo $startDate ?></br><?php endif;?>
	     <?php if (!is_null($startDate)) : ?><b>Fin:</b>  <?php echo $endDate ?><?php endif;?></p>
    </div>
    <?php endforeach; ?>   

 
