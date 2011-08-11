

    <?php foreach ($roadworks as $roadwork): ?>  

<?php
		if (is_null($roadwork->getStartDate())){
			$startDate = $roadwork->getRaw('start_date_text');
		} else {
			$startDate = $roadwork->getStartDate();		
		}

		if (is_null($roadwork->getEndDate())){
			$endDate = $roadwork->getRaw('end_date_text');
		} else {
			$endDate = $roadwork->getEndDate();		
		}
?>

      <h2><?php
       if ($roadwork->getIsActive() == false){
	     echo "[Inactif] ";
       }  
       echo $roadwork->getRaw('name'); 
      ?></h2>

      <div class="route">
	   <?php
	   $severity = 2;
	   if (!is_null($roadwork->getSeverity())){
	     $severity = $roadwork->getSeverity();
	   }
	   if ($roadwork->getIsActive() == false){
		$severity = 9;
	}
	
	    ?>
	   <div class="infoicon"><img src='/images/cone-med-<?php  echo $severity;?>.png' alt='cone'/></div>
         <?php if (!is_null($roadwork->getRaw('road_name'))) : ?> <p><b>Rue(s) affect&eacute;(es) :</b> <?php  echo $roadwork->getRaw('road_name') ?></p><?php endif;?>
	     <?php if (!is_null($startDate)) : ?><p><b>D&eacute;but:</b>  <?php echo $startDate ?></p><?php endif;?>
	     <?php if (!is_null($startDate)) : ?><p><b>Fin:</b>  <?php echo $endDate ?></p><?php endif;?>

		<?php if (!is_null($roadwork->getRaw('direction'))) : ?><p><b>Direction:</b>  <?php echo $roadwork->getRaw('direction') ?><?php endif;?></p>		
		<?php if (!is_null($roadwork->getRaw('restriction'))) : ?><p><b>Entrave:</b>  <?php echo $roadwork->getRaw('restriction') ?><?php endif;?></p>
		<?php if (!is_null($roadwork->getRaw('description'))) : ?><p><b>Description des travaux:</b>  <?php echo $roadwork->getRaw('description') ?><?php endif;?></p>
	    <?php if (!is_null($roadwork->getRaw('workaround'))) : ?><p><b>D&eacute;tour:</b>  <?php echo $roadwork->getRaw('workaround') ?><?php endif;?></p>		

		<?php if (!is_null($roadwork->getRaw('url'))) : ?><p><a href="<?php echo $roadwork->getRaw('url') ?>">Informations suppl&eacute;mentaires en ligne</a><?php endif;?></p>
      </div>
    <?php endforeach; ?>
