<h2>Il y a des nouvelles sur les chantiers !</h2>

<?php $occ = count($rw_notifications);
?>

<p>
	Vous avez <?php echo $occ ?> 
	nouvelle<?php if($occ  > 1){ echo "s";}?> notification<?php if($occ  > 1){ echo "s";}?> vous concernant!
</p>

<table>
    <?php foreach ($rw_notifications as $rw_notification): ?>
    <tr><td>
		<?php 
		$string = "<p style='padding: 5px;'>";
		if ($rw_notification->getRwStatus() == RwRoadwork::$rwStatusEnum['is_new']){
			$string .= "- Ajout d'un "; 
		} elseif ($rw_notification->getRwStatus() == RwRoadwork::$rwStatusEnum['is_updated']){
			$string .= "- Modification du ";
		} else {
			$string .= "- Suppression du ";
		}

		$string .= "chantier nomm&eacute; <i>";

//TODO : tester si les getRaw se font sur des objets correctement instanciés... sinon ça bloque completement l'envoie des notifications
		$string .= "<a href=\"" .  url_for('rw/show?id='.$rw_notification->getRwRoadwork()->id, true);
		$string .= "\">" . $rw_notification->getRwRoadwork()->getRaw('name') . "</a></i>";
		$string .= " ayant un impact sur votre route <b>";
		$string .= "<a href=\"" .  url_for('routes/show?id='.$rw_notification->getRwUserRoute()->id, true);
		$string .= "\">" . $rw_notification->getRwUserRoute()->getRaw('name') . "</a></b></p>";
		echo $string;
     ?>
    </td></tr>
    <?php endforeach; ?>
  </tbody>
</table>

<i>ZoneCone</i>
