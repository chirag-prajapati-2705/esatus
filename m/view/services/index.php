<div class="container masterhead">
	<div class="demo-headline">
		<h1 class="demo-logo">Bienvenue,<br><small>Voici votre espace expert. Quelle service voulez-vous gérer ?</small></h1>
	</div>
</div>

<div class="container grid">
  <div class="row">
    <?php foreach ($services as $k=>$v): ?><?php $v = current($v); ?>
    <div class="expert expert-grid span3 text-center">
      <a class="expert-thumbnail" href="<?= Router::url('services/view/cat:'.$v->category.'/subcat:'.$v->subcategory.'/'.$v->url); ?>"><img class="rounded" style="margin-bottom:10px;" src="<?= IMAGE; ?>services/<?= $v->img; ?>" alt="" /></a>
      <div class="expert-main-infos">
        <h3 class="expert-title"><?= ($v->username == '') ? $v->user->first_name.' '.$v->user->last_name:utf8_decode($v->username); ?></h3>
        <h6 class="expert-subtitle"><?= $v->title; ?></h6>
      </div>
      <a class="btn btn-info btn-large btn-block" href="<?= Router::url('services/view/cat:'.$v->category.'/subcat:'.$v->subcategory.'/'.$v->url); ?>" target="_blank">Voir la fiche</a>
      <a class="btn btn-primary btn-large btn-block" href="<?= Router::url('services/service/id:'.$v->id); ?>">Gérer ce service</a>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<?php if (count($services) <= 3): ?>
<div class="container">
    <div class="row text-center">
      	<a class="btn btn-primary btn-large" href="<?= Router::url('services/create'); ?>">Créer un nouveau service</a>
    </div>
</div>
<?php endif; ?>
