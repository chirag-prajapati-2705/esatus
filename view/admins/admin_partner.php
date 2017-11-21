<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">
      Partenaires
      <small>Liste des partenaires</small>
    </h1>
      
  </div>
</div>

<div class="container"> 
    <div class="row">
    <div class="span12">
      <h2>Partenaires (<?= $count; ?>)</h2>
      <a href="<?= Router::url('admin/admins/addpartner'); ?>"><button type="button" class="btn btn-primary">Ajouter un partenaire</button></a>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Raison social</th>
            <th>E-mail</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($Partner as $k=>$v): ?><?php $v = current($v); ?>
          <tr>
            <td class="white"><?= $v->raison; ?></td>
            <td class="white"><?= $v->email; ?></td>
            <td class="white"><a href="<?= Router::url('admin/admins/clientpartnerliste/id:'.$v->id); ?>">Clients</a></td>
            <td class="white"><a href="<?= Router::url('admin/admins/appelspartnerliste/id:'.$v->id); ?>">Appels</a></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>