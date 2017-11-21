<div class="container masterhead">
	<div class="demo-headline">
		<h1 class="demo-logo">Vos informations<br><small>Saisissez vos informations personnelles ici.</small></h1>
	</div>
</div>
<div class="container">
    <div class="row row-form">
      	<div class="login-form span4">
      		<form action="<?= Router::url('users/create'); ?>" method="post">
      			<div class="control-group">
	              	<?= $this->Form->input(array(
						'type'=>'text','name'=>'last_name','label'=>'Nom','addClass'=>'text','options'=>array('placeholder'=>'Votre nom','class'=>'login-field')
			        )); ?>
	            </div>
	            <div class="control-group">
	              	<?= $this->Form->input(array(
						'type'=>'text','name'=>'first_name','label'=>'Prénom','addClass'=>'text','options'=>array('placeholder'=>'Votre prénom','class'=>'login-field')
			        )); ?>
	            </div>
	            <div class="control-group">
	              	<label class="text" for="year">Année de naissance</label>
	              	<select class="login-field" name="year"> 
						<?php foreach ($years as $year): ?>
					   	<option value="<?= $year; ?>"><?= $year; ?></option> 
					   	<?php endforeach; ?>
					</select>
	            </div>
	            <div class="control-group">
	              	<label class="text" for="month">Mois de naissance</label>
	              	<select class="login-field" name="month"> 
						<?php foreach ($months as $key => $value): ?>
					   	<option value="<?= $key; ?>"><?= $value; ?></option> 
					   	<?php endforeach; ?>
					</select> 
	            </div>
	            <div class="control-group">
	              	<label class="text" for="day">Jour de naissance</label>
	              	<select class="login-field" name="day"> 
						<?php foreach ($days as $day): ?>
					   	<option value="<?= ($day < 10) ? '0'.$day:$day; ?>"><?= ($day < 10) ? '0'.$day:$day; ?></option> 
					   	<?php endforeach; ?>
					</select>
	            </div>
	            <div class="control-group">
	              	<?= $this->Form->input(array(
						'type'=>'text','name'=>'phone','label'=>'Numéro','addClass'=>'text','options'=>array('placeholder'=>'0123456789','class'=>'login-field')
			        )); ?>
	            </div>
	            <div class="control-group">
              		<input type="checkbox" name="cgu">
              		<p class="check">J'ai lu et j'accepte les <a href="<?= Router::url('pages/termsofuse'); ?>">conditions générales d'utilisation</a>.</p><br>
              		<?php if (isset($check)): ?><div class="alert alert-info"><?= $check; ?></div><?php endif; ?>
            	</div>
	            <input type="submit" class="btn btn-primary btn-large btn-block" value="Valider">
      		</form>  
      	</div>
        <spsn class="span7">
            <p>Encore quelques clics et vous aurez accès aux meilleurs experts de France 24/24 et 7j/7</p>
            <p><img style="vertical-align:middle;" src="<?= IMAGE ?>Fotolia_48571549_XS.gif" alt="Paybox" /></p>
        </spsn>
    </div>
</div>
