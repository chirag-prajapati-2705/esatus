<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">
      Impayés
      <small>Liste des impayés</small>
    </h1>

  </div>
</div>
<?php if ($calls): ?>
<div class="container"> 
  <div class="row">
    <div class="span12">
      <h2>Impayés (<?= $count; ?>)</h2>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Client</th>
            <th>Service</th>
            <th>Date</th>
            <th>Durée</th>
            <th>Commision</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($calls as $k=>$v): ?><?php $v = current($v); ?>
          <tr>
              <td class="white"><a href="<?= Router::url('admin/admins/user/slug:'.$v->slug.'/id:'.$v->user_id); ?>"><?= $v->user; ?></a></td>
            <td class="white"><?= $v->service; ?></td>
            <td class="white"><?= $v->date; ?></td>
            <td class="white"><?= $v->duration; ?></td>
            <td class="white"><?= $v->commission; ?> <small>TTC</small></td>
            <td class="white">
              <a href="<?= Router::url('admin/admins/regulation/id:'.$v->id); ?>" class="btn btn-info">
                <small>Régulariser</small>
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