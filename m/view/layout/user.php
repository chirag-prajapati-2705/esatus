<?php 
if(!isset($description_for_layout)) $description_for_layout = '';
if(!isset($classification_for_layout)) $classification_for_layout = '';
if(!isset($keywords_for_layout)) $keywords_for_layout = '';
if(!isset($country_for_layout)) $country_for_layout = '';
?>

<?= $this->HTML->docType(); ?>
<html lang="fr" itemscope="itemscope" itemtype="http://schema.org/WebPage">
	<head>
		<?= $this->HTML->charset('utf-8'); ?>
		<?= $this->HTML->title($title_for_layout); ?>
		<?= $this->HTML->metas(array(
			'description'=>$description_for_layout,
			'viewport'=>'initial-scale=1.0'
		)); ?>
		<?= $this->HTML->css('bootstrap'); ?>
		<?= $this->HTML->css('bootstrap-responsive'); ?>
		<?= $this->HTML->css('jasny-bootstrap.min'); ?>
		<?= $this->HTML->css('flat-ui'); ?>
		<?= $this->HTML->css('esatus-main'); ?>
		
		<?= $this->HTML->favicon(); ?>
		<?= $this->HTML->author(); ?>

		<?= $this->HTML->js('jquery'); ?>
		<?= $this->HTML->js('bootstrap.min'); ?>
		<?= $this->HTML->js('jasny-bootstrap.min'); ?>
		<?= $this->HTML->js('application'); ?>
		<script type="text/javascript" src="//try.abtasty.com/057533c5a4ef341b239034eeb6332071.js"></script> 
		<!--[if lt IE 9]><?= $this->HTML->js('html5'); ?></script><![endif]-->
            <link rel="canonical" href="https://esatus.fr<?php echo $_SERVER['REQUEST_URI'] ?>" />
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
	</head>
	<body itemprop="mainContentOfPage" role="main" class="user">
		<!-- header -->
		<header>

			<!-- Mobile off-canvas left navigation -->
	    	<nav id="navmenu-navigation" class="navmenu navmenu-default navmenu-fixed-left offcanvas" role="navigation">
			  <a class="navmenu-brand" href="#">Navigation</a>
			  <ul class="nav navmenu-nav">
			    <li><a href="#">Accueil</a></li>
				<?php foreach ($this->requestAction(array('controller'=>'categories','action'=>'getCategories')) as $k=>$v): ?><?php $v = current($v); ?>
				<li>
	          		<a href="<?= Router::url('categories/category/slug:'.$v->slug); ?>"><?= $v->title; ?></a>
	        	</li>
				<?php endforeach; ?>
			  </ul>
			  <a class="navmenu-brand" href="#">Besoin d'aide ?</a>
			  <ul class="nav navmenu-nav">
			  	<li><a href="<?= Router::url('pages/customersfaq'); ?>">FAQ clients</a></li>
				<li><a href="<?= Router::url('pages/expertsfaq'); ?>">FAQ experts</a></li>
				<li><a href="<?= Router::url('pages/contact'); ?>">Contact</a></li>
			  </ul>
			</nav>

			<!-- Mobile off-canvas right navigation -->
			<nav id="navmenu-user" class="navmenu navmenu-default navmenu-fixed-right offcanvas" role="navigation">
			  <!-- <a class="navmenu-brand" href="#">Navigation</a> -->
			  <ul class="nav navmenu-nav">
			    <?php if (!$this->Session->isLogged()): ?>
				<li><a href="<?= Router::url('profiles/signin'); ?>">Créer un compte</a></li>
	            <li><a href="<?= Router::url('profiles/login'); ?>">Vous connecter</a></li>
	           	<?php else: ?>
	            <?php if ($this->requestAction(array('controller'=>'users','action'=>'test'))): ?>
	        	<li><a href="<?= Router::url('users/index'); ?>">Espace client</a></li>
	        	<li><a href="<?= Router::url('users/datas'); ?>">Vos informations</a></li>
	        	<li><a href="<?= Router::url('users/calls'); ?>">Vos appels</a></li>
	        	<li><a href="<?= Router::url('users/card'); ?>">Votre carte bancaire</a></li>
	        	<li><a href="<?= Router::url('services/index'); ?>">Espace expert</a></li>
	        	<?php endif; ?>
	        	<li><a href="<?= Router::url('profiles/logout'); ?>">Me déconnecter</a></li>
				<?php endif; ?>
			  </ul>
			</nav>

			<!-- Mobile navbar -->
			<div class="navbar navbar-inverse navbar-fixed-top hidden-desktop">
	        	<div class="navbar-inner">
	          		<div class="container text-center">
	          			<button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target="#navmenu-navigation" data-canvas="body">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="brand-mobile" href="<?= Router::url('pages/index'); ?>">
	    					<img class="nav-logo-mobile" src="<?= IMAGE; ?>esatus-logo-mini.png" alt="Esatus">
	    				</a>
	    				<button type="button" class="navbar-toggle navbar-toggle-right" data-toggle="offcanvas" data-target="#navmenu-user" data-canvas="body">
							<span class="fui-settings-24"></span>
						</button>
	          		</div>
	          	</div>
	        </div>

	        <!-- Desktop navigation -->
	     	<div class="navbar navbar-inverse navbar-fixed-top visible-desktop">
	        	<div class="navbar-inner">
	          		<div class="container">
	            		<div class="nav-collapse collapse">
	            			<!-- Menu -->
	              			<ul class="nav">
	              				<li>
	              					<a href="<?= Router::url('pages/index'); ?>">
	                					<img class="nav-logo" src="<?= IMAGE; ?>esatus-logo-mini.png" alt="Esatus">
	                				</a>
	              				</li>
	              				<li>
	              					<a href="<?= Router::url('users/index'); ?>">Espace client <i class="icon-angle-down"></i></a>
	              					<ul>
	              						<li><a href="<?= Router::url('users/index'); ?>">Tableau de bord</a></li>
	              						<li><a href="<?= Router::url('users/datas'); ?>">Vos informations</a></li>
	              						<li><a href="<?= Router::url('users/calls'); ?>">Vos appels</a></li>
	              						<li><a href="<?= Router::url('users/card'); ?>">Votre carte bancaire</a></li>
                                                                
	              					</ul>
	              				</li>
	                			<li>
	                				<?php $s = $this->requestAction(array('controller'=>'services','action'=>'test')); if ($s): ?>
	                				<a href="<?= Router::url('services/index'); ?>">Espace expert <i class="icon-angle-down"></i></a>
	              					<ul>
	              						<li><a href="<?= Router::url('services/index'); ?>">Vos services :</a></li>
	              						<?php foreach ($s as $k=>$v): ?><?php $v = current($v); $i = $k+1; ?>
	              						<li>
	              							<a href="<?= Router::url('services/service/id:'.$v->id); ?>"><?= $i.' - '.$v->title; ?> <i class="icon-angle-right"></i></a>
	              							<ul>
	              								<li><a href="<?= Router::url('services/edit/id:'.$v->id); ?>">Fiche de service</i></a></li>
	              								<li><a href="<?= Router::url('services/availabilities/id:'.$v->id); ?>">Vos disponibilités</a></li>
	              								<li><a href="<?= Router::url('services/calls/id:'.$v->id); ?>">Vos appels reçus</a></li>
	              								<li><a href="<?= Router::url('services/repayments/id:'.$v->id); ?>">Vos gains</a></li>
	              								<li><a href="<?= Router::url('services/bdi/id:'.$v->id); ?>">Votre IBAN</a></li>
                                                                                <li><a href="<?= Router::url('services/clients/id/'.$v->id); ?>">Vos clients</a></li>
	              							</ul>
	              						</li>
	              						<?php endforeach ?>
	              						<?php if($i < 3) : ?>
	              						<li><a href="<?= Router::url('services/create'); ?>"><i class="icon-plus"></i> Créer un nouveau service</a></li>
	              						<?php endif; ?>
	              					</ul>
	                				<?php else: ?>
	                				<a href="<?= Router::url('services/create'); ?>">Devenir expert ?</a>
	                				<?php endif; ?>
	                			</li>
                                                
	              			</ul>
	              			<!-- Actions -->
	              			<ul class="nav pull-right" style="margin-left: 40px;">		
	                			<li>
				                  	<a href="<?= Router::url('users/index'); ?>"><span class="fui-settings-24"></span> <i class="icon-angle-down"></i></a>
				                  	<ul>
				                    	<li><a href="<?= Router::url('pages/index'); ?>">Retour au site</a></li>
				                    	<li><a href="<?= Router::url('profiles/logout'); ?>">Me déconnecter</a></li>
				                  	</ul>
				                </li>
	              			</ul>
	            		</div>
	          		</div>
	        	</div>
	      	</div>
	    </header>

	    <section>
	    	<?php if (isset($breadcrumb_for_layout)) echo breadcrumb($breadcrumb_for_layout); ?>
	    	<?= $content_for_layout; ?>
	    </section>

	    <footer class="mobile-full-width">
			<div class="container">
        		<div class="row">
          			<div class="span7 footer-resume">
						<h3 class="footer-title">Esatus " Pour en savoir plus "</h3>
						<p>Le temps vous manque, Esatus facilitera votre quotidien, en faisant appel à des professionnels plébiscités par nos clients et sélectionnés par notre service Qualité. Diététicienne, Avocat, Coach, Fiscaliste, Astrologue et bien d’autres activités répondent à vos questions au meilleur prix en toute discrétion 24H/24 7 jours sur 7 !</p>
						<p>Consultez nos professionnels, de chez vous ou en mode Nomade, Esatus est LA solution qui vous permet de gagner du temps et révolutionne votre quotidien.</p>
						<p>Esatus c’est un gain de temps pour les uns... un gain de revenus complémentaires pour les autres, <a href="<?= Router::url('profiles/signin'); ?>">rejoignez-nous !</a></p>
      				</div>
          			<div class="span5">
            			<div class="footer-banner">
              				<h3 class="footer-title">A propos</h3>
			              	<ul>
				                <li>Site édité par la SARL 4U Consulting</li>
				                <li>29, Grand Rue 59100 ROUBAIX</li>
				                <li>SIREN : 523 411 866</li>
				                <li>TVA intracommunautaire : <br/>FR75 523 411 866</li>
				                <li>Service client : 08 99 70 35 27</li>
                                                <li>Numéro surtaxé à 1,35 € TTC par appel + 0,34 € la minute</li>
			              	</ul>
              				<a href="<?= Router::url('pages/imprint'); ?>">Mentions légales</a> - 
              				<a href="<?= Router::url('pages/termsofuse'); ?>">CGU</a>
              				<br/>
              				<br/>
              				<a href="http://www.orange.fr"  target="_blank"><img src="<?= IMAGE; ?>label-orange-qualite.png" alt="Qualité certifiée par Orange" /></a>
              				<a href="http://www.paybox.com" target="_blank"><img src="<?= IMAGE; ?>label-paybox-securise.png" alt="Paiments sécurisés par Paybox" /></a>
            			</div>
          			</div>
        		</div>
      		</div>
		</footer>	
		<div id="back-to-top" class="alert alert-info">
		  	<i class="icon-arrow-up"></i>
		</div>
                <script type="text/javascript">
var __lc = {};
__lc.license = 6363171;

(function() {
 var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
 lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
 var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
})();
</script>
		<?= $this->HTML->js('jquery'); ?>
		<?= $this->HTML->js('bootstrap.min'); ?>
		<?php if (isset($scripts)): ?><?= $this->HTML->scripts_for_layout($scripts); ?><?php endif; ?>
	</body>
</html>