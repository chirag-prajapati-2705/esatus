<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">
      Campagne de promotion
      <small>Campagne de promotion</small>
    </h1>

  </div>
</div>
<div class="container"> 
  <div class="row">
    <div class="span12">
      <a href="<?= Router::url('admin/admins/addPromo'); ?>">Nouvelle compagne</a>
      <h1 class="demo-logo"><small>Promo de Bienvenue</small></h1>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Libellé</th>
            <th>Statut</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="white"><a href="<?= Router::url('admin/admins/admin_editPromo/id:'.$CampagneBienvenue->Campagne->id); ?>"><?= $CampagneBienvenue->Campagne->libelle; ?></a></td>
            <td class="white"><a href="<?= Router::url('admin/admins/toggleCampagne/id:'.$CampagneBienvenue->Campagne->id); ?>" class="btn btn-<?= ($CampagneBienvenue->Campagne->validated == 1) ? 'info':'warning'; ?>"><small><?= ($CampagneBienvenue->Campagne->validated == 1) ? 'Activé':'Désactivé'; ?></small></a></td>
            <td class="white">
                <a class="btn btn-info" href="<?= Router::url('admin/admins/affect'); ?>"><small>+</small></a>
                <a class="btn btn-info" href="<?= Router::url('admin/admins/affect'); ?>"><small>Affectation par catégorie</small></a>
            </td>
            
          </tr>
        </tbody>
      </table>
      
      <h1 class="demo-logo"><small>Promotions</small></h1>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Libellé</th>
            <th>Statut</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($campagne as $k=>$v): ?><?php $v = current($v); ?>
          <tr>
            <td class="white"><a href="<?= Router::url('admin/admins/admin_editPromo/id:'.$v->id); ?>"><?= $v->libelle; ?></a></td>
            <td class="white"><a href="<?= Router::url('admin/admins/toggleCampagne/id:'.$v->id); ?>" class="btn btn-<?= ($v->validated == 1) ? 'info':'warning'; ?>"><small><?= ($v->validated == 1) ? 'Activé':'Désactivé'; ?></small></a></td>
            <td class="white">
                <a class="btn btn-info" href="<?= Router::url('admin/admins/affect/id:'.$v->id); ?>"><small>+</small></a>
                <a class="btn btn-info" href="<?= Router::url('admin/admins/affectcategorie/id:'.$v->id); ?>"><small>Affectation par catégorie</small></a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>