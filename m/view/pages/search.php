<div class="container masterhead">
	<div class="demo-headline">
	  	<h1 class="demo-logo">Recherche<br>
        <small>
	  		<?php if ($services): ?>
	  		Voici la liste de nos experts.
	  		<?php else: ?>
	  		Aucun expert ne correspond aux termes de votre recherche.
	  		<?php endif; ?>
        </small>
	  	</h1>
	</div>
</div>
<div class="container">
	<?php foreach ($services as $k=>$v): ?><?php $v = current($v); ?>
    <div class="row demo-tiles">
      	<div class="span5 service">
            <img src="<?= IMAGE; ?>services/<?= $v->img; ?>" width="100" height="100">
            <div class="left">
              	<h3><?= ($v->username == '') ? $v->user->first_name.' '.$v->user->last_name:$v->username; ?><br><small><?= $v->title; ?></small></h3>
            </div>
      	</div>
      	<div class="span2">
            <div class="rating no-margin-top">
              	<h4>Note</h4>
              	<p class="up"><?= str_replace('.00','',$v->rating); ?></p>
            </div>
      	</div>
      	<div class="span2">
            <div class="rating no-margin-top">
              	<h4>Prix</h4>
              	<p class="up"><?= number_format($v->cost_per_minute,2); ?> €<sub> / min</sub></p>
            </div>
      	</div>
      	<div class="span3">
            <a class="btn btn-info btn-large btn-block" href="<?= Router::url('services/view/cat:'.$v->category.'/subcat:'.$v->subcategory.'/'.$v->url); ?>">Voir sa fiche</a>
            <a class="btn btn-primary btn-large btn-block" href="<?= Router::url('calls/call/'.$v->url); ?>">Appeler</a>
      	</div>
    </div>
<?php endforeach; ?>
</div>