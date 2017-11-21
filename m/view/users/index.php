<script src="http://www.esatus.fr/bin/js/tracking.js"></script>
<script type="text/javascript">
  adroll_segments = "1e239576";
  adroll_custom_data = {"email": <?php echo $this->Session->profile('email'); ?>, "user_id": <?php echo $this->Session->profile("id") ?>}
</script>
<div class="container masterhead">
	<div class="demo-headline">
		<h1 class="demo-logo">Bienvenue <?= $user->pseudo; ?>,<br><small>Voici votre espace privé. Quelle page voulez-vous consulter   ?</small></h1>
	</div>
</div>

<div class="container">
    <div class="alert alert-info text-center flash"><h5>Pour appeler nos experts Esatus dans les meilleures conditions,<br/>merci de tenir à jour vos informations personnelles et vérifier la validité de votre carte bancaire.</h5></div>
    
    <div class="row demo-tiles">
      	<div class="span3">
            <a href="<?= Router::url('users/datas'); ?>">
              	<div class="tile">
                	<i class="icon-user"></i>
                	<h3 class="tile-title">Vos informations</h3>
              	</div>
            </a>
      	</div>
      	<div class="span3">
            <a href="<?= Router::url('users/calls'); ?>">
              	<div class="tile">
	                <i class="icon-phone"></i>
	                <h3 class="tile-title">Vos appels</h3>
              	</div>
            </a>
      	</div>
      	<div class="span3">
            <a href="<?= Router::url('users/card'); ?>">
              	<div class="tile">
	                <i class="icon-lock"></i>
	                <h3 class="tile-title">Votre carte bancaire</h3>
              	</div>
            </a>
      	</div>
        <div class="span3">
            <?php if ($this->requestAction(array('controller'=>'services','action'=>'test'))): ?>
            <a href="<?= Router::url('services/index'); ?>">
                <div class="tile">
                  <i class="icon-group"></i>
                  <h3 class="tile-title">Espace expert</h3>
                </div>
            </a>
            <?php else: ?>
            <a href="<?= Router::url('services/create'); ?>">
              	<div class="tile">
                	<i class="icon-group"></i>
                	<h3 class="tile-title">Devenir expert !</h3>
              	</div>
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>