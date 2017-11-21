<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">Ma carte <br><small>Sécurisé par &nbsp;<img style="vertical-align:middle;" src="<?=IMAGE?>icones/paybox-100.jpg" alt="Paybox" /></small></h1>
  </div>
</div>
<div class="container">
  <?= $this->Session->flash(); ?>
  <div class="row row-form text-center">
    <div class="login-form">
      <form action="<?= Router::url('users/card'); ?>" method="post">
        <div class="control-group">
          <label class="text" for="numero">Numéro de carte :</label>
          <input type="text" class="login-field" placeholder="1111222233334444" name="numero" id="numero" value="<?= $card->mark; ?>">
          <?php if ($card->mark != '0000'): ?>
          <div class="alert alert-info">Pour votre sécurité ce champ est scyndé en deux parties et crypté.</div>
          <?php endif; ?>
        </div>
        <div class="control-group">
          <label class="text" for="">Date de fin de validité :</label>
          <select class="login-field" name="month"> 
            <?php foreach ($months as $key => $value): ?>
            <option value="<?= $key; ?>"<?php if ($key == $m): ?> selected="selected"<?php endif; ?>><?= $key; ?></option> 
            <?php endforeach; ?>
          </select> 
          <select class="login-field" name="year"> 
            <?php foreach ($years as $year): ?>
            <option value="<?= $year; ?>"<?php if ($year == '20'.$y): ?> selected="selected"<?php endif; ?>><?= $year; ?></option> 
            <?php endforeach; ?>
          </select>
        </div>
        <div class="control-group">
          <label class="text" for="crypto">Cryptogramme visuel :</label>
          <input type="text" class="login-field" placeholder="123" name="crypto" id="crypto" value="<?= $card->cryptogram; ?>">
        </div>
        <input type="submit" class="btn btn-primary btn-large btn-block" value="Valider">
      </form>
      <a class="login-link" href="<?= Router::url('pages/contact'); ?>">Pas de carte bleue ?</a>
    </div>
  </div>
</div>