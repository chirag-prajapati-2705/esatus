<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">
      Appels vidéo
      <small>Liste des appels</small>
    </h1>

  </div>
</div>
<?php if ($videoCallDetail): ?>
<div class="container"> 
  <div class="row">
    <div class="span12">
      <h2>Appels vidéo (<?= $count; ?>)</h2>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Ref</th>
            <th>Client</th>
            <th>Service</th>
            <th>Date</th>
            <th>Durée</th>
            <th>TTC</th>
            <th>Statut</th>
            <th>Paiement</th>
            <th>Action</th>
          </tr>
        </thead>
        
        <tbody>
          <?php foreach ($videoCallDetail as $k=>$v): ?><?php $v = current($v); ?>
           
          <tr>
            <td class="white"><?= $v->service_id ?>-<?= $v->user_id ?></td>
            <td class="white"><?= $v->user; ?></td>
            <td class="white"><?= $v->service; ?></td>
            <td class="white"><?= $v->debut; ?></td>
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