<?= $this->HTML->docType(); ?>
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<?php 
include('../controller/Status.php'); 
include ('../ajax_status.js');
?>
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

		<?= $this->HTML->js('jquery'); ?>
                <?= $this->HTML->js('tracking'); ?>
                <script type="text/javascript" src="//try.abtasty.com/057533c5a4ef341b239034eeb6332071.js"></script> 
                <script language="javascript" type="text/javascript">
                                                            function changeColor(col)
                                                            {
                                                                var couleur = col;
                                                                if (couleur == "En ligne")
                                                                    document.getElementById("epn").style.backgroundColor = "#88c51f";
                                                                else if (couleur == "Indisponible")
                                                                    document.getElementById("epn").style.backgroundColor = "#95a5a6";
                        else
                            document.getElementById("epn").style.backgroundColor = "#e74c3c";
                    }

                </script>
                
		<!--[if lt IE 9]><?= $this->HTML->js('html5'); ?></script><![endif]-->

	</head>
	<body itemprop="mainContentOfPage" role="main" class="user">
		<!-- header -->
		<header>
	     	<div class="navbar navbar-inverse navbar-fixed-top">
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
                                                    <li><a href="<?= Router::url('users/questions'); ?>">Vos questions</a></li>
                                                    <li><a href="<?= Router::url('users/calls'); ?>">Vos appels</a></li>
                                                    <li><a href="<?= Router::url('users/card'); ?>">Votre carte bancaire</a></li>

                                                </ul>
                                            </li>
                                            <li>
                                                <?php $s = $this->requestAction(array('controller' => 'services', 'action' => 'test'));
                                                if ($s): ?>
                                                    <a href="<?= Router::url('services/index'); ?>">Espace expert <i class="icon-angle-down"></i></a>
                                                    <ul>
                                                        <li><a href="<?= Router::url('services/index'); ?>">Vos services :</a></li>
    <?php foreach ($s as $k => $v): ?><?php $v = current($v);
        $i = $k + 1; ?>
                                                            <li>
                                                                <a href="<?= Router::url('services/service/id:' . $v->id); ?>"><?= $i . ' - ' . $v->title; ?> <i class="icon-angle-right"></i></a>
                                                                <ul>
                                                                    <li><a href="<?= Router::url('services/edit/id:' . $v->id); ?>">Fiche de service</i></a></li>
                                                                    <li><a href="<?= Router::url('services/availabilities/id:' . $v->id); ?>">Vos disponibilités</a></li>
                                                                    <li><a href="<?= Router::url('services/calls/id:' . $v->id); ?>">Vos appels reçus</a></li>
                                                                    <li><a href="<?= Router::url('services/repayments/id:' . $v->id); ?>">Vos gains</a></li>
                                                                    <li><a href="<?= Router::url('services/bdi/id:' . $v->id); ?>">Votre IBAN</a></li>
                                                                    <li><a href="<?= Router::url('services/clients/id/' . $v->id); ?>">Vos clients</a></li>
                                                                </ul>
                                                            </li>
                                                        <?php endforeach ?>
                                                        <?php if ($i < 3) : ?>
                                                            <li><a href="<?= Router::url('services/create'); ?>"><i class="icon-plus"></i> Créer un nouveau service</a></li>
                                                    <?php endif; ?>
                                                    </ul>
                                                <?php else: ?>
                                                    <a href="<?= Router::url('services/create'); ?>">Devenir expert ?</a>
