<h2>Vos notifications</h2>

<?php if (count($rw_notifications) == 0) :?>
<h4>Pas de nouvelle notification</h4>
<?php else :?>
<h4>Nouvelles notifications</h4>
    <?php foreach ($rw_notifications as $rw_notification): ?>
    <div class="route">
	   <b>Type:</b> 
   		<?php 
		if ($rw_notification->getRwStatus() == RwRoadwork::$rwStatusEnum['is_new']){
			echo "Ajout"; 
		} elseif ($rw_notification->getRwStatus() == RwRoadwork::$rwStatusEnum['is_updated']){
			echo "Modification";
		} else {
			echo "Suppression";
		}    ?>
	<br/>
    <b>Trajet affect&eacute;:</b> <a href="<?php echo url_for('routes/show?id='. $rw_notification->getRwUserRoute()->getId()) ?>"><?php echo $rw_notification->getRwUserRoute()->getRaw('name') ?></a><br/>
    <b>Chantier :</b> <a href="<?php echo url_for('rw/show?id='. $rw_notification->getRwRoadwork()->getId()) ?>"><?php echo $rw_notification->getRwRoadwork()->getRaw('name') ?></a><br/>
    </div>
    <?php endforeach; ?>
<?php endif; ?>
	
<h4>Notifications passées</h4>

<?php foreach ($rw_old_notifications as $rw_notification): ?>
<div class="route">
   <b>Type:</b> 
	<?php 
	if ($rw_notification->getRwStatus() == RwRoadwork::$rwStatusEnum['is_new']){
		echo "Ajout"; 
	} elseif ($rw_notification->getRwStatus() == RwRoadwork::$rwStatusEnum['is_updated']){
		echo "Modification";
	} else {
		echo "Suppression";
	}    ?>
	<br/>

    <b>Trajet affect&eacute;:</b> <a href="<?php echo url_for('routes/show?id='. $rw_notification->getRwUserRoute()->getId()) ?>"><?php echo $rw_notification->getRwUserRoute()->getRaw('name') ?></a><br/>
    <b>Chantier :</b> <a href="<?php echo url_for('rw/show?id='. $rw_notification->getRwRoadwork()->getId()) ?>"><?php echo $rw_notification->getRwRoadwork()->getRaw('name') ?></a><br/>
</div>
<?php endforeach; ?>