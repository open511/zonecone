<table border='1'>
  <tr>
	<td>id</td>
	<td>Nom</td>
	<td>Etat</td>
  </tr>
<?php foreach ($roadworks as $roadwork): ?>
	<tr>
		<td>
      <a href="<?php echo url_for('rw/show?id='.$roadwork->getId(), true) ?>"><?php echo $roadwork->getID() ?></a>
        </td>
        <td>
          <?php echo $roadwork->getRaw('name') ?>
        </td>
        <td>
          <?php echo $roadwork->rwStatus ?>
        </td>
      </tr>

<?php endforeach; ?>
</table>