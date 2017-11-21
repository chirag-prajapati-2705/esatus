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
			'description'	 => $description_for_layout,
			'classification' => $classification_for_layout,
			'keywords'		 => $keywords_for_layout,
			'country'		 => $country_for_layout,
			'viewport'		 =>'initial-scale=1.0'
		)); ?>
		<meta name="google-site-verification" content="M2zlrDkRnQ8LJHBT5nKa8n2P5AB8cPmMZclSUKS1_9Y">
		<link rel="canonical" href="https://esatus.fr<?php echo $_SERVER['REQUEST_URI'] ?>" />
		<?= $this->HTML->css('bootstrap'); ?>
		<?= $this->HTML->css('bootstrap-responsive'); ?>
		<?= $this->HTML->css('jasny-bootstrap.min'); ?>
		<?= $this->HTML->css('flat-ui'); ?>
        <?= $this->HTML->css('slide'); ?>
		<?= $this->HTML->css('ss-symbolicons-line'); ?>
		<?= $this->HTML->css('esatus-main'); ?>

		<?= $this->HTML->favicon(); ?>
		<?= $this->HTML->author(); ?>
		
		<?= $this->HTML->js('jquery'); ?>
		<?= $this->HTML->js('bootstrap.min'); ?>
		<?= $this->HTML->js('bootstrap-switch'); ?>
		<?= $this->HTML->js('jasny-bootstrap.min'); ?>
		<?= $this->HTML->js('application'); ?>
		<?= $this->HTML->js('slide'); ?>
		<?= $this->HTML->js('jquery.cycle2.min'); ?>
                <?= $this->HTML->js('tracking'); ?>
        <?= $this->HTML->js('jquery.cycle2.shuffle'); ?>
        <?= $this->HTML->js('jquery.scrollbox'); ?>
                <script type="text/javascript" src="//try.abtasty.com/057533c5a4ef341b239034eeb6332071.js"></script> 
		<?php if (isset($scripts)): ?><?= $this->HTML->scripts_for_layout($scripts); ?><?php endif; ?>
		<!--[if lt IE 9]><?= $this->HTML->js('html5'); ?><![endif]-->
        <script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			ga('create', 'UA-44456186-1', 'esatus.fr');
			ga('send', 'pageview');
        </script>

    	<meta name="google-site-verification" content="w6c2-E1VOaLAMOAmE8GOZE-Yb9S5rk1ipiBXazlH49w" />
        <meta name="verification" content="4c966270e08d01c26ff0d4ca36fe0e29" />      
        <?php
            include ('../bin/js/adwords.js.php');
        ?> 
	</head>

	<body itemprop="mainContentOfPage" role="main" class="<?php if(isset($body_classes_for_layout)) echo $body_classes_for_layout; ?> new">	
		<!-- header -->	
			
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
        	<li><a href="<?= Router::url('users/index'); ?>">Espace client</a></li>
        	<li><a href="<?= Router::url('users/datas'); ?>">Vos informations</a></li>
        	<li><a href="<?= Router::url('users/calls'); ?>">Vos appels</a></li>
        	<li><a href="<?= Router::url('users/card'); ?>">Votre carte bancaire</a></li>
        	<li><a href="<?= Router::url('services/index'); ?>">Espace expert</a></li>
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

					<a class="brand" href="<?= Router::url('pages/index'); ?>">
    					<img class="nav-logo" src="<?= IMAGE; ?>esatus-logo-mini.png" alt="Esatus">
    				</a>

            		<div class="nav-collapse collapse">
            			<!-- Menu -->
              			<ul class="nav">
                			<li>
                				<a href="<?= Router::url('categories/index'); ?>">Nos experts <i class="icon-angle-down"></i></a>
                  				<ul>
                  					<?php foreach ($this->requestAction(array('controller'=>'categories','action'=>'getCategories')) as $k=>$v): ?><?php $v = current($v); ?>
                  					<li>
				                      	<a href="<?= Router::url('categories/category/slug:'.$v->slug); ?>"><?= $v->title; ?></a>
                                                        <ul>
                                                                <?php foreach ($v->subcategories as $sk => $sv): ?><?php $sv = current($sv); ?>
                                                                    <?php
                                                                    $services = $this->Service->findBy(array('conditions' => array('category_id' => $v->id, 'subcategory_id' => $sv->id, 'validated' => 1)));
                                                                    if (count($services) > 0):
                                                                        ?>
                                                                        <li><a href="<?= Router::url('categories/subcategory/cat:' . $v->slug . '/subcat:' . $sv->slug); ?>"><?= $sv->title; ?></a></li>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            </ul>
				                    </li>
                  					<?php endforeach; ?>
                  				</ul>
                			</li>
                            <?php if (!$this->Session->isLogged()): ?>
                            <li>
			             		<a href="<?= Router::url('profiles/signin'); ?>">Espace client <i class="icon-angle-down"></i></a>
			             		<ul>
			             			<li><a href="<?= Router::url('profiles/signin'); ?>">Créer un compte</a></li>
			                        <li><a href="<?= Router::url('profiles/login'); ?>">Vous connecter</a></li>
			             		</ul>
			             	</li>
                            <?php else: ?>
                			<li>
			                  	<a href="<?= Router::url('users/index'); ?>"><span class="fui-settings-24"></span> <i class="icon-angle-down"></i></a>
			                  	<ul>
                                    <?php if ($this->requestAction(array('controller'=>'users','action'=>'test'))): ?>
			                    	<li><a href="<?= Router::url('users/index'); ?>">Espace client</a></li>
			                    	<li><a href="<?= Router::url('users/datas'); ?>">Vos informations</a></li>
			                    	<li><a href="<?= Router::url('users/calls'); ?>">Vos appels</a></li>
			                    	<li><a href="<?= Router::url('users/card'); ?>">Votre carte bancaire</a></li>
			                    	<li><a href="<?= Router::url('services/index'); ?>">Espace expert</a></li>
			                    	<?php endif; ?>
			                    	<li><a href="<?= Router::url('profiles/logout'); ?>">Me déconnecter</a></li>
			                  	</ul>
			                </li>
			                
                			<?php endif; ?>
			             	<li>
			             		<a href="<?= Router::url('pages/customersfaq'); ?>">Aide <i class="icon-angle-down"></i></a>
			             		<ul>
			             			<li><a href="<?= Router::url('pages/customersfaq'); ?>">FAQ clients</a></li>
			             			<li><a href="<?= Router::url('pages/expertsfaq'); ?>">FAQ experts</a></li>
			             		</ul>
			             	</li>
                                            
                			<li><a href="<?= Router::url('pages/contact'); ?>">Contact</a></li>
              			</ul>
              			
              			<!-- Connexion / Utilisateur -->
              			<ul class="nav pull-right">
                			<form class="navbar-form" action="<?= Router::url('pages/search'); ?>" method="post">
                  				<div class="control-group">
	                    			<input type="text" class="top-input" value="" id="search" name="search">
	                    			<img src="<?= IMAGE; ?>icones/recherche.png" alt="">
                  				</div>
                			</form>
              			</ul>
            		</div>
          		</div>
        	</div>
      	</div>
	    
	    <section>
	    	<?php if (isset($breadcrumb_for_layout)) echo breadcrumb($breadcrumb_for_layout); ?>
	    	<?= $content_for_layout; ?>
	    </section>

		<footer class="mobile-full-width">
			<?php 
    			$this->loadModel('Rating');
    			$reviews = $this->Rating->findBy(array('order'=>'id DESC'));
    			foreach ($reviews as $k=>$v) {
    				$this->loadModel('User');
	    			$this->loadModel('Service');
	    			$this->loadModel('Category');
	    			$this->loadModel('Subcategory');
	    			$v->Rating->user = current($this->User->findOneBy(array('conditions'=>array('profile_id'=>$v->Rating->profile_id))));
	    			$v->Rating->service = current($this->Service->findOneBy(array('conditions'=>array('id'=>$v->Rating->service_id))));
	    			$v->Rating->expert = current($this->User->findOneBy(array('conditions'=>array('profile_id'=>$v->Rating->service->profile_id))));
	    			$v->Rating->username = ($v->Rating->service->username == '') ? $v->Rating->expert->last_name.'-'.$v->Rating->expert->first_name:$v->Rating->service->username;
	    			$v->Rating->category = current($this->Category->findOneBy(array('conditions'=>array('id'=>$v->Rating->service->category_id))));
            		$v->Rating->subcategory = current($this->Subcategory->findOneBy(array('conditions'=>array('id'=>$v->Rating->service->subcategory_id))));
    			} 
    		?>
    		<?php if (isset($reviews) && $reviews): ?>
			<div id="last_reviews">
		    	<div class="container">
			    	<div class="row">
			    		<div class="cycle-slideshow"
				    		data-cycle-fx="scrollHorz"
						    data-cycle-pause-on-hover="true"
						    data-cycle-speed="400"
						    data-cycle-slides="> div"
						    data-cycle-pager="#last_reviews_pager"
						    data-cycle-auto-height="container"
							>
							<?php 
							$i = 0;
							foreach ($reviews as $k=>$v):
								if($i > 10) continue;
								$v = current($v);
							?>
						    	<div class="review text-center">				    		
									Par <?= $v->user->first_name; ?> 
									au sujet de <a href="<?= Router::url('services/view/cat:'.$v->category->slug.'/subcat:'.$v->subcategory->slug.'/slug:'.clean($v->username).'/id:'.$v->service->id); ?>"><?= $v->username; ?>, <?= $v->service->title; ?></a> 
									| note : <span class="label label_default review_rating"><?= $v->rate; ?>/10</span>
									<blockquote class="lead">" <?= $v->comment; ?> "</blockquote>
						    	</div>
					    	<?php
					    	$i++;
					    	endforeach;
					    	?>
					    </div>
    					<div id="last_reviews_pager" class="cycle-pager"></div>
					</div>
				</div>
		    </div>
		    <?php endif; ?>
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
	</body>
</html>