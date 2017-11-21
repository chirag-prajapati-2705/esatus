<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">Mot de passe oublié ?<br><small>Pas de panique. Indiquez nous juste votre adresse email.</small></h1>
  </div>
</div>
<div class="container">
  <?= $this->Session->flash(); ?>
  <div class="row row-form">
    <div class="login-form span4 offset4">
      <form action="<?= Router::url('profiles/password'); ?>" method="post">
        <div class="control-group">
          <?= $this->Form->input(array(
            'type'=>'text','name'=>'email','label'=>'','addClass'=>'login-field-icon fui-mail-24','options'=>array('placeholder'=>'Votre adresse email','class'=>'login-field')
          )); ?>
        </div>
        <input type="submit" class="btn btn-primary btn-large btn-block" value="Réinitialiser votre mot de passe">
      </form>
    </div>
  </div>
</div>