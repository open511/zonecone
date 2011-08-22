Il y a des nouvelles sur les chantiers !

<?php $occ = count($rw_notifications);
?>

Vous avez <?php echo $occ ?> nouvelle<?php if ($occ > 1){ echo "s";}  ?> notification<?php if ($occ > 1){ echo "s";}  ?> vous concernant!

    <?php foreach ($rw_notifications as $rw_notification) {
		$string = "";
		if ($rw_notification->getRwStatus() == RwRoadwork::$rwStatusEnum['is_new']){
			$string .= "- Ajout d'un "; 
		} elseif ($rw_notification->getRwStatus() == RwRoadwork::$rwStatusEnum['is_updated']){
			$string .= "- Modification du ";
		} else {
			$string .= "- Suppression du ";
		}

		$string .= "chantier nommé " . $rw_notification->getRwRoadwork()->getRaw('name');
		$string .= " (" . url_for('rw/show?id='.$rw_notification->getRwRoadwork()->id, true) . ")";
		$string .= " ayant un impact sur votre route  " . $rw_notification->getRwUserRoute()->getRaw('name');
		$string .= " (" .  url_for('routes/show?id='.$rw_notification->getRwUserRoute()->id, true) . ").\n\n";
		echo $string;
}
?>
ZoneCone
