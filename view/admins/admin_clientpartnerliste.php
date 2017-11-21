<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">
      Clients
      <small>Liste des clients esatus</small>
    </h1>

  </div>
</div>
 
<div class="container"> 
    <div class="row">
    <div class="span12">
      <h2>Clients (<?= $count; ?>)</h2>
      <a href="<?= Router::url('admin/admins/export'); ?>">Exportation de contacts</a>

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>&nbsp;&nbsp;&nbsp;</th>
            <th>ID</th>
            <th>Identité</th>
            <th>E-mail</th>
            <th>Date</th>
            <th>Appels émis</th>
            <th>Dépensé</th>
            <th>Expert ?</th>
            <th>Source</th>
            <th>Question</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($profiles as $k=>$v): ?><?php $v = current($v); ?>
          <tr>
            <td class="white">
                <?php if($v->validated == 1): ?>
                    <img src="<?= IMAGE; ?>valider.jpg"  /> 
                <?php endif; ?>
            </td>
            <td class="white"><?= $v->id; ?></td>
            <td class="white" style="color:<?= $v->color; ?>;"><?= $v->pseudo; ?></td>
            <td class="white"><a href="mailto:<?= $v->email; ?>"><?= $v->email; ?></a></td>
            <td class="white"><?= $v->date_inscription; ?></td>
            <td class="white"><?= $v->count; ?></td>
            <td class="white"><?= $v->amount; ?></td>
            <td class="white"><?= $v->service; ?></td>
            <td class="white"><?= $v->source; ?></td>
            <td class="white"><?= $v->Question; ?></td>
            <td class="white">
              <a class="btn btn-info" href="<?= Router::url('admin/admins/user/slug:'.$v->slug.'/id:'.$v->id); ?>"><small>+</small></a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>