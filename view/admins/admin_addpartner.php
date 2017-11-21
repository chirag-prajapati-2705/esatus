<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">
      Partenaire
      <small>Créer une partenaire</small>
    </h1>
  </div>
</div>

<div class="container">
    <div class="row row-form">
      	<div class="login-form span4 offset4">
      		<form action="" method="post">
      			<div class="control-group">
	            	<?= $this->Form->input(array(
						'type'=>'text','name'=>'raison','label'=>'Raison social','addClass'=>'text','options'=>array('placeholder'=>'Raison social','class'=>'login-field')
		            )); ?>
                        </div>
                        <div class="control-group">
	            	<?= $this->Form->input(array(
						'type'=>'text','name'=>'email','label'=>'Email','addClass'=>'text','options'=>array('placeholder'=>'Email','class'=>'login-field')
		            )); ?>
                        </div>
                        <div class="control-group">
	            	<?= $this->Form->input(array(
						'type'=>'text','name'=>'password','label'=>'Mot de passe','addClass'=>'text','options'=>array('placeholder'=>'Mot de passe','class'=>'login-field')
		            )); ?>
                        </div>
            	<input type="submit" class="btn btn-primary btn-large btn-block" value="Créer">
      		</form>
      	</div>
    </div>
</div>