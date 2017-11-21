<div class="container masterhead">
	<div class="demo-headline">
		<h1 class="demo-logo"><img class="rounded" src="<?= IMAGE; ?>services/<?= $service->img; ?>" alt="<?= $service->title; ?>"><br>Vos informations<br><small>Modifiez les informations relatives à votre service ici</small></h1>
	</div>
</div>
<div class="container">
	<?= $this->Session->flash(); ?>
    <div class="row row-form">
      	<div class="login-form">
      		<form action="<?= Router::url('services/edit/id:'.$service->id); ?>" method="post" enctype="multipart/form-data">
      			<h2>Image du service</h2>
      			<div class="user_img_wrapper text-center">
      				<img id="user_img" src="<?= IMAGE; ?>services/<?= $service->img; ?>" />
      			</div>
	            <div class="control-group">
	              	<label class="text" for="photo">Choisir/modifier :</label>
	              	<input type="file" id="user_img_file_input" class="login-field" name="photo" name="id" placeholder="Photo du service"/>
	            </div>

	            <h2>Type du service</h2>
            	<div class="control-group">
              		<label class="text" for="category_id">Catégorie :</label>
              		<select class="login-field" name="category_id"> 
						<?php foreach ($categories as $k=>$v): ?><?php $v = current($v); ?>
					   	<option value="<?= $v->id; ?>"<?php if ($v->id == $service->category_id): ?> selected="selected"<?php endif; ?>><?= $v->title; ?></option> 
					   	<?php endforeach; ?>
					</select>
            	</div>
	            <div id="dynamic" class="control-group">
	              	<label class="text" for="subcategory">Sous catégorie :</label>
	              	<select class="login-field" name="subcategory_id"> 
						<?php foreach ($subcategories as $k=>$v): ?><?php $v = current($v); ?>
					   	<option value="<?= $v->id; ?>"<?php if ($v->id == $service->subcategory_id): ?> selected="selected"<?php endif; ?>><?= $v->title; ?></option> 
					   	<?php endforeach; ?>
					</select>
	            </div>

	            <h2>Description du service</h2>
	            <div class="control-group">
	            	<?= $this->Form->input(array(
						'type'=>'text','name'=>'title','label'=>'Titre','addClass'=>'text','options'=>array('placeholder'=>'Titre du service','class'=>'login-field','value'=>$service->title)
		            )); ?>
	            </div>
	            <div class="control-group">
	            	<?= $this->Form->input(array(
						'type'=>'text','name'=>'username','label'=>'Pseudonyme','addClass'=>'text','options'=>array('placeholder'=>'Pseudonyme (non obligatoire)','class'=>'login-field','value'=>$service->username)
		            )); ?>
	            </div>
	            <div class="control-group">
	              	<?= $this->Form->textarea(array(
						'name'=>'description','label'=>'Description','addClass'=>'text','options'=>array('placeholder'=>'Votre description','class'=>'login-field','rows'=>3,'value'=>$service->description)
		            )); ?>
	            </div>
	            <div class="control-group">
	              	<?= $this->Form->textarea(array(
						'name'=>'presentation','label'=>'Présentation','addClass'=>'text','options'=>array('placeholder'=>'Votre présentation','class'=>'login-field','rows'=>8,'value'=>$service->presentation)
		            )); ?>
	            </div>
	            <div class="control-group">
	              	<?= $this->Form->textarea(array(
						'name'=>'reference','label'=>'Références','addClass'=>'text','options'=>array('placeholder'=>'Vos références','class'=>'login-field','rows'=>8,'value'=>$service->reference)
		            )); ?>
	            </div>

	            <h2>Prix du service</h2>
	            <div class="control-group">
	            	<?= $this->Form->input(array(
						'type'=>'text','name'=>'cost_per_call','label'=>'Tarif / Appel','addClass'=>'text','options'=>array('placeholder'=>'Coût par appel','class'=>'login-field','value'=>$service->cost_per_call)
		            )); ?>
	            </div>
	            <div class="control-group">
	            	<?= $this->Form->input(array(
						'type'=>'text','name'=>'cost_per_minute','label'=>'Tarif / Minute','addClass'=>'text','options'=>array('placeholder'=>'Coût par minute','class'=>'login-field','value'=>$service->cost_per_minute)
		            )); ?>
	            </div> 

	            <h2>Informations générales</h2> 
	            <div class="control-group">
	              	<?= $this->Form->input(array(
					'type'=>'text','name'=>'corporate_name','label'=>'Raison sociale','addClass'=>'text','options'=>array('placeholder'=>'Votre raison social','class'=>'login-field','value'=>$service->corporate_name)
		            )); ?>
	            </div>
	            <div class="control-group">
	              	<?= $this->Form->input(array(
						'type'=>'text','name'=>'duns','label'=>'SIRET','addClass'=>'text','options'=>array('placeholder'=>'Votre SIRET','class'=>'login-field','value'=>$service->duns)
		            )); ?>
	            </div> 
	            <div class="control-group">
	              	<?= $this->Form->input(array(
						'type'=>'text','name'=>'street_address','label'=>'Adresse','addClass'=>'text','options'=>array('placeholder'=>'Votre adresse','class'=>'login-field','value'=>$service->street_address)
		            )); ?>
	            </div>
	            <div class="control-group">
	              	<?= $this->Form->input(array(
						'type'=>'text','name'=>'city','label'=>'Ville','addClass'=>'text','options'=>array('placeholder'=>'Votre ville','class'=>'login-field','value'=>$service->city)
		            )); ?>
	            </div> 
	            <div class="control-group">
	              	<?= $this->Form->input(array(
						'type'=>'text','name'=>'zipcode','label'=>'Code postal','addClass'=>'text','options'=>array('placeholder'=>'Votre code postal','class'=>'login-field','value'=>$service->zipcode)
		            )); ?>
	            </div>

	            <h2>Téléphone</h2>
	            <div class="control-group">
	              	<?= $this->Form->input(array(
						'type'=>'text','name'=>'phone','label'=>'Numéro','addClass'=>'text','options'=>array('placeholder'=>'0123456789','class'=>'login-field','value'=>$service->phone)
		            )); ?>
	            </div>

      			<input type="submit" class="btn btn-primary btn-large btn-block" value="Valider">
      		</form>
      	</div>
    </div>
</div>

<script type="text/javascript">
	// Aperçu de l'image avant upload
	function readURL(input) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#user_img').attr('src', e.target.result);
	        }
	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$("#user_img_file_input").change(function(){
	    readURL(this);
	});
</script>