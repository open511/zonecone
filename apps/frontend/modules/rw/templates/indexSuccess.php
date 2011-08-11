<?php echo "Hello : " . $sf_user->getGuardUser()->getUsername() . "<br/>" ?>
<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Geom</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($roadworks as $roadwork): ?>
    <tr>
      <td><a href="<?php echo url_for('rw/show?id='.$roadwork->getId()) ?>"><?php echo $roadwork->getId() ?></a></td>
      <td><?php echo $roadwork->getName() ?></td>
      <td><?php echo $roadwork->getGeom()      
      
      ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('rw/new') ?>">New</a>
