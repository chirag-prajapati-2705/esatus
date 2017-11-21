<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">
      RIBs
      <small>Liste des RIBs</small>
    </h1>

  </div>
</div>
<?php if ($ribs): ?>
<div class="container"> 
  <div class="row">
    <div class="span12">
      <h2>RIBs (<?= $count; ?>)</h2>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Id</th>
            <th>Client</th>
            <th>Banque</th>
            <th>IBAN</th>
            <th>BIC</th>
            <th>Prelevement</th>
            <th>Statut</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($ribs as $k=>$v): ?><?php $v = current($v); ?>
          <tr>
            <td class="white"><?= $v->id ?></td>
            <td class="white"><a href="<?= Router::url('admin/admins/user/slug:'.$v->slug.'/id:'.$v->userid); ?>"><?= $v->user; ?></a></td>
            <td class="white"><?= $v->banque; ?></td>
            <td class="white"><?= $v->iban; ?></td>
            <td class="white"><?= $v->bic; ?></td>
            <td class="white"><?= $v->prelevement; ?></td>
            <td class="white">
              <a href="<?= Router::url('admin/admins/rswitch/id:'.$v->id); ?>" class="btn btn-<?= ($v->status == 0 || $v->status == 2) ? 'warning':'info'; ?>"><small><?= ($v->status == 1) ? 'Activé':(($v->status == 0) ? 'En attente de validation' : 'Désactivé'); ?></small></a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php endif; ?>