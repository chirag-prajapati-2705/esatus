<?php $public_key = (IS_TEST) ? 'pk_test_UUPu7WV8bDjh2tmsH1Bfqo17' : 'pk_live_b7q1kdeSkhsyMpvTjwpOpbmu'; ?>
<script>
    var url = '<?php echo URL; ?>';
    var public_key = '<?php echo $public_key; ?>';
    var user_id = '<?php echo $this->Session->isLogged(); ?>';
</script>
<link href="<?php echo URL ?>/css/style-custom.css" rel="stylesheet">
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<?= $this->HTML->js('jquery.validate.min'); ?>
<?= $this->HTML->js('jquery.blockUI'); ?>
<script type="text/javascript" src="//media.twiliocdn.com/sdk/js/client/v1.3/twilio.min.js"></script>
<?= $this->HTML->js('calling'); ?>
<div class="row"
     style="background-image:url('<?php echo URL . DS; ?>img/esatus/page_profil_img_bkg.png');background-repeat: no-repeat;background-size: 100%;">

    <div class="container profil-info">
        <div class="">
            <div class="col-lg-3 col-3" style="padding:0;float:left;">
                <img class="img-fluid" src="<?= IMAGE; ?>services/<?= $service->img; ?>" alt="<?= $service->title; ?>"
                     style="padding:0;">
            </div>
            <div class="info-txt col-lg-9 col-9" style="float:left;">
                <h4 class="card-title"><font style="vertical-align: inherit;"><font
                            style="vertical-align: inherit;"><?= ($service->username == '') ? $user->first_name . ' ' . $user->last_name : utf8_decode($service->username); ?></font></font>
                </h4>
                <h5 class="card-subtitle"><font style="vertical-align: inherit;"><font
                            style="vertical-align: inherit;"><?= $service->title; ?></font></font></h5>

                <p class="card-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            <?= (strlen($service->description) > 200) ? substr($service->description, 0, 200) . '...' : $service->description; ?>
                        </font></font></p>
            </div>
        </div>
        <div class="info-profil col-lg-9" style="float:left;padding-top:1rem;padding-left:0px;">

            <div class="info-chiffre quicksand">
                <div class="nb-appel">
                    <i class="fa fa-circle" aria-hidden="true"></i><span><?= $service->count; ?></span><font
                        style="vertical-align: inherit;">calls
                    </font></div>
                <div class="nb-note"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            Note</font></font><i class="fa fa-star"
                                                 aria-hidden="true"></i><span><font
                            style="vertical-align: inherit;"><?php echo (trim($service->average) == 'non noté') ? 0 : str_replace('.00', '', $service->average); ?></font></span><font
                        style="vertical-align: inherit;"><font style="vertical-align: inherit;"> /10
                        </font></font></div>
                <div class="tarif-ap" style="background-color:#ff983b;">
                    <h4><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Calling
                                rate</font></font></h4><font style="vertical-align: inherit;"><font
                            style="vertical-align: inherit;"> <?= number_format($service->cost_per_call, 2); ?> € / min
                        </font></font></div>
            </div>
        </div>
    </div>

    <div class="container" id="spe-pb" style="background-color:#fff;">
        <div class="profil-onglet">
            <div class="col-lg-9" style="float:left;">
                <ul class="nav-profil nav-profil-tabs nav nav-tabs quicksand">
                    <li class="active"><a class="tab-a-style-1" data-toggle="tab" href="#home"
                                          title="Presentation"><font style="vertical-align: inherit;"><font
                                    style="vertical-align: inherit;">PRESENTATION</font></font></a></li>
                    <li><a class="tab-a-style-1" data-toggle="tab" href="#menu1" title="References"><font
                                style="vertical-align: inherit;"><font
                                    style="vertical-align: inherit;">REFERENCES</font></font></a></li>
                    <li><a class="tab-a-style-1" data-toggle="tab" href="#menu2" title="view"><font
                                style="vertical-align: inherit;"><font
                                    style="vertical-align: inherit;">NOTICE</font></font></a></li>
                    <li><a class="tab-a-style-1" data-toggle="tab" href="#menu3" title="diary"><font
                                style="vertical-align: inherit;"><font
                                    style="vertical-align: inherit;">AGENDA</font></font></a></li>
                </ul>
                <div class="tab-content tab-style-1">
                    <div id="home" class="tab-pane fade in active">
                        <h5><img class="img-fluid" src="<?php echo URL ?>/img/esatus/picto-user.png"
                                 style="width:40px; margin-right:10px;" alt=""><font
                                style="vertical-align: inherit;"><font style="vertical-align: inherit;">A propos de
                                    moi...</font></font></h5>

                        <p><font style="vertical-align: inherit;"><font
                                    style="vertical-align: inherit;"><?= nl2br($service->presentation); ?></font></font>
                        </p>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <h3><img class="img-fluid" src="<?php echo URL ?>/img/esatus/picto-ref.png"
                                 style="width:40px; margin-right:10px;"
                                 alt=""><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Mes
                                    références</font></font></h3>

                        <p><font style="vertical-align: inherit;"><font
                                    style="vertical-align: inherit;"><?= nl2br($service->reference); ?></font></font>
                        </p>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <h5 class="border-bottom"><img class="img-fluid"
                                                       src="<?php echo URL ?>/img/esatus/picto-ref.png"
                                                       style="width:40px; margin-right:10px;" alt="">Avis clients
                            : <?= count($reviews); ?> -
                            Note moyenne : <?php echo $service->average; ?>/10</h5>


                        <div class="tab-content">
                            <?php if (count($reviews) == 0): ?>
                                <h2>Pas encore d'avis</h2>
                            <?php else: ?>
                                <div id="com-page-1" class="tab-pane fade in active">
                                    <?php $i = 0;
                                    foreach ($reviews as $k => $v): ?>
                                        <?php $v = current($v); ?>
                                        <h4 class="quicksand"><?= $v->name; ?>
                                            <img class="img-fluid" src="img/esatus/note-8.png"
                                                 style="width:30%; margin: -10px 10px 0;" alt="">
                                            <span class="date"><?= prettyDate($v->date); ?></span></h4>
                                        <p><?= $v->comment ?></p>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>


                        </div>

                        <!-- <ul class="nav-profil nav-profil-tabs nav nav-tabs tabs2">
                             <li class="active"><a data-toggle="tab" class="tab-a-style-2" href="#com-page-1">1</a></li>
                             <li class=""><a data-toggle="tab" class="tab-a-style-2" href="#com-page-2">2</a></li>
                             <li class=""><a data-toggle="tab" class="tab-a-style-2" href="com-page-3">3</a></li>
                             <li class=""><a data-toggle="tab" class="tab-a-style-2" href="com-page-4">4</a></li>
                             <li class=""><a data-toggle="tab" class="tab-a-style-2" href="com-page-5">5</a></li>
                         </ul>-->
                    </div>
                    <div id="menu3" class="tab-pane fade">
                        <h5 class="border-bottom"><img class="img-fluid"
                                                       src="<?php echo URL ?>/img/esatus/picto-agenda.png"
                                                       style="width:40px; margin-right:10px;" alt="">Mes disponibilités
                        </h5>

                        <div class="row">
                            <div class=".col-md-3 day">Lundi</div>
                            <div class=".col-md-3 cellule border-grey">8:00 - 13:00</div>
                            <div class=".col-md-3 cellule border-grey">14:00 - 17:00</div>
                            <div class=".col-md-3"></div>
                            <div class=".col-md-3"></div>
                        </div>
                        <div class="row">
                            <div class=".col-md-3 day">Mardi</div>
                            <div class=".col-md-3 cellule border-grey">8:15 - 12:15</div>
                            <div class=".col-md-3 cellule border-grey">12:45 - 15:00</div>
                            <div class=".col-md-3"></div>
                            <div class=".col-md-3"></div>
                        </div>
                        <div class="row">
                            <div class=".col-md-3 day">Mercredi</div>
                            <div class=".col-md-3 cellule border-grey">8:00 - 9:45</div>
                            <div class=".col-md-3 cellule border-grey">9:45 - 12:00</div>
                            <div class=".col-md-3 cellule border-grey">15:15 - 18:00</div>
                            <div class=".col-md-3 cellule border-grey">18:00 - 24:00</div>
                        </div>
                        <div class="row">
                            <div class=".col-md-3 day">Jeudi</div>
                            <div class=".col-md-3 cellule border-grey">8:00 - 9:45</div>
                            <div class=".col-md-3 cellule border-grey">9:45 - 12:00</div>
                            <div class=".col-md-3 cellule border-grey">15:15 - 18:00</div>
                            <div class=".col-md-3 cellule border-grey">18:00 - 24:00</div>
                        </div>
                        <div class="row">
                            <div class=".col-md-3 txt-bleu day">Vendredi</div>
                            <div class=".col-md-3 cellule border-grey txt-bleu">8:15 - 12:45</div>
                            <div class=".col-md-3 cellule border-grey txt-bleu">14:00 - 18:00</div>
                            <div class=".col-md-3"></div>
                            <div class=".col-md-3"></div>
                        </div>
                        <div class="row">
                            <div class=".col-md-3 day">Samedi</div>
                            <div class=".col-md-3 cellule cel-xl border-grey">Non disponible</div>
                            <div class=".col-md-3"></div>
                            <div class=".col-md-3"></div>
                            <div class=".col-md-3"></div>
                        </div>
                        <div class="row">
                            <div class=".col-md-3 day">Dimanche</div>
                            <div class=".col-md-3 cellule cel-xl border-grey">Non disponible</div>
                            <div class=".col-md-3"></div>
                            <div class=".col-md-3"></div>
                            <div class=".col-md-3"></div>
                        </div>
                        <div class="align-center">
                            <div class="align-center" style="margin:40px 0;"><a href="" title="" alt=""
                                                                                class="bkg-bleu cta-rdv"><img
                                        class="img-fluid" src="<?php echo URL ?>/img/esatus/picto-agenda-blanc.png"
                                        style="margin-right:10px;" alt="">PRENDRE RENDEZ-VOUS</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3" style="float:left;">
                <div class="ajout-contact quicksand">
                    <a href="#" title="Add to your contacts" alt="" class=""><i class="fa fa-plus"
                                                                                aria-hidden="true"></i><font
                            style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ADD TO YOUR
                                CONTACTS</font></font></a>
                </div>
                <div class="appel-contact quicksand">
                    <img class="img-fluid" src="<?php echo URL ?>/img/esatus/picto-tel.png"
                         style="width:95px; margin-top:-20px;" alt="">

                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">BY TELEPHONE</font></font>
                    </p>

                    <p style="padding-bottom:1rem;color:#ff00ff;"><font style="vertical-align: inherit;"><font
                                style="vertical-align: inherit;"><?= number_format($service->cost_per_call, 2); ?>  € /
                                min</font></font></p>

                    <?php
                    if ($service->available == 1): ?>
                        <a data-service-id="<?= $service->id; ?>" data-charge-id="" data-call-id=""
                           id="disconnect_button"
                           class="bleu-over h-modal hidden disconnect_button" href="javascript:void(0)">Connectiopn à
                            appeler</a>
                        <a class="bleu-over call_button h-modal" href="javascript:void(0)" title="Start the call" alt=""
                           data-toggle='modal' data-target='adviser_detail'
                            > <i class="fa fa-phone" aria-hidden="true"></i><font
                                style="vertical-align: inherit;"> LAUNCH THE
                                CALL</font></a>

                        <div class="modal fade form-modal" id="adviser_detail" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">
                                            Information de paiement
                                        </h4>
                                    </div>
                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        <span class="payment-errors"></span>

                                        <form action="#" method="POST" class="payment-info"
                                              id="payment-form_<?php echo $k; ?>">
                                            <input type="hidden" class="sender-number" name="sender-number"
                                                   value="<?= (!empty($service->phone)) ? $service->phone : '' ?>">
                                            <input type="hidden" name="price"
                                                   value="<?= number_format($service->cost_per_minute, 2); ?>">
                                            <input type="hidden" name="service_id" value="<?= $service->id; ?>">

                                            <div class='form-row'>
                                                <div class='col-xs-12 form-group card'>
                                                    <label class='control-label'>Numéro de carte</label>
                                                    <input autocomplete='off' name="card_number"
                                                           class='form-control card-number required' size='20'
                                                           type='text'
                                                           data-stripe="number">
                                                </div>
                                            </div>
                                            <div class='form-row'>
                                                <div class='col-xs-4 form-group cvc required'>
                                                    <label class='control-label'>CVV</label>
                                                    <input autocomplete='off' name="cvv"
                                                           class='form-control card-cvc required' placeholder='ex. 311'
                                                           maxlength="3" size='4' type='text' data-stripe="cvc">
                                                </div>
                                                <div class='col-xs-4 form-group expiration required'>
                                                    <label class='control-label'>Expiration</label>
                                                    <input class='form-control card-expiry-month required'
                                                           name="exp_month"
                                                           placeholder='MM' size='2' maxlength="2" type='text'
                                                           data-stripe="exp_month">
                                                </div>
                                                <div class='col-xs-4 form-group expiration required'>
                                                    <label class='control-label'> </label>
                                                    <input class='form-control card-expiry-year required'
                                                           name="exp_year"
                                                           placeholder='YYYY' size='4' type='text'
                                                           data-stripe="exp_year">
                                                </div>
                                            </div>
                                            <div class='form-row'>
                                                <div class='col-xs-4 form-group custom-btn'>
                                                    <button type="button"
                                                            class="btn btn-default submit-payment btn-custom-class"
                                                            value="">Payer »
                                                    </button>
                                                </div>
                                                <div class='col-xs-4 form-group custom-btn'>
                                                    <button type="button" class="btn btn-default btn-custom-class"
                                                            data-dismiss="modal">
                                                        Fermer
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php elseif ($service->available == 2): ?>
                        <span class="btn btn-danger btn-large">Occupé</span>
                    <?php else: ?>
                        <span class="btn btn-large disabled">Indisponible</span>
                    <?php endif; ?>
                </div>
                <div class="visio-contact quicksand">
                    <img class="img-fluid" src="<?php echo URL ?>/img/esatus/picto-cam.png"
                         style="width:95px; margin-top:-20px;" alt="">

                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">BY
                                VISIO</font></font></p>

                    <p style="padding-bottom:1rem;color:#ff00ff;"><font style="vertical-align: inherit;"><font
                                style="vertical-align: inherit;"><?= number_format($service->cost_per_call, 2); ?>  € /
                                min</font></font></p>
                    <a class="bord-grey-over" href="#" title="Start the video" alt=""><img class="img-fluid"
                                                                                           src="<?php echo URL ?>/img/esatus/cam-icon.png"
                                                                                           style="width:20px;"
                                                                                           alt=""><font
                            style="vertical-align: inherit;"><font style="vertical-align: inherit;"> LAUNCH THE
                                CALL</font></font></a>
                </div>
            </div>
        </div>
    </div>
