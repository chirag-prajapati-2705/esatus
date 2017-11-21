<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">
      Appels
      <small>Liste des appels</small>
    </h1>

  </div>
</div>
<?php if ($calls): ?>
<div class="container"> 
  <div class="row">
    <div class="span12">
      <h2>Appels (<?= $count; ?>)</h2>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Ref</th>
            <th>Client</th>
            <th>Service</th>
            <th>Date</th>
            <th>Durée</th>
            <th>TTC</th>
            <th>Commision</th>
            <th>Statut</th>
            <th>Paiement</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($calls as $k=>$v): ?><?php $v = current($v); ?>
          <tr>
            <td class="white"><?= $v->service_id ?>-<?= $v->user_id ?></td>
            <td class="white"><a href="<?= Router::url('admin/admins/user/slug:'.$v->slug.'/id:'.$v->user_id); ?>"><?= $v->user; ?></a></td>
            <td class="white"><?= $v->service; ?></td>
            <td class="white"><?= $v->date; ?></td>
            <td class="white"><?= $v->duration; ?></td>
            <td class="white"><?= $v->cost; ?></td>
            <td class="white"><?= $v->commission; ?></td>
            <td class="white"><?= $v->status; ?></td>
            <td class="white"><?= $v->payment; ?></td>
            <td class="white">
              <a href="<?= Router::url('admin/admins/switch/id:'.$v->id); ?>" class="btn btn-info">
                <small>Modifier</small>
              </a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php endif; ?>