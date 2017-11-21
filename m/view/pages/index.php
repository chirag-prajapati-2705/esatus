<div class="container masterhead">
    <div class="demo-headline-plus">
        <div id="main-container">
            <div id="main" class="wrapper clearfix">
                <!-- FlexSlider -->
                <div id="container">
                     <div id="bleubox span3">	
                        <img src="<?= IMAGE; ?>slide1.jpg">
                    </div>
                    <div id="slider" class="flexslider">
                        <ul class="slides">
                            <li>
                                <span id="span3"><b>Sans Rdv,sans sortir de chez moi , j'ai accès au meilleurs experts en toute tranquillité et confidentialité</b></span>  
                                <img src="<?= IMAGE; ?>slides/sans-rdv.jpg"  /> 
                            </li>
                            <li> 
                                <span id="span3"><b>Avec Esatus vos paiements sont sécurisés 2 fois plus avec nos partenaires Credit Agricole et Paybox Système</b>  </span> 
                                <img src="<?= IMAGE; ?>slides/payement.jpg"/> 
                            </li>
                            <li>
                                <span id="span3"><b>Besoin de vous confier et d'être écouté ? appelez Esatus</b> </span> 
                                <img src="<?= IMAGE; ?>slides/ecoute.jpg"/>
                            </li>
                            <li> 
                                <span id="span3"><b>Consultez nos experts Astro, c'est 10 problèmes évités, mon anonymat préservé</b> </span> 
                                <img src="<?= IMAGE; ?>slides/astro.jpg"  /> 
                            </li>
                            <li> 
                                <span id="span3"><b>Consultez nos experts juridiques, c'est 400 euros économisés !! 24h/24 7j/7</b></span> 
                                <img src="<?= IMAGE; ?>slides/juridique.jpg"   /> 
                            </li>
                            <li> 
                                <span id="span3"><b>Adieu le stress et l'incomprehension , les psychologues Esatus sont disponibles pour moi 24h/24 7j/7 au meilleur tarif.</b></span> 
                                <img src="<?= IMAGE; ?>slides/psycho.jpg" /> 
                            </li>
                            <li> 
                                <span id="span3"><b>Fiscaliste, Business Angel, Comptable, Assistante, Aide à la gestion financière, tous les pro sont disponibles d'un simple click sur Esatus</b></span> 
                                <img src="<?= IMAGE; ?>slides/fiscaliste.jpg" width="160" height="184" /> 
                            </li>
                            <li>
                                <span id="span3"><b>Consultez nos Enseignants qualifiés ,organisez votre programme sur mesure,apprenez 3 fois plus vite et réussissez</b></span>  
                                <img src="<?= IMAGE; ?>slides/enseignant.jpg"  /> 
                            </li>
                            <li> 
                                <span id="span3"><b>Consultez nos experts Medical, c'est 3 heures gagnées, un prédiagnostic personnalisé à tout moment de la journée et de la nuit, dormez rassuré</b> 
                                </span> <img src="<?= IMAGE; ?>slides/medical.jpg"  /> 
                            </li>
                        </ul>
                    </div>
                    <div class="span3">
                        <h1>Voyance sérieuse par téléphone</h1>
                        <h2>Découvrez nos experts de la voyance</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row demo-logo text-center" style="line-height:20px;">
            <small>Accès rapides :</small>
        </div>
        <div id="btnbleu" class="span3 offset3">
            <a href="<?= Router::url('categories/index'); ?>" class="btn btn-large btn-block btn-info">Consulter nos experts</a>
        </div>
        <div class="span3">
            <a href="<?= Router::url('profiles/signinExpert'); ?>" class="btn btn-large btn-block btn-primary">Devenir expert !</a>
        </div>
    </div>
</div>

<div class="container">
    <div class="row demo-tiles">
        <div class="span3">
            <a href="<?= Router::url('categories/category/slug:juridique'); ?>">
                <div class="tile">
                    <i class="icon-legal"></i>
                    <h3 class="tile-title">Juridique</h3>
                </div>
            </a>
        </div>
        <div class="span3">
            <a href="<?= Router::url('categories/category/slug:psychologique'); ?>">
                <div class="tile">
                    <i class="icon-eye-open"></i>
                    <h3 class="tile-title">Psychologique</h3>
                </div>
            </a>
        </div>
        <div class="span3">
            <a href="<?= Router::url('categories/category/slug:sante'); ?>">
                <div class="tile">
                    <i class="icon-plus"></i>
                    <h3 class="tile-title">Santé</h3>
                </div>
            </a>
        </div>
        <div class="span3">
            <a href="<?= Router::url('categories/category/slug:astro'); ?>">
                <div class="tile">
                    <i class="icon-star"></i>
                    <h3 class="tile-title">Astro</h3>
                </div>
            </a>
        </div>
    </div>
    <div class="row demo-logo text-center" style="line-height:20px;">
        <small>Esatus s'engage !</small>
    </div>
    <div class="row demo-tiles">
        <div class="span4">
            <div class="tile tile-home">
              <!-- <img class="tile-image big-illustration" src="<?= IMAGE; ?>illustrations/clipboard.png" alt=""> -->
                <i class="ss-smile"></i>
                <h3 class="tile-title">Satisfaction client</h3>
                <p>Votre satisfaction, <br/>notre priorité.</p>
            </div>
        </div>
        <div class="span4">
            <div class="tile tile-home">
              <!-- <img class="tile-image" src="<?= IMAGE; ?>illustrations/retina.png" alt=""> -->
                <i class="ss-lock"></i>
                <h3 class="tile-title">Discrétion garantie</h3>
                <p>Une confidentialité assurée <br/>pour tous vos appels.</p>
            </div>
        </div>
        <div class="span4">
            <div class="tile tile-home">
              <!-- <img class="tile-image" src="<?= IMAGE; ?>illustrations/bag.png" alt=""> -->
                <i class="ss-tag"></i>
                <h3 class="tile-title">Transparence des prix</h3>
                <p>Les tarifs sont affichés clairement <br/>et les paiements sécurisés par Paybox.</p>
            </div>
        </div>
    </div>
</div>
