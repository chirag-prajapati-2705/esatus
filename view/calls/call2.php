<!--<script>
 
function getXMLHttpRequest() {
    var xhr = null;
    if (window.XMLHttpRequest || window.ActiveXObject) {
        if (window.ActiveXObject) {
            try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } catch(e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
        } else {
            xhr = new XMLHttpRequest();
        }
    } else {
        alert("Erreur : XMLHttpRequest non pris en charge !");
        return null;
    }
    return xhr;
}
 
function ajax(url) {
    this.xhr = getXMLHttpRequest();
    this.xhr.open('GET', url, true);
    this.xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    this.xhr.send();
}
 
function afficher() {
    var temp = new ajax('checkdb.php');
    temp.xhr.onreadystatechange = function() {
        if(temp.xhr.readyState == 4 && (temp.xhr.status == 200 || temp.xhr.status == 0)) {
            document.getElementById('resultat').innerHTML = temp.xhr.responseText;
        } else if(temp.xhr.status >= 400) {
            alert('Erreur : Affichage de la page impossible !');
        }
    }
    setTimeout("afficher();", 5000);
}
 
</script>
<body onload="afficher();">
<div id="resultat"></div>

====================================ADDED 12/10/2014===========================================================
-->
<div class="container masterhead">
	<div class="demo-headline">
  		<h1 class="demo-logo">
  			Lancement de l'appel
  			<small>
  				<?php if (!isset($result)): ?>
  				Vérifiez votre numéro de téléphone avant de lancer l'appel
  				<?php else: ?>
				<?php switch ($result->code) {
					// Tout ce passe bien
					case 200:
						echo 'Nous vous mettons en relation avec votre expert...';
					break;
					// Occupé
					case 410:
						echo 'Désolé votre expert est actuellement indisponible. Pourquoi ne pas essayer un autre expert de la même catégorie :';
					break;
					case 420:
						echo 'Désolé votre expert est actuellement indisponible. Pourquoi ne pas essayer un autre expert de la même catégorie :';
					break;
					// Pas de réponse
					case 430:
						echo 'Désolé votre expert ne répond pas. Pourquoi ne pas essayer un autre expert de la même catégorie :';
					break;
					case 440:
						echo 'Désolé votre expert ne répond pas. Pourquoi ne pas essayer un autre expert de la même catégorie :';
					break;
					// Autre erreur...
					default:
						echo 'Une erreur est survenue. Pourquoi ne pas essayer un autre expert de la même catégorie :';
					break;
				} ?>
  				<?php endif; ?>
  			</small>
  		</h1>
	</div>
