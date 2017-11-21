<div class="container masterhead">
	<div class="demo-headline">
		<h1 class="demo-logo">Notez l'appel<br><small>Qu'avez-vous pensé de la prestation de l'expert ?</small></h1>
	</div>
</div>
<div class="container">    
    <div class="row">  
      	<div class="text-center">
            <a href="fiche.html">
              	<img class="rounded" src="<?= IMAGE; ?>services/<?= $service->img; ?>" alt="" width="150" height="150"><br>
              	<h1 class=""><?= $service->user->first_name.' '.$service->user->last_name; ?></h1>
            </a>
            <p><?= $date; ?></p><br>
      	</div>
    </div>
    <div class="row row-form">
      	<div class="login-form span4 offset4">
      		<form action="<?= Router::url('ratings/rate/id:'.$id); ?>" method="post">
      			<div class="control-group">
	              	<label class="text" for="">Votre note :</label>
	              	<select style="float: none;" class="login-field" name="rate">
	                	<option value="10">10</option> 
		                <option value="9">9</option> 
		                <option value="8">8</option> 
		                <option value="7">7</option> 
		                <option value="6">6</option> 
		                <option value="5">5</option> 
		                <option value="4">4</option> 
		                <option value="3">3</option> 
		                <option value="2">2</option> 
		                <option value="1">1</option> 
	              	</select>
	            </div>
	            <div class="control-group">
	              	<?= $this->Form->textarea(array(
						'name'=>'comment','label'=>'Votre avis','addClass'=>'text','options'=>array('class'=>'login-field','rows'=>5)
			        )); ?>
	            </div>
      			<input type="submit" class="btn btn-primary btn-large btn-block" value="Valider"></a>
      		</form>
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