<?php setlocale(LC_ALL, 'fr_CA'); ?>
    <?php foreach ($roadworks as $roadwork): ?>  

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


      <h2><?php
       if ($roadwork->getIsActive() == false){
	     echo "[Inactif] ";
       }  
       echo $roadwork->getRaw('name'); 
      ?></h2>

      <div class="route">
             <?php if (!is_null($roadwork->getRaw('road_name'))) : ?> <p><b>Rue(s) affect&eacute;(es) :</b> <?php  echo $roadwork->getRaw('road_name') ?></p><?php endif;?>

	     <?php echo "<p>Début: <b>". $roadwork->getFormattedStartDate() ."</b> <br/>";
	           echo "Fin: <b>". $roadwork->getFormattedEndDate() ."</b></p>"; ?>

             <?php if ($roadwork->getIsUncertain() == true){echo "<p style='color:#900'><b>Ce chantier a un statut incertain</b> <a href='http://www.ronomo.net/faq#uncertain'>(?)</a> <sup>^_^</sup> </p>";} ?>

             <?php if ($roadwork->getIsNight() == true){echo "<p style='color:#009'><b>Ce chantier se déroule principalement de nuit</b> <a href='http://www.ronomo.net/faq#nuit'>(?)</a>  <sup>^_^</sup></p>";} ?>



    	     <?php if (!is_null($roadwork->getRaw('direction'))) : ?><p><b>Direction:</b>  <?php echo $roadwork->getRaw('direction') ?><?php endif;?></p>		
	     <?php if (!is_null($roadwork->getRaw('restriction'))) : ?><p><b>Entrave:</b>  <?php echo $roadwork->getRaw('restriction') ?><?php endif;?></p>
	     <?php if (!is_null($roadwork->getRaw('description'))) : ?><p><b>Description des travaux:</b>  <?php echo $roadwork->getRaw('description') ?><?php endif;?></p>
	     <?php if (!is_null($roadwork->getRaw('workaround'))) : ?><p><b>D&eacute;tour:</b>  <?php echo $roadwork->getRaw('workaround') ?><?php endif;?></p>		

	     <?php if (!is_null($roadwork->getRaw('url'))) : ?><p><a href="<?php echo $roadwork->getRaw('url') ?>">Informations suppl&eacute;mentaires en ligne</a><?php endif;?></p>
      </div>
    <?php endforeach; ?>
