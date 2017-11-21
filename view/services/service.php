<div class="container masterhead">
	<div class="demo-headline">
		<h1 class="demo-logo"><img class="rounded" src="<?= IMAGE; ?>services/<?= $service->img; ?>" alt="<?= $service->title; ?>"><br><?= $service->title; ?><small>Gérer votre service.</small></h1>
	</div>
</div>
<div class="container">
    <div class="row demo-tiles">
      	<div class="span3">
            <a href="<?= Router::url('services/edit/id:'.$service->id); ?>">
              	<div class="tile">
                	<i class="icon-user"></i>
                	<h3 class="tile-title">Fiche de service</h3>
              	</div>
            </a>
      	</div>
      	<div class="span3">
            <a href="<?= Router::url('services/availabilities/id:'.$service->id); ?>">
              	<div class="tile">
                	<i class="icon-calendar"></i>
                	<h3 class="tile-title">Vos disponibilités</h3>
              	</div>
            </a>
      	</div>
      	<div class="span3">
            <a href="<?= Router::url('services/calls/id:'.$service->id); ?>">
              	<div class="tile">
                	<i class="icon-phone"></i>
                	<h3 class="tile-title">Vos appels reçus</h3>
              	</div>
            </a>
      	</div>
      	<div class="span3">
            <a href="<?= Router::url('services/repayments/id:'.$service->id); ?>">
              	<div class="tile">
	                <i class="icon-euro"></i>
	                <h3 class="tile-title">Vos gains</h3>
              	</div>
            </a>
      	</div> 
    </div>
    
    <div class="row demo-tiles">
      	<div class="span3">
            <a href="<?= Router::url('services/bdi/id:'.$service->id); ?>">
              	<div class="tile">
	                <i class="icon-lock"></i>
	                <h3 class="tile-title">Votre rib</h3>
              	</div>
            </a>
      	</div>
        
         <div class="span3">
            <a href="<?= Router::url('services/clients/id/'.$service->id); ?>">
                <div class="tile">
                  <i class="icon-group"></i>
                  <h3 class="tile-title">Vos clients</h3>
                </div>
            </a>
    </div> 
    </div>
    
   
</div>
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