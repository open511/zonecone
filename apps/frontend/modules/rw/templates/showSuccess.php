<?php setlocale(LC_ALL, 'fr_CA'); ?>
    <?php foreach ($roadworks as $roadwork): ?>  

      <div class="infoicon"><img src='/images/cone-med-<?php echo $roadwork->getIconName();?>.png' alt='cone'/></div>

      <h2><?php
       if ($roadwork->getIsActive() == false){
	     echo "[Inactif] ";
       } elseif ($roadwork->severity == 1) {
             echo "<span style='color: #". RwRoadwork::$rwSeverityColorEnum[$roadwork->severity]  ."'>
                         [". RwRoadwork::$rwSeverityTextEnum[$roadwork->severity] ."]</span> ";
      } 
       echo $roadwork->getRaw('name'); 
      ?></h2>

      <div>
             <?php if (!is_null($roadwork->getRaw('road_name'))) : ?> <p><b>Rue(s) affect&eacute;(es) :</b> <?php  echo $roadwork->getRaw('road_name') ?></p><?php endif;?>


<div class="route">
	     <?php echo "<p>Début: <b>". $roadwork->getFormattedStartDate() ."</b> <br/>";
	           echo "Fin: <b>". $roadwork->getFormattedEndDate() ."</b></p>"; ?>

             <?php if ($roadwork->getIsUncertain() == true){echo "<p style='color:#900'><b>Ce chantier a un statut incertain</b> <a href='/faq#uncertain'>(?)</a> <sup>^_^</sup> </p>";} ?>

             <?php if ($roadwork->getIsNight() == true){echo "<p style='color:#009'><b>Ce chantier se déroule principalement de nuit</b> <a href='/faq#nuit'>(?)</a>  <sup>^_^</sup></p>";} ?>

             <?php if ($roadwork->getIsActive() == false && $roadwork->getIsUncertain() == false){echo "<p style='color:#888'><b>Ce chantier semble inactif</b> <a href='/faq#inactive'>(?)</a>  <sup>^_^</sup></p>";} ?>
</div>

    	     <?php if (!is_null($roadwork->getRaw('direction'))) : ?><div class="route"><p><b>Direction:</b>  <?php echo $roadwork->getRaw('direction') ?></p></div><?php endif;?>		
	     <?php if (!is_null($roadwork->getRaw('restriction'))) : ?><div class="route"><p><b>Entrave:</b>  <?php echo $roadwork->getRaw('restriction') ?></p></div><?php endif;?>
	     <?php if (!is_null($roadwork->getRaw('description'))) : ?><div class="route"><p><b>Description des travaux:</b>  <?php echo $roadwork->getRaw('description') ?></p></div><?php endif;?>
	     <?php if (!is_null($roadwork->getRaw('workaround'))) : ?><div class="route"><p><b>D&eacute;tour:</b>  <?php echo $roadwork->getRaw('workaround') ?></p></div><?php endif;?>		

	     <?php if (!is_null($roadwork->getRaw('url'))) : ?><div class="route"><p><a href="<?php echo $roadwork->getRaw('url') ?>">Informations suppl&eacute;mentaires en ligne</a></p></div><?php endif;?>
      </div>
    <?php endforeach; ?>