</div>
<h1 class="my-4 quicksand" style="clear:both;"><font style="vertical-align: inherit;"><font
            style="vertical-align: inherit;">Customers are also interested in these experts</font></font></h1>


<div class="container">
    <div class="row align-center" id="exp-selec-2">
        <?php
        foreach($popular_expert as $expert) {
            //var_dump($expert);
            $expert=current($expert);
            ?>
        <div class="col-md-3">
            <a href="<?= Router::url('services/view/cat:'.$expert->category.'/subcat:'.$expert->subcategory.'/'.$expert->url); ?>" alt=""
               title="Consult this expert" class="exp-a-profil">
                <img class="card-img-top img-fluid" src="<?= IMAGE; ?>services/<?= $expert->img; ?>" alt="" style="">
                <h4 class="card-title" style="text-align:center;"><font style="vertical-align: inherit;"><font
                            style="vertical-align: inherit;"><?= ($expert->username == '')?></font></font></h4>

                <div class="note">
                    <p class=""><font style="vertical-align: inherit;"><font
                                style="vertical-align: inherit;">Note </font></font><i class="fa fa-star"
                                                                                       aria-hidden="true"></i><span
                            style="color:#fff;padding:0 10px;"><?= str_replace('.00','',$expert->average)?></span><font
                            style="vertical-align: inherit;"><font style="vertical-align: inherit;"> /10</font></font>
                    </p>
                </div>
            </a>
        </div>
        <?php } ?>
    </div>
</div>
