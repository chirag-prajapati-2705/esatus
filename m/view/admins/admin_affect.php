<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">
      Affectation des experts
      <small>Affectation des experts</small>
    </h1>

  </div>
</div>
 
<div class="container"> 
  <div class="row">
    <div class="span12">
     
      <table class="table table-bordered">
        <thead>
          <tr>
            <th></th>
            <th>Identité</th>
            <th>Pseudo</th>
            <th>Service</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
         <?php foreach ($services as $k=>$v): ?><?php $v = current($v); ?>
          <tr>
            <td class="white"><input type="checkbox"></td>
            <td class="white"><?= $v->user; ?></td>
            <td class="white"><?= $v->username; ?></td>
            <td class="white"><?= $v->title; ?></td>
            <?php if($v->affectation != -1): ?>
            <td class="white"><a href="<?= Router::url('admin/admins/toggleAffecter/id1:'.$idcompagne.'/id:'.$v->id); ?>" class="btn btn-<?= ($v->affectation == 0) ? 'info':'warning'; ?>"><small><?= ($v->affectation == 0) ? 'Ajouter':'Retirer'; ?></small></a></td>
            <?php else: ?>
            <td class="white"><a href="#" class="btn btn-success"><small>En promo</small></td>
            <?php endif; ?>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>