<?php endif; ?>
                                            </li>


                                            <?php
                                            if ($s) {
                                                $ns = new Status();
                                                $ns_status = $ns->MonStatusAvance();
                                                if ($ns_status == "1")
                                                    $couleur = "#88c51f";
                                                if ($ns_status == "0")
                                                    $couleur = "#95a5a6";
                                                if ($ns_status == "2")
                                                    $couleur = "#e74c3c";
                                                ?>

                                                <?php
                                                if ($ns_status != "") {
                                                    ?>
                                                    <li>
                                                        <select name="state" onchange='makeRequest("https://www.esatus.fr/change_status.php?id_session=<?php echo $this->Session->profile('id'); ?>", "epn");
                                                                    changeColor(this.value);' id="epn" <?php
                                                                if ($ns_status == "1") {
                                                                    echo 'style="background-color: #88c51f;width:120px;"';
                                                                }
                                                                if ($ns_status == "0") {
                                                                    echo 'style="background-color: #95a5a6;width:120px;"';
                                                                }
                                                                if ($ns_status == "2") {
                                                                    echo 'style="background-color: #e74c3c;width:120px;"';
                                                                }
                                                                ?>  >
                                                                    <?php
                                                                    if ($ns_status == "1") {

                                                                        echo ' <option selected="selected" style="background-color: #88c51f">En ligne</option>
                    <option style="background-color: #95a5a6"  >Indisponible</option>
                    <option style="background-color: #e74c3c" >Occupe</option>';
                                                                    }
                                                                    if ($ns_status == "0") {
                                                                        echo ' <option style="background-color: #88c51f">En ligne</option>
                    <option selected="selected" style="background-color: #95a5a6">Indisponible</option>
                    <option style="background-color: #e74c3c">Occupe</option>';
                                                                    }
                                                                    if ($ns_status == "2") {

                                                                        echo ' <option style="background-color: #88c51f" >En ligne</option>
                    <option style="background-color: #95a5a6" >Indisponible</option>
                    <option selected="selected" sstyle="background-color: #e74c3c">Occupe</option>';
                                                                    }
                                                                    //added by andru
                                                                    if ($ns_status == "3") {

                                                                        echo ' <option value="" disabled selected>Votre statut temporaire</option>
                    <option style="background-color: #88c51f" >En ligne</option>
                    <option style="background-color: #95a5a6" >Indisponible</option>
                    <option style="background-color: #e74c3c" >Occupe</option>';
                                                                    }
                                                                    //echo 'status', $ns -> MonStatus();
                                                                    ?>


                                                        </select>
                                                        <div id="id_ecrire"> </div>

                                                    </li>
    <?php } ?> 
<?php } ?>
                                            <li>
                                                <a href="<?= Router::url('categories/index'); ?>">Consulter nos experts</a>

                                            </li>
                                            <li><a href="https://esatus.fr/blog">Blog</a></li>
                                        </ul>
	              			<!-- Actions -->
	              			<ul class="nav pull-right" style="margin-left: 40px;">		
	                			<li>
				                  	<a href="<?= Router::url('users/index'); ?>"><span class="fui-settings-24"></span> <i class="icon-angle-down"></i></a>
				                  	<ul>
				                    	<li><a href="<?= Router::url('pages/index'); ?>">Retour au site</a></li>
				                    	<li><a href="http://www.esatus.fr/index.php/deconnexion">Me déconnecter</a></li>
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
	    <footer>
	    	<!--<div id="last_reviews">
		    	<div class="container">
			    	<div class="row">
				    	<div class="review text-center">
				    		<blockquote class="lead">" J'ai beaucoup apprécié les conseils de Clément. Merci pour tout ! "</blockquote>
							Par Marie il y a 20 minutes au sujet de <a href="#">Clément Zezuka, développeur web</a> 
							| note : <span class="label label_default review_rating">9/10</span>
				    	</div>
					</div>
				</div>
		    </div>-->
			<div class="container">
        		<div class="row">
          			<div class="span7">            			
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
				                <li>service client : 08 99 70 35 27</li>
                                                <li>Numéro surtaxé à 1,35 € TTC par appel + 0,34 € la minute</li>
			              	</ul>
              				<a href="<?= Router::url('pages/imprint'); ?>">Mentions légales</a> - 
              				<a href="<?= Router::url('pages/termsofuse'); ?>">CGU</a>
              				<br/>
              				<br/>
              				<a href="http://www.orange.fr"  target="_blank"><img src="<?= IMAGE; ?>label-orange-qualite.png" alt="Qualité certifiée par Orange" /></a>
              				<a href="http://www.paybox.com" target="_blank"><img src="<?= IMAGE; ?>label-paybox-securise.png" alt="Paiments sécurisés par Paybox" /></a>
                                         <br><br>
                                         <a href="#" onclick="window.open('https://www.sitelock.com/verify.php?site=esatus.fr','SiteLock','width=600,height=600,left=160,top=170');" >
                                            <img alt="SiteLock" title="SiteLock" src="//shield.sitelock.com/shield/esatus.fr"/>
                                        </a>
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