<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">
      Notes sur <?= $customer->first_name; ?>
      <small>Retrouvez ici le notes prises sur votre client</small>
    </h1>
  </div>
</div>
<div class="container"> 
  <?= $this->Session->flash(); ?>
  <div class="row">
    <div class="span12">
      <form action="<?= $_SERVER['SCRIPT_URI']; ?>" method="post">
        <p><label for="comment"><strong>Ajouter une note :</strong></label></p>
        <textarea name="comment" class="span12"></textarea>
        <input type="submit" class="btn btn-primary" value="ajouter cette note">
      </form>
    </div>
  </div>
  <?php if ($comments): ?>
  <div class="row">
    <div class="span12">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Ajoutée le</th>
            <th>Note</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($comments as $k=>$v): ?><?php $v = current($v); ?>
          <tr>
            <td class="white"><?= $v->date; ?></td>
            <td class="white text-left" width="60%" style="text-align:left;"><?= $v->comment; ?></td>
            <td class="white"><a href="<?= Router::url('comments/erase/id:'.$v->id.'/sid:'.$v->service_id.'/cid:'.$v->user_id); ?>" class="btn btn-info tiny">supprimer</a></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php endif; ?>
</div>