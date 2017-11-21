
    <!-- Pour définir l'arriere plan -->
    <?php 
        $imgurl;
        $textalign;
        $page = $this->request->params;
        switch($page[0]){
            case 'business':
                $imgurl = "landing/bg/business.jpg";
                $textalign = "text-right right";
            break;
            case 'sante':
                $imgurl = "landing/bg/sante.jpg";
            break;
            case 'juridique':
                $imgurl = "landing/bg/juridique.jpg";
                $textalign = "text-right right width45";
            break;
            case 'informatique':
                $imgurl = "landing/bg/informatique.jpg";
                $textalign ="right text-right";
            break;
            case 'services':
                $imgurl = "landing/bg/services.jpg";
                $textalign ="width70c";
            break;
            case 'enseignement':
                $imgurl = "landing/bg/enseignement.jpg";
                $textalign ="right text-right width45";
            break;
            case 'voyance':
                $imgurl = "landing/bg/voyance.jpg";
            break;
            case 'psychologie':
                $imgurl = "landing/bg/psychologie.jpg";
                $textalign ="right text-right";
            break;
            default:
                $imgurl = "landing/bg/";
             break;
        }
     ?>
     <div class="block-contact bloc-center bloc-content">
        <div class="container">
        <h2>Obtenez une réponse <span class="text-bold">immédiate à vos questions?</span></h2>
        <p>Esatus vous propose 3 supports de communication pour consulter l’expert de votre choix</p>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-12">
                <a href="#" alt="">
                    <img src="<?= IMAGE; ?>icone_mobile.png" alt="" class="mobile center-block pull-right img-responsive">
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12">
                <a href="#" alt="">
                    <img src="<?= IMAGE; ?>icone_webcam.png" alt="" class="webcam center-block img-responsive">
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12">
                <a href="#" alt="">
                    <img src="<?= IMAGE; ?>icone_chat.png" alt="" class="chat center-block pull-left img-responsive">
                </a>
            </div>
        </div>
        </div>
    </div>
    
    <!-- INTRO -->
    <section id="intro" class="business" style="background: url(<?= IMAGE.$imgurl; ?>) no-repeat;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="content <?php echo $textalign ?>">
                            <h2><?= $h1; ?></h2>
                            <p><?= $subtext ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container -->

        <div class="background-wrapper">
            <div class="container">
                <?= $this->Session->flash(); ?>
                <div class="row">
                    <div class="col-md-6 sub-form">
                            <div id="sub-form">
                                <form class="subscribe" action="<?= Router::url('profiles/signinlanding'); ?>" method="POST">
                                    <h4>Poser vos questions</h4>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <textarea name="question" id="question" cols="30" rows="1" placeholder="Tapez votre question ici..." required></textarea>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" name="pseudo" value="" placeholder="Choisissez un pseudo" class="login-field" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" name="email" value="" placeholder="Votre adresse email" class="login-field" required>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" name="password" value="" placeholder="Choisissez un mot de passe" class="login-field" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-4">
                                                    <input type="text" name="jj" value="" placeholder="JJ" class="login-field" required>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-4">
                                                    <input type="text" name="mm" value="" placeholder="MM" class="login-field" required>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-4">
                                                    <input type="text" name="aa" value="" placeholder="AAAA" class="login-field" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" name="phone" value="" placeholder="Votre n° de téléphone" class="login-field" required>
                                        </div>
                                        <input type="hidden" name="category" value="<?php echo $page[0]; ?>">
                                    </div>
                                    <div class="clearfix"></div>
                                    <button type="submit" class="btn-main btn-center">C'est parti !</button>
                                </form>
                            </div>
                            <span id="result"></span>
                    </div>
                    <div class="col-md-6">
                        <img src="<?= IMAGE; ?>landing/logo_garantie.png" class="garantie center-block img-responsive">
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- INTRO -->

    <!-- SERVICES -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-md-4 service-content sc1">
                    <span><i class="fa fa-smile-o"></i></span>
                    <h4>Satisfaction client</h4>
                    <p>Votre satisfaction, notre priorité.</p>
                </div>
                <div class="col-md-4 service-content sc2">
                    <span><i class="fa fa-lock"></i></span>
                    <h4>Discrétion garantie</h4>
                    <p>Une confidentialité assurée pour tous vos appels.</p>
                </div>
                <div class="col-md-4 service-content sc3">
                    <span><i class="fa fa-tag"></i></span>
                    <h4>Transparence des prix</h4>
                    <p>Les tarifs sont affichés clairement et les paiements sécurisés par Paybox.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- SERVICES -->

    <!-- SCREENSHOTS -->
    <section class="shots">
        <div class="container">
            <div class="content-head">
                <h3>DÉCOUVREZ LES EXPERTS</h3>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="expert-slider">

                        <?php foreach ($services as $k=>$v): ?><?php $v = current($v); ?>

                        <div>
                            <a href="<?= Router::url('services/view/cat:'.$v->category.'/subcat:'.$v->subcategory.'/'.$v->url); ?>">
                                <div class="avatar">
                                    <img  src="<?= IMAGE; ?>services/<?= $v->img; ?>" alt="<?= ($v->username == '') ? $v->user->first_name.' '.$v->user->last_name:utf8_decode($v->username); ?>" width="120" height="120" class="user-profile-image large">
                                </div>
                                <div class="tpro"><?= ($v->username == '') ? $v->user->first_name.' '.$v->user->last_name:utf8_decode($v->username); ?></div>
                            </a>
                                <div class="promo">
                                    <?php if ($v->promoBienvenue): ?>
                                        <span class="labelpromo"><?= $v->promoBienvenue; ?></span>
                                    <?php else: ?>
                                        <span class="label"><?= number_format($v->cost_per_minute, 2); ?> €/min - <?= number_format($v->cost_per_call, 2); ?> €/appel</span>
                                    <?php endif; ?>
                                </div>
                                <div class="occupation"><?= $v->title; ?></div>
                                <div class="infos">
                                    <small>
                                      <span class="label"><?= str_replace('.00','',$v->rating); ?></span> 
                                      <span class="label"><?= $v->callCount; ?> <i class="fa fa-phone"></i></span>
                                      <?php if ($v->promo): ?>
                                      <span class="labelpromo"><?= $v->promo; ?></span>
                                      <?php else: ?>
                                      <span class="label"><?= number_format($v->cost_per_minute,2); ?> €/min</span>
                                      <?php endif; ?>
                                    </small>
                                </div>

                                <div class="action-btn">
                                    <div class="row">
                                        <div class="col-md-6"><a class="btn btn-info tiny" href="<?= Router::url('services/view/cat:'.$v->category.'/subcat:'.$v->subcategory.'/'.$v->url); ?>">Voir sa fiche</a></div>
                                        <div class="col-md-6"><a style="display:<?= ($v->available == 1)? '' : 'none' ?>" class="btn btn-primary tiny call_button call_button_ok_<?= $v->id ?>" href="<?= Router::url('calls/call/' . $v->url); ?>">Appeler</a></div>
                                        <div class="col-md-6"><span style="display:<?= ($v->available == 2)? '' : 'none' ?>" class="btn btn-danger tiny call_button call_button_occupe_<?= $v->id ?>">En consultation</span></div>
                                        <div class="col-md-6"><span style="display:<?= ($v->available == 0)? '' : 'none' ?>" class="btn tiny disabled call_button call_button_indisponible_<?= $v->id ?>">Indisponible</span></div>
                                    </div>
                                </div>
                                
                        </div>
                       <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- SCREENSHOTS -->

    <!-- TESTIMONIALS -->
     <?php
        $this->loadModel('Rating');
        $reviews = $this->Rating->findBy(array('order' => 'id DESC', 'limit' => 20));
        foreach ($reviews as $k => $v) {
            $this->loadModel('User');
            $this->loadModel('Service');
            $this->loadModel('Category');
            $this->loadModel('Subcategory');
            $v->Rating->user = current($this->User->findOneBy(array('conditions' => array('profile_id' => $v->Rating->profile_id))));
            $v->Rating->service = current($this->Service->findOneBy(array('conditions' => array('id' => $v->Rating->service_id))));
            $v->Rating->expert = current($this->User->findOneBy(array('conditions' => array('profile_id' => $v->Rating->service->profile_id))));
            $v->Rating->username = ($v->Rating->service->username == '') ? $v->Rating->expert->last_name . '-' . $v->Rating->expert->first_name : $v->Rating->service->username;
            $v->Rating->category = current($this->Category->findOneBy(array('conditions' => array('id' => $v->Rating->service->category_id))));
            $v->Rating->subcategory = current($this->Subcategory->findOneBy(array('conditions' => array('id' => $v->Rating->service->subcategory_id))));
        }
    ?>

    <?php if (isset($reviews) && $reviews): ?>
    <div class="testimonials">
        <div class="container">
            <div class="row">
                <div id="quote-slider" class="owl-carousel owl-theme">

                    <?php foreach ($reviews as $k => $v): ?><?php $v = current($v); ?>
                        <div class="item">
                            <div class="quote-info">
                                <div class="header">
                                    Par <?= $v->user->first_name; ?> au sujet de <a href="<?= Router::url('services/view/cat:' . $v->category->slug . '/subcat:' . $v->subcategory->slug . '/slug:' . clean($v->username) . '/id:' . $v->service->id); ?>"><?= $v->username; ?>, <?= $v->service->title; ?></a> 
                                | note : <span class="label label_default review_rating"><?= $v->rate; ?>/10</span>
                                </div>
                                <p><?= $v->comment; ?></p>
                                <!-- <cite>- Rebecca<span>XYZ Company</span></cite> -->
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <!-- TESTIMONIALS -->

    <!-- CLIENTS -->
    <div id="clients">
        <div class="container">
            <div class="row">
                <div class="content-head">
                    <h3>ILS NOUS FONT CONFIANCE</h3>
                </div>
                <div class="col-md-12">
                    <ul>
                        <li><a href="#"><img src="<?= IMAGE; ?>landing/clients/orange.jpg" class="img-responsive" alt=""/></a></li>
                        <li><a href="#"><img src="<?= IMAGE; ?>landing/clients/paybox.jpg" class="img-responsive" alt=""/></a></li>
                        <li><a href="#"><img src="<?= IMAGE; ?>landing/clients/conversant.jpg" class="img-responsive" alt=""/></a></li>
                        <li><a href="#"><img src="<?= IMAGE; ?>landing/clients/credit agricole.jpg" class="img-responsive" alt=""/></a></li>
                        <li><a href="#"><img src="<?= IMAGE; ?>landing/clients/4u-consulting.png" class="img-responsive" alt=""/></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- CLIENTS -->


    <!-- FOOTER / COPYRIGHT -->
    <div class="footer-copy">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <p>&copy; 2015 esatus Tous droits réservés.</p>
                </div>

                <div class="col-md-5">
                    <a class="backtotop page-scroll" href="#page-top">Haut de page &Delta;</a>
                </div>
            </div>
        </div>
    </div>
    <!-- FOOTER / COPYRIGHT -->