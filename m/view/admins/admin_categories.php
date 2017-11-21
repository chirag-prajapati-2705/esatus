<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">
      Categories
      <small>Liste des categories et sous catégories</small>
    </h1>
  </div>
</div>

<?php foreach ($categories as $k=>$v): ?><?php $v = current($v); ?> 
<div class="container"> 
  <div class="row">
    <div class="span12">
      <h2><?= $v->title; ?> (<?= count($v->subcategories); ?>)</h2>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Titre</th>
            <th>Url</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($v->subcategories as $sk=>$sv): ?><?php $sv = current($sv); ?>
          <tr>
            <td class="white"><?= $sv->title; ?></td>
            <td class="white"><?= $sv->slug; ?></td>
            <td class="white">
              <a href="<?= Router::url('admin/admins/edit/id:'.$sv->id); ?>" class="btn btn-info">
                <small>Modifier</small>
              </a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <a href="<?= Router::url('admin/admins/add/id:'.$v->id); ?>" class="btn btn-block btn-large btn-info">Créer une nouvelle sous-catégories dans <?= strtolower($v->title); ?></a>
    </div>
  </div>
</div>
<br><br><hr><br>
<?php endforeach; ?>