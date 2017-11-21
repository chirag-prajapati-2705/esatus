<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">Mot de passe oublié ?<br><small>Indiquez votre nouveau mot de passe.</small></h1>
  </div>
</div>
<div class="container">
  <?= $this->Session->flash(); ?>
  <div class="row row-form">
    <div class="login-form span4 offset4">
      <form action="<?= $_SERVER['SCRIPT_URI']; ?>" method="post">
        <div class="control-group">
          <?= $this->Form->input(array(
            'type'=>'text','name'=>'password','label'=>'','addClass'=>'login-field-icon fui-lock-24','options'=>array('placeholder'=>'Votre nouveau mot de passe','class'=>'login-field')
          )); ?>
        </div>
        <input type="submit" class="btn btn-primary btn-large btn-block" value="Réinitialiser votre mot de passe">
      </form>
    </div>
  </div>
</div>