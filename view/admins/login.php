<div class="container masterhead">
	<div class="demo-headline">
		<h1 class="demo-logo">Connectez-vous !<br><small>Accéder à l'administration.</small></h1>
	</div>
</div>
<div class="container">
    <div class="row row-form">
      	<div class="login-form span4 offset4">
      		<form action="<?= Router::url('admins/login'); ?>" method="post">
      			<div class="control-group">
    				<?= $this->Form->input(array(
						'type'=>'text','name'=>'email','label'=>'','addClass'=>'login-field-icon fui-mail-24','options'=>array('placeholder'=>'Votre adresse email','class'=>'login-field')
				    )); ?>
	            </div>
	            <div class="control-group">
	            	<?= $this->Form->input(array(
						'type'=>'password','name'=>'password','label'=>'','addClass'=>'login-field-icon fui-lock-24','options'=>array('placeholder'=>'Votre mot de passe','class'=>'login-field')
				    )); ?>
	            </div>
            	<input type="submit" class="btn btn-primary btn-large btn-block" value="Se connecter">
      		</form>
      	</div>
    </div>
</div>