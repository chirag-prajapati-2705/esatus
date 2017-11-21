<div class="container masterhead">
	<div class="demo-headline">
		<h2 class="demo-logo">Connectez-vous !<br><small>Accéder à votre espace privé.</small></h2>
	</div>
</div>
<div class="container">
	<?= $this->Session->flash(); ?>
    <div class="row row-form">
      	<div class="login-form  bloc-center" >
      		<form action="<?= Router::url('profiles/login'); ?>" method="post">
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
            <a class="login-link" href="<?= Router::url('profiles/password'); ?>">Mot de passe oublié ?</a>
      	</div>
    </div>
</div>