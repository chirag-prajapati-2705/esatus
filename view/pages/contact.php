<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">Contact<br><small>Il vous reste des questions ?</small></h1>
  </div>
</div> 
<div class="container">
  <?= $this->Session->flash(); ?>
  <div class="row">
    <div class="col-md-6">
      <h3>Esatus</h3>
      <p>29, Grand Rue <br/>59100 ROUBAIX <br/>France</p>
      <p class="lead">
        Tél : 08 99 02 33 33
        <br/>Email : <a target="_blank" href="mailto:contact@esatus.fr">contact@esatus.fr</a>
      </p>
    </div>
    <div class="col-md-6">
      <form action="<?= Router::url('pages/contact'); ?>" method="post" class="contact">
        <fieldset>
          <legend>Formulaire de contact</legend>
          <div class="form-group">
            <label for="name">Nom complet</label>
            <input type="text" class="form-control input-block" id="name" name="name" placeholder="Prénom Nom">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control input-block" name="email" id="email" placeholder="Votre email">
          </div>
          <div class="form-group">
            <label for="Message">Message</label>
            <textarea rows="8" class="form-control input-block" name="message" id="message" placeholder="Votre message"></textarea>
          </div>
           <div class="form-group">
            <label for="Code">Code de sécurité</label>
            <input type="text" class="form-control input-block" name="captcha_code" id="email" placeholder="Code de sécurité">
            <img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image"  />
            <a href="#" onclick="document.getElementById('captcha').src = '/securimage/securimage_show.php?' + Math.random(); return false">[ Autre proposition ]</a>
            <br><br>
          </div>
          <input type="submit" class="btn btn-primary btn-large btn-block">
        </fieldset>
      </form>
    </div>
  </div>
</div>