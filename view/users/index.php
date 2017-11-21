<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.js"></script>
<style type="text/css">
body {
font-family:verdana;
font-size:15px;

}
a {color:#333; text-decoration:none}
a:hover {color:#ccc; text-decoration:none}

.tile-title {
  font-size: 16px;
}

#mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background-color:#000;
  display:none;
}  
#boxes .window {
  position:absolute;
  left:0;
  top:0;
  width:440px;
  height:200px;
  display:none;
  z-index:9999;
  padding:20px;
}
#position_form {
margin-top:365px;
margin-right:245px;
margin-left:58px;
width:299px; 
}

#position_img {
margin-top:-15px;
margin-right:-764px;
 
}

#boxes #dialog {
margin-left:-67px;
margin-top:155px;
background-image:url(http://esatus.fr/bin/images/bgpp.png); 
background-size: 1068px  686px;
    background-repeat: no-repeat;
  width:999px; 
  height:944px;
  padding:10px;
  margin-bottom:2px;
  
  
  /*arrondir les coins en haut � gauche et en bas � droite*/
-moz-border-radius:10px 0;
-webkit-border-radius:10px 0;
border-radius:10px;
}

.center {
  margin: 0 auto;
  max-width: 300px;
  width: 100%;
  float: none;
}

.container {
  width: 1000px;
}

.row {
  margin-left: 0px;
}

</style>
<!-- Google Code for Cr&eacute;ation de compte Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 991320576;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "PchyCJ-Iw1YQgLTZ2AM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/991320576/?label=PchyCJ-Iw1YQgLTZ2AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<iframe src="https://secure.img-cdn.mediaplex.com/0/27977/universal.html?page_name=mct-esatus-lead-secure&Lead=1&mpuid=<?= $user->profile_id; ?>" HEIGHT=1 WIDTH=1 FRAMEBORDER=0></iframe>
<div class="container masterhead">
	<div class="demo-headline">
            <h1 class="demo-logo">Bienvenue <?= $user->pseudo; ?>,<br><small>Voici votre espace privé. Quelle page voulez-vous consulter   ?</small></h1>
	</div>
</div>
<div class="container">

    <div class="alert alert-info text-center flash"><h5>Pour appeler nos experts Esatus dans les meilleures conditions,<br/>merci de tenir à jour vos informations personnelles et vérifier la validité de votre carte bancaire.</h5></div>
    <div class="row demo-tiles">
      	<div class="span3">
            <a href="<?= Router::url('users/datas'); ?>">
              	<div class="tile">
                	<i class="icon-user"></i>
                	<h3 class="tile-title">Vos informations</h3>
              	</div>
            </a>
      	</div>
      	<div class="span3">
            <a href="<?= Router::url('users/calls'); ?>">
              	<div class="tile">
	                <i class="icon-phone"></i>
	                <h3 class="tile-title">Vos appels</h3>
              	</div>
            </a>
      	</div>
        <!--modified by andru-->
        <?php if(!isset($card)) : ?>
        <div class="span3" <?php if(isset($rib)): ?>style="display:none"<?php endif; ?>>
            <a href="<?= Router::url('users/card'); ?>">
                <div class="tile">
                  <i class="icon-lock"></i>
                  <h3 class="tile-title">Votre carte bancaire</h3>
                </div>
            </a>
        </div>
        <div class="span3" <?php if(!isset($rib)): ?>style="display:none"<?php endif; ?>>
            <a href="<?= Router::url('users/rib'); ?>">
                <div class="tile">
                  <i class="icon-lock"></i>
                  <h3 class="tile-title">Votre rib</h3>
                </div>
            </a>
        </div>
        <?php endif; ?>
        <?php if(isset($card)) : ?>
        <div class="span3">
            <a href="<?= Router::url('users/card'); ?>">
                <div class="tile">
                  <i class="icon-lock"></i>
                  <h3 class="tile-title">Votre carte bancaire</h3>
                </div>
            </a>
        </div>
        <div class="span3" <?php if(!isset($rib)): ?>style="display:none"<?php endif; ?>>
            <a href="<?= Router::url('users/rib'); ?>">
                <div class="tile">
                  <i class="icon-lock"></i>
                  <h3 class="tile-title">Votre rib</h3>
                </div>
            </a>
        </div>
        <?php endif; ?>
        <!-- end modificatio by andru -->
        <div class="span3">
            <?php if ($this->requestAction(array('controller'=>'services','action'=>'test'))): ?>
            <a href="<?= Router::url('services/index'); ?>">
                <div class="tile">
                  <i class="icon-group"></i>
                  <h3 class="tile-title">Espace expert</h3>
                </div>
            </a>
            <?php else: ?>
            <a href="<?= Router::url('services/create'); ?>">
              	<div class="tile">
                	<i class="icon-group"></i>
                	<h3 class="tile-title">Devenir expert !</h3>
              	</div>
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>