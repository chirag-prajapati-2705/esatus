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
	<div id="<?php echo $the_session ?>" />
	<div class="demo-headline">
  		<h1 class="demo-logo">
  			Lancement de l'appel
  			<small>
  				<?php if (!isset($result)): ?>
  				Vérifiez votre numéro de téléphone avant de lancer l'appel
  				<?php else: ?>
				<?php switch ($result) {
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

	<?php if ($result == 200): ?>
	
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
            <div style="margin-bottom:0.5em;">
              <span>
              <span id="mutevideo" muted=false><img src="<?= IMAGE; ?>camera_mute.png" style="width: 3em"></span>
              <span id="muteaudio" muted=false><img src="<?= IMAGE; ?>micro_mute.png" style="width: 3em"></span>
                <script type="text/javascript">
                  $("#mutevideo").click(function(){
                    $(this).children("img").attr("src", "<?= IMAGE; ?>"+($(this).attr('muted') == "false"?"camera_mute.png":"camera.png"));
                    $(this).attr('muted', $(this).attr('muted') == "false");
                    mutevideo();
                  });
                  $("#muteaudio").click(function(){
                    $(this).children("img").attr("src", "<?= IMAGE; ?>"+($(this).attr('muted') == "false"?"micro_mute.png":"micro.png"));
                    $(this).attr('muted', $(this).attr('muted') == 'false');
                    muteaudio();
                  });
                </script>
              </span>
              <span>
                <input type="button" id="hangupButton" class="btn tiny disabled" disabled="disabled" value="Couper l'appel vid&eacute;o">
                <script type="text/javascript">
	                $("#hangupButton").click(function(){
	                	hangup();
	                });
                </script>
              </span>
            </div>
      	</div>
      	<div class="call-status-box call-status-0 span9 text-center">
      		<h2 id="progression_chat">
      			<div class="icon-phone flash-infinite" style="font-size:3em;"></div>
      			<br/>
      			<br/>
      			<span id="call_progression_status">Initialisation du caméra et du microphone (Veuillez autorisez l'opération) ...</span>
            <br><br>
            <span id="call_payment_status"></span>
      		</h2>
          <!--added by andru-->

          <div id='videos'>
            <video id='localVideo' autoplay></video>
            <video id='remoteVideo' autoplay></video>
          </div>

          <script src='http://<?php echo $_SERVER['HTTP_HOST'] ?>:1001/socket.io/socket.io.js'></script>
          <script src='http://<?php echo $_SERVER['HTTP_HOST'] ?>:1001/js/adapter.js'></script>
          <script type="text/javascript">
            var signal_host = '<?php echo $_SERVER["HTTP_HOST"] ?>';
            var signal_port = '1001';
            var room = '<?php echo $service->profile_id ?>';
            var phonecall = false;
          </script>
          <script src='http://<?php echo $_SERVER['HTTP_HOST'] ?>:1001/js/main.js'></script>

          <script type="text/javascript">
          	function subredirect()
          	{
          		window.location.replace("<?php echo $breadcrumb_for_layout[2][url] ?>");
          	}
          	function contacted()
          	{
          		//$("#progression_chat").hide();
          		$("#remoteVideo").attr("poster", "<?= IMAGE; ?>services/<?= $service->img; ?>");
          		$("#call_progression_status").html("Contact de l'expert en cours ...");
          	}

	        function handlepayment(){
	        	$("#progression_chat").hide();
	        	$("#hangupButton").removeClass("disabled");
	        	$("#hangupButton").addClass("btn-danger");
  				  $("#hangupButton").removeAttr("disabled");

            $("#mutevideo").children("img").attr('src', '<?= IMAGE; ?>camera.png');
            $("#muteaudio").children("img").attr('src', '<?= IMAGE; ?>micro.png');

                $.ajax({
                  type : "POST",
                  url : "/calls/handlevideocallpayment",
                  data : {oldsession:"<?php echo $the_session ?>", serviceid:"<?php echo $service_id ?>", meid:"<?php echo $me_id ?>"},
                  success : function(html, status){
                    //console.log("success : " + html);
                  },
                  error : function(error_html){
                    //console.log("error : " + error_html);
                  },
                });
	        }

          global_nre = null;

          function finalize()
          {
            clearInterval(global_nre);
            window.location.replace("/noter/<?php echo $the_session ?>");
          }

          function incommunication()
          {
            alert("L'expert que vous tentez de joindre est actuellement en communication!\n reéssayez plus tard!");
          }

          function expertmissing()
          {
            alert("L'expert n'est pas connecté");
            $("#call_progression_status").html("L'expert n'est pas connecté");
          }       

	        function handlebeat(){
            global_nre = setInterval(function(){
                $.ajax({
                  type : "POST",
                  url : "/calls/handlevideocallbeat",
                  data : {oldsession:"<?php echo $the_session ?>", serviceid:"<?php echo $service_id ?>", meid:"<?php echo $me_id ?>"},
                  success : function(html, status){
                    //alert("success payment : " + html);
                    //console.log("handlebead : "+html+nre_compt);
                  },
                  error : function(error_html){
                    //alert("error payment : " + error_html);
                  },
                });
            },500);
	        }
          </script>

          <style>

          #videos
          {
            width: 100%;
            background: black;

            position: relative;
          }

          #localVideo
          {
            position: absolute;
            bottom: 0.5em;
            right: 0.5em;

            width: 12em;
          }

          #remoteVideo
          {
            min-height: 30em;
          }

          </style>
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