</div>
<div class="container">
  <?= $this->Session->flash(); ?>
	<?php if (!isset($result)): ?>
	<!-- S'affiche si l'appel n'a pas été lancé -->
    <div class="row row-form">
      	<div class="login-form span4 offset4">
      		<form action="<?= Router::url($url); ?>" method="post">
				<?php if (!$this->Session->isLogged()): ?>
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
            	<?php else: ?>
      			<div class="control-group">
    				<?= $this->Form->input(array(
						'type'=>'text','name'=>'phone','label'=>'Votre numéro de téléphone','addClass'=>'text','options'=>array('placeholder'=>'Votre numéro de téléphone','class'=>'login-field','value'=>$me->phone)
			        )); ?>
	            </div>
            	<input type="submit" class="btn btn-primary btn-large btn-block" value="Lancer l'appel">
				<?php endif; ?>
			</form>
			<?php if (!$this->Session->isLogged()): ?>
      		<hr>
      		<a class="btn btn-info btn-large btn-block" href="<?= Router::url('profiles/signin'); ?>">Créer un compte</a>
      		<?php endif; ?>
      	</div>
    </div>
	<?php else: ?>
	<!-- S'affiche si l'appel a été lancé -->
	<?php if ($result->code == 200): ?>
	<div class="row">
      	<div class="span3 text-center service-target">
            <img class="rounded" style="margin-bottom:10px;" src="<?= IMAGE; ?>services/<?= $service->img; ?>" alt="">
            <h1 style="margin:0;"><?= ($service->username == '') ? $user->first_name.' '.$user->last_name:utf8_decode($service->username); ?></h1>
            <h6 style="color:#aaa;margin-top:0;font-size:0.85em;"><?= $service->title; ?></h6>
            <div style="margin-bottom:0.5em;">
              	<small>
	                <span class="label"><?= str_replace('.00','',$service->average); ?> / 10</span> 
	                <span class="label"><?= $service->count; ?><i class="icon-phone"></i></span>
	                <span class="label"><?= number_format($service->cost_per_minute,2); ?> €/min</span>
              	</small>
            </div>
      	</div>
      	<div class="call-status-box call-status-0 span9 text-center">
      		<h2>
      			<div class="icon-phone flash-infinite" style="font-size:3em;"></div>
      			<br/>
      			<br/>
      			Contact de l'expert en cours ...
      		</h2>
      	</div>
      	<div class="call-status-box call-status-1 span9 text-center hidden">
      		<h2>Votre expert ne semble pas répondre ?</h2>
      		<h4>Essayez un autre expert de sa catégorie :</h4>
      		<?php foreach ($services as $k=>$v): ?><?php $v = current($v); ?>
			<div class="related-service">
                <img class="rounded" style="margin-bottom:10px;" src="<?= IMAGE; ?>services/<?= $v->img; ?>" alt="" />
                <h1 style="margin:0;font-size:1.4em;"><?= ($v->username == '') ? $v->user->first_name.' '.$v->user->last_name:utf8_decode($v->username); ?></h1>
                <h6 style="color:#aaa;margin-top:0;font-size:0.85em;"><?= $v->title; ?></h6>
                <div style="margin-bottom:0.5em;">
                  	<small>
	                    <span class="label"><?= str_replace('.00','',$v->rating); ?></span> 
	                    <span class="label"><?= $v->calls; ?><i class="icon-phone"></i></span>
	                    <span class="label"><?= number_format($v->cost_per_minute,2); ?> €/min</span>
                  	</small>
                </div>
                <a class="btn btn-info" href="<?= Router::url('services/view/cat:'.$v->category.'/subcat:'.$v->subcategory.'/'.$v->url); ?>">Voir sa fiche</a>
                <a class="btn btn-primary" href="<?= Router::url('calls/call/'.$v->url); ?>">Appeler</a>
          	</div>              		
        	<?php endforeach; ?>
      	</div>
    </div>
	<?php else: ?>
	<div class="row offset1"> 
        <div class="row">
        	<?php foreach ($services as $k=>$v): ?><?php $v = current($v); ?>
			<div class="span3 text-center">
                <img class="rounded" style="margin-bottom:10px;" src="<?= IMAGE; ?>services/<?= $v->img; ?>" alt="" />
                <h1 style="margin:0;font-size:1.4em;"><?= ($v->username == '') ? $v->user->first_name.' '.$v->user->last_name:utf8_decode($v->username); ?></h1>
                <h6 style="color:#aaa;margin-top:0;font-size:0.85em;"><?= $v->title; ?></h6>
                <div style="margin-bottom:0.5em;">
                  	<small>
	                    <span class="label"><?= str_replace('.00','',$v->rating); ?></span> 
	                    <span class="label"><?= $v->calls; ?><i class="icon-phone"></i></span>
	                    <span class="label"><?= number_format($v->cost_per_minute,2); ?> €/min</span>
                  	</small>
                </div>
                <a class="btn btn-info" href="<?= Router::url('services/view/cat:'.$v->category.'/subcat:'.$v->subcategory.'/'.$v->url); ?>">Voir sa fiche</a>
                <a class="btn btn-primary" href="<?= Router::url('calls/call/'.$v->url); ?>">Appeler</a>
          	</div>              		
        	<?php endforeach; ?>
        </div>
    </div>
    <div class="row text-center">
      	<a style="display:block;margin-top:3em;" href="<?= Router::url('categories/category/slug:'.$category->slug); ?>">Voir tous les experts dans cette catégorie</a>
    </div>
	<?php endif; ?>
	<?php endif; ?>
</div>
