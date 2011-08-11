<?php foreach ($rw_user_routes as $rw_user_route): ?> 
<h2><?php echo $rw_user_route->getName() ?></h2>

<table style="width:90%; border-spacing: 10px; border-collapse: collapse; margin: 10px auto">
  <tbody>
    <tr>
      <th width="100">Point de départ:</th>
      <td><div style="padding:5px;"><?php echo $rw_user_route->getStartPointName() ?></div></td>
    </tr>
    <tr>
      <th>Destination: </th>
      <td><div style="padding:5px;"><?php echo $rw_user_route->getEndPointName() ?></div></td>
    </tr>
  </tbody>
</table>
<?php endforeach; ?>    


<hr />

<?php include_partial('rw/near', array('roadworks' => $roadworks)) ?>
<!-- TODO : transfert this part in template _indexmini belonging to roadworks and not to routes-->

