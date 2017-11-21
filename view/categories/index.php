<div class="container masterhead">
	<div class="demo-headline">
            <h1 class="demo-logo"><small>Top catégories des Experts à votre disposition</small></h1>
            <h2>Cliquez sur l’icône Métier de votre Choix</h2>
	</div>
</div>        
<div class="container">
<?php $i=0; foreach ($categories as $k=>$v): ?><?php $v = current($v); ?>
	<?php if ($i%4 == 0): ?>
  	<div class="row demo-tiles">
  	<?php endif; ?>
      	<div class="col-md-3">
            <a href="<?= Router::url('categories/category/slug:'.$v->slug); ?>">
              	<div class="tile">
	                <i class="icon-<?= $v->icon; ?>"></i>
	                <h3 class="tile-title"><?= $v->title; ?></h3>
              	</div>
            </a>
      	</div>
    <?php if ($i%4 == 3): ?>
  	</div>
  	<?php endif; ?>
  	<?php $i++; ?>
<?php endforeach; ?>
</div>