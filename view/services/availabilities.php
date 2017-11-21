<div class="container masterhead">
	<div class="demo-headline">
		<h1 class="demo-logo"><img class="rounded" src="<?= IMAGE; ?>services/<?= $service->img; ?>" alt="<?= $service->title; ?>"><br>Vos disponibilités<small>Indiquez ici vos périodes de disponibilités.</small></h1>
	</div>
</div>
<div class="container">
	<?= $this->Session->flash(); ?>
    <div class="row">
    	<div class="span12 well">
    		<p class="lead">Malin ! Le remplissage rapide</p>
	    	<form action="<?= Router::url('services/availabilities/id:'.$service->id); ?>" method="post" data-dynamic="<?= Router::url('ajax/availabilities/next'); ?>">
	    		<select name="status">
		            <option value="available">Disponible</option>
		            <option value="unavailable">Indisponible</option>
		      	</select>
		      	<select name="slot">
		            <option value="all">Tous les jours</option>
		            <option value="week">Du lundi au vendredi</option>
		            <option value="monday">Le lundi</option>
		            <option value="tuesday">Le mardi</option>
		            <option value="wednesday">Le mercredi</option>
		            <option value="thursday">Le jeudi</option>
		            <option value="friday">Le vendredi</option>
		            <option value="saturday">Le samedi</option>
		            <option value="sunday">Le dimanche</option>
		      	</select>
		          de
		      	<select name="from">
		      		<?php for ($i=0; $i<24; $i++): ?>
		            <option value="<?= $i; ?>"><?= str_pad($i,2,'0',STR_PAD_LEFT); ?>:00</option>
		        	<?php endfor; ?>
		      	</select>
		          à
		      	<select name="to">
		            <?php for ($i=1; $i<24; $i++): ?>
		            <option value="<?= $i; ?>"><?= str_pad($i,2,'0',STR_PAD_LEFT); ?>:00</option>
		        	<?php endfor; ?>
		      	</select>
	      		<input type="submit" class="btn btn-large btn-info btn-block" value="Appliquer">
	    	</form>
    	</div>
	</div>
	<hr>
</div>
<div class="container">
	<div class="row">
      	<div class="span12">
            <p>Cliquez sur les cases du tableau pour indiquer vos disponibilités aux clients Esatus.</p>
            <p>Vert = Disponible / Gris = Indisponible</p>
            <table class="table table-bordered">
              	<thead>
	                <tr>
	                  	<th>Heures</th>
	                  	<th>Lundi</th>
	                  	<th>Mardi</th>
	                  	<th>Mercredi</th>
	                  	<th>Jeudi</th>
	                  	<th>Vendredi</th>
	                  	<th>Samedi</th>
	                  	<th>Dimanche</th>
	                </tr>
              	</thead>
              	<tbody>
                	<?php for ($i=0; $i<24; $i++): ?>
	              	<tr>
		                <td class="blue"><?= str_pad($i,2,'0',STR_PAD_LEFT); ?>:00</td>
		                <?php foreach ($service->availabilities as $key=>$value): ?>
		                <?php 
		                  $slots = explode(';',$value); 
		                  $cls = false;
		                  foreach ($slots as $slot) {
		                    $hours = explode(':',$slot); 
		                    if ($i >= $hours[0] && $i < $hours[1]) {
		                      $cls = true;
		                    }
		                  }
		                ?>
		                <td<?= ($cls) ? ' class="green"':''; ?> data-day="<?= $key; ?>"></td>
		                <?php endforeach; ?>
	              	</tr>
	              	<?php endfor; ?>
              	</tbody>
            </table>
      	</div>
    </div>
    <div class="row text-center">
    	<div id="ajax-availabilities-saved" class="alert alert-success hide">Modifications enregistrées !</div>
    </div>
    <div class="row text-center">
      	<a class="btn btn-primary btn-large" href="<?= Router::url('ajax/availabilities/save/id:'.$service->id); ?>">Enregistrer</a>
      	<a class="btn btn-info btn-large" href="<?= Router::url('ajax/availabilities/empty/id:'.$service->id); ?>">Vider le tableau</a>
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