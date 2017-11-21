<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">
      Experts
      <small>Liste des experts esatus</small>
    </h1>

  </div>
</div>
 
<div class="container"> 
  <div class="row">
    <div class="span12">
      <h2>Experts (<?= $count; ?>)</h2>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Identité</th>
            <th>Pseudo</th>
            <th>Service</th>
            <th>E-mail</th>
            <th>Date</th>
            <th>Appels</th>
            <th>Gain</th>
            <th>Commission</th>
            <th>Action</th>
            <th>Statut</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($services as $k=>$v): ?><?php $v = current($v); ?>
          <tr>
            <td class="white"><?= $v->user; ?></td>
            <td class="white"><?= $v->username; ?></td>
            <td class="white"><?= $v->title; ?></td>
            <td class="white"><a href="mailto:<?= $v->email; ?>"><?= $v->email; ?></a></td>
            <td class="white"><?= $v->date; ?></td>
            <td class="white"><?= $v->count; ?></td>
            <td class="white"><?= $v->benefit; ?> <small>TTC</small></td>
            <td class="white"><?= $v->reel; ?> <small>TTC</small></td>
            <td class="white">
              <a class="btn btn-info" href="<?= Router::url('admin/admins/service/slug:'.$v->slug.'/id:'.$v->id); ?>"><small>+</small></a>
            </td>
            <td class="white"><a href="<?= Router::url('admin/admins/toggle/id:'.$v->id); ?>" class="btn btn-<?= ($v->validated == 1) ? 'info':'warning'; ?>"><small><?= ($v->validated == 1) ? 'Activé':'Désactivé'; ?></small></a></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>