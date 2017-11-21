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
		<?= $this->HTML->css('flat-ui'); ?>
		<?= $this->HTML->favicon(); ?>
		<?= $this->HTML->author(); ?>
		<!--[if lt IE 9]><?= $this->HTML->js('html5'); ?><![endif]-->
	</head>
	<body itemprop="mainContentOfPage" role="main" class="superadmin">
		<header>
      		<div class="navbar navbar-inverse navbar-fixed-top">
        		<div class="navbar-inner">
          			<div class="container">
            			<div class="nav-collapse collapse">
              				<ul class="nav">
               					<li>
                  					<a href="<?= Router::url('admin/admins/index'); ?>">
                    					<img class="nav-logo" src="<?= IMAGE; ?>esatus-logo-mini.png" alt="Esatus">
                  					</a>
                				</li>
                				<li>
                  					<a href="<?= Router::url('admin/admins/index'); ?>">Super admin menu <i class="icon-angle-down"></i></a>
                  					<ul>
                    					<li>
                      						<a href="<?= Router::url('admin/admins/index'); ?>">Tableau de bord</a>
					                    </li>
					                    <li>
					                      	<a href="<?= Router::url('admin/admins/users'); ?>">Clients</a>
					                    </li>
                    					<li>
                      						<a href="<?= Router::url('admin/admins/services'); ?>">Experts</a>
                    					</li>
					                    <li>
					                      	<a href="<?= Router::url('admin/admins/repayments'); ?>">Virements</a>
					                    </li>
					                    <li>
					                      	<a href="<?= Router::url('admin/admins/calls'); ?>">Appels</a>
					                    </li>
					                    <li>
					                      	<a href="<?= Router::url('admin/admins/unpaids'); ?>">Impayés</a>
					                    </li>
					                    <li>
					                      	<a href="<?= Router::url('admin/admins/categories'); ?>">Catégories</a>
					                    </li>
                                                            <li>
					                      	<a href="<?= Router::url('admin/admins/inscris'); ?>">Inscription</a>
					                    </li>
                                                            <li>
					                      	<a href="<?= Router::url('admin/admins/promo'); ?>">Promotions</a>
					                    </li>
                  					</ul>
                				</li>
              				</ul>
			              	<ul class="nav pull-right" style="margin-left: 40px;">
			                	<li>
			                		<a href="<?= Router::url('admins/logout'); ?>">Retour sur Esatus.fr</a>
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
		<footer>
	    	<div class="container">
        		<div class="row">

        		</div>
      		</div>
    	</footer>
		<?= $this->HTML->js('jquery'); ?>
		<?php if (isset($scripts)): ?><?= $this->HTML->scripts_for_layout($scripts); ?><?php endif; ?>
	</body>
</html>