<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">Ma RIB <br><small>S&eacute;curis&eacute; par &nbsp;<img style="vertical-align:middle;" src="<?= IMAGE ?>icones/Credit-Agricole-32.jpg" alt="Paybox" /></small></h1>
  </div>
</div>
<div class="container">
  <?= $this->Session->flash(); ?>
  <div class="row row-form">
    <div class="login-form span4 offset4">
      <form action="<?= Router::url('users/rib'); ?>" method="post">
        <div class="control-group">
          <label class="text" for="numero">Nom de la banque :</label>
          <input type="text" class="login-field" placeholder="Soci&eacute;t&eacute; g&eacute;n&eacute;rale" name="banque" id="banque" value="<?= $rib->banque; ?>">
          
        </div>
        <div class="control-group">
          <label class="text" for="iban">IBAN :</label>
          <input type="text" class="login-field" placeholder="FR00 0000 0000 0000 0000 0000 000" name="iban" id="iban" value="<?=  $rib->iban ?>">
        </div>
        <div class="control-group">
          <label class="text" for="rib">BIC :</label>
          <input type="text" class="login-field" placeholder="FR00 0000 0000 0000 0000 0000 000" name="bic" id="bic" value="<?=  $rib->bic ?>">
        </div>
        <div class="control-group">
          <label class="text" for="">Date de pr&Eacute;l&egrave;vement souhait&eacute; :</label>
          <select class="login-field" name="prelevement"> 
            <?php foreach ($days as $key): ?>
            <option value="<?= $key; ?>"<?php if ($key == $pr): ?> selected="selected"<?php endif; ?>><?= $key; ?></option> 
            <?php endforeach; ?>
          </select> 
        </div>
        <!--<div class="control-group">
          <label class="text" for="crypto">Cryptogramme visuel :</label>
          <input type="text" class="login-field" placeholder="123" name="crypto" id="crypto" value="<?= $card->cryptogram; ?>">
        </div>-->
        <input type="submit" class="btn btn-primary btn-large btn-block" value="Valider">
      </form>
      <a class="login-link" href="<?= Router::url('pages/contact'); ?>">Pas de RIB?</a>
    </div>
  </div>
</div>
