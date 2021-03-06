<div class="container masterhead">
	<div class="demo-headline">
		<h1 class="demo-logo">Bienvenue,<br><small>Voici votre espace expert. Quelle service voulez-vous gérer ?</small></h1>
	</div>
</div>

<?php foreach ($services as $k=>$v): ?><?php $v = current($v); ?>
<div class="container">
    <div class="row demo-tiles">
      	<div class="row demo-tiles">
      	<div class="span5 service">
            <img src="<?= IMAGE; ?>services/<?= $v->img; ?>" width="100" height="100">
            <div class="left">
              	<h3><?= $v->user->first_name.' '.$v->user->last_name; ?><br><small><?= $v->title; ?></small></h3>
            </div>
      	</div>
      	<div class="span2">
            <div class="rating no-margin-top">
              	<h4>Note</h4>
              	<p class="up"><?= $v->rating; ?></p>
            </div>
      	</div>
      	<div class="span2">
            <div class="rating no-margin-top">
              	<h4>Prix</h4>
              	<p class="up"><?= number_format($v->cost_per_minute,2); ?> €<sub> / min</sub></p>
            </div>
      	</div>
      	<div class="span3">
            <a class="btn btn-info btn-large btn-block" href="<?= Router::url('services/view/cat:'.$v->category.'/subcat:'.$v->subcategory.'/'.$v->url); ?>" target="_blank">Voir la fiche</a>
            <a class="btn btn-primary btn-large btn-block" href="<?= Router::url('services/service/id:'.$v->id); ?>">Gérer ce service</a>
      	</div>
    </div>
</div>
<?php endforeach; ?>
<?php if (count($services) <= 3): ?>
<div class="container">
    <div class="row text-center">
      	<a class="btn btn-primary btn-large" href="<?= Router::url('services/create'); ?>">Créer un nouveau service</a>
    </div>
</div>
<?php endif; ?>
<style type="text/css">
.center {
  margin: 0 auto;
  max-width: 300px;
  width: 100%;
  float: none;
}

.container {
	width: 1000px;
}

.row {
	margin-left: 0px;
}
</style>