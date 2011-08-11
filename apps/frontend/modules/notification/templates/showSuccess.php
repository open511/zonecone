<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $rw_notification->getId() ?></td>
    </tr>
    <tr>
      <th>User:</th>
      <td><?php echo $rw_notification->getUserId() ?></td>
    </tr>
    <tr>
      <th>Rw:</th>
      <td><?php echo $rw_notification->getRwId() ?></td>
    </tr>
    <tr>
      <th>Route:</th>
      <td><?php echo $rw_notification->getRouteId() ?></td>
    </tr>
    <tr>
      <th>Is sent:</th>
      <td><?php echo $rw_notification->getIsSent() ?></td>
    </tr>
    <tr>
      <th>Rw status:</th>
      <td><?php echo $rw_notification->getRwStatus() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $rw_notification->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $rw_notification->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('notification/edit?id='.$rw_notification->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('notification/index') ?>">List</a>
