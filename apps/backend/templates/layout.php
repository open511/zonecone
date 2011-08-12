<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets()
 ?>
    <?php include_javascripts() ?>
  </head>
  <body>

      <div id="menu">
        <table>
        <tr><td>
            <?php echo link_to('Sources des chantiers', 'rw_source') ?>
          </td><td>
            <?php echo link_to('Gestion des chantiers', 'rw_roadwork') ?>
          </td><td>
            <?php echo link_to('Extention MTQ', 'rw_mtq_extention') ?>
          </td><td>
            <?php echo link_to('Gestion des usagers', 'sf_guard_user') ?>
          </td><td>
            <?php echo link_to('Gestion des permission', 'sf_guard_permission') ?>
          </td>
         </table>
      </div>
    <?php echo $sf_content ?>
  </body>
</html>
