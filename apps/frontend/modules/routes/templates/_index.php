<h2>Vos trajets</h2>

<?php if (count($rw_user_routes) == 0): ?>
   <h4>Vous n'avez pas de trajet actif. <a href="#" onclick="showContent('new-route');">Ajoutez-en un !</h4>
<?php else: ?>

    <?php foreach ($rw_user_routes as $rw_user_route): ?>
  <div class="route">
    <h4><a href="<?php echo url_for('routes/show?id='.$rw_user_route->getId()) ?>"><?php echo $rw_user_route->getName() ?></a></h4>
    <div class="subroute"><p><?php echo link_to('Supprimer', 'routes/delete?id='. $rw_user_route->getId(), array('method' => 'delete', 'confirm' => 'Etes-vous certain de vouloir supprimer ce trajet ?')); ?>
    - Travaux actifs :  <?php print_r($rw_roadworks[$rw_user_route->getId()]); ?> </p></div>
  </div>  
  <?php endforeach; ?>
<?php endif; ?>