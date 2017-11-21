<div class="container masterhead" style="width: 100%">
    <div class="demo-headline">
        <img src="https://www.esatus.fr/bin/images/logo.png">
    </div>
</div>
<div class="container" style="width: 100%;">
    <?= $this->Session->flash(); ?>
    <div class="row row-form text-center" style="margin:10px;">
        <div class="login-form" style="margin:0px;padding: 10px;">
      		<form action="<?= Router::url('profiles/login'); ?>" method="post" style="margin:0;padding: 10px;">
                    <div class="control-group">
                        <?=
                        $this->Form->input(array(
                            'type' => 'text', 'name' => 'email', 'label' => '', 'addClass' => 'login-field-icon fui-mail-24', 'options' => array('placeholder' => 'Votre adresse email', 'class' => 'login-field', 'style'=>'width:95%;')
                        ));
                        ?>
                    </div>
	            <div class="control-group">
	            	<?= $this->Form->input(array(
						'type'=>'password','name'=>'password','label'=>'','addClass'=>'login-field-icon fui-lock-24','options'=>array('placeholder'=>'Votre mot de passe','class'=>'login-field', 'style'=>'width:95%;')
				    )); ?>
	            </div>
                    <input type="submit" class="btn btn-primary btn-large btn-block" value="Se connecter">
                    <div style="text-align: center" >
                        <span style="font-weight: bold;font-size: 14px;" >Site accessible uniquement aux membres.</span><br>
                        <span style="color: #9E0000;font-weight: bold;font-size: 18px;" >25 euros de consultation offert.</span><br>
                        <span style="font-weight: bold;font-size: 14px;" >Pour toute nouvelle inscription</span><br>
                        <span style="font-weight: bold;font-size: 18px;" >Inscrivez vous c'est gratuit</span><br><br>
                    </div>
      		</form>
            <a class="login-link" href="<?= Router::url('profiles/password'); ?>">Mot de passe oublié ?</a>
            Vous n'etes pas inscrit sur Esatus.fr
            <a class="login-link" href="<?= Router::url('profiles/signin'); ?>">S'inscrire</a>
      	</div>
    </div>
    
</div>