<?php $public_key=(IS_TEST)?'pk_test_UUPu7WV8bDjh2tmsH1Bfqo17':'pk_live_b7q1kdeSkhsyMpvTjwpOpbmu';?>
<script>
    var url = '<?php echo URL; ?>';
    var public_key = '<?php echo $public_key; ?>';
    var user_id = '<?php echo $this->Session->isLogged(); ?>';
</script>
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
                            <?= $service->description; ?>
                        </font></font></p>
            </div>
        </div>
        <div class="info-profil col-lg-9" style="float:left;padding-top:1rem;padding-left:0px;">

            <div class="info-chiffre quicksand">
                <div class="nb-appel">
                    <i class="fa fa-circle" aria-hidden="true"></i><span><font style="vertical-align: inherit;"><font
                                style="vertical-align: inherit;"><?= $service->count; ?></font></font></span><font
                        style="vertical-align: inherit;"><font style="vertical-align: inherit;"> calls
                        </font></font></div>
                <div class="nb-note"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            <?= str_replace('.00', '', $service->average); ?> </font></font><i class="fa fa-star"
                                                                                               aria-hidden="true"></i><span><font
                            style="vertical-align: inherit;"><font
                                style="vertical-align: inherit;">8</font></font></span><font
                        style="vertical-align: inherit;"><font style="vertical-align: inherit;"> /10
                        </font></font></div>
                <div class="tarif-ap" style="background-color:#ff983b;">
                    <h4><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Calling
                                rate</font></font></h4><font style="vertical-align: inherit;"><font
                            style="vertical-align: inherit;"> <?= number_format($service->cost_per_call,2); ?> € / min
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
                        <h5><img class="img-fluid" src="img/esatus/picto-user.png"
                                 style="width:40px; margin-right:10px;" alt=""><font
                                style="vertical-align: inherit;"><font style="vertical-align: inherit;">A propos de
                                    moi...</font></font></h5>

                        <p><font style="vertical-align: inherit;"><font
                                    style="vertical-align: inherit;"><?= nl2br($service->presentation); ?></font></font>
                        </p>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <h3><img class="img-fluid" src="img/esatus/picto-ref.png" style="width:40px; margin-right:10px;"
                                 alt=""><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Mes
                                    références</font></font></h3>

                        <p><font style="vertical-align: inherit;"><font
                                    style="vertical-align: inherit;"><?= nl2br($service->reference); ?></font></font>
                        </p>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <h5 class="border-bottom"><img class="img-fluid" src="img/esatus/picto-ref.png"
                                                       style="width:40px; margin-right:10px;" alt="">Avis clients : 23 -
                            Note moyenne : 8/10</h5>

                        <!-- <div class="tab-content">
                             <div id="com-page-1" class="tab-pane fade in active">
                                 <h4 class="quicksand">Papillon77<img class="img-fluid" src="img/esatus/note-8.png" style="width:30%; margin: -10px 10px 0;" alt=""><span class="date">Le 14 juillet 2017</span></h4>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                 <h4 class="quicksand">Nicole1977<img class="img-fluid" src="img/esatus/note-10.png" style="width:30%; margin: -10px 10px 0;" alt=""><span class="date">Le 7 juillet 2017</span></h4>
                                 <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                                 <h4 class="quicksand">Camille<img class="img-fluid" src="img/esatus/note-7.png" style="width:30%; margin: -10px 10px 0;" alt=""><span class="date">Le 14 juillet 2017</span></h4>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                 <h4 class="quicksand">Fatou02<img class="img-fluid" src="img/esatus/note-9.png" style="width:30%; margin: -10px 10px 0;" alt=""><span class="date">Le 14 juillet 2017</span></h4>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                 <h4 class="quicksand">Marc132<img class="img-fluid" src="img/esatus/note-10.png" style="width:30%; margin: -10px 10px 0;" alt=""><span class="date">Le 14 juillet 2017</span></h4>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                 <h4 class="quicksand">Sabrina<img class="img-fluid" src="img/esatus/note-8.png" style="width:30%; margin: -10px 10px 0;" alt=""><span class="date">Le 14 juillet 2017</span></h4>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                 <h4 class="quicksand">Papillon77<img class="img-fluid" src="img/esatus/note-9.png" style="width:30%; margin: -10px 10px 0;" alt=""><span class="date">Le 14 juillet 2017</span></h4>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                 <h4 class="quicksand">Libelulle32<img class="img-fluid" src="img/esatus/note-7.png" style="width:30%; margin: -10px 10px 0;" alt=""><span class="date">Le 14 juillet 2017</span></h4>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                 <h4 class="quicksand">Porteur85<img class="img-fluid" src="img/esatus/note-10.png" style="width:30%; margin: -10px 10px 0;" alt=""><span class="date">Le 14 juillet 2017</span></h4>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                 <h4 class="quicksand">Papillon77<img class="img-fluid" src="img/esatus/note-8.png" style="width:30%; margin: -10px 10px 0;" alt=""><span class="date">Le 14 juillet 2017</span></h4>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                             </div>


                             <div id="com-page-2" class="tab-pane fade">
                                 <h4 class="quicksand">com-page2<img class="img-fluid" src="img/esatus/note-10.png" style="width:30%; margin: -10px 10px 0;" alt=""><span class="date">Le 14 juillet 2017</span></h4>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                 <h4 class="quicksand">com-page2<img class="img-fluid" src="img/esatus/note-8.png" style="width:30%; margin: -10px 10px 0;" alt=""><span class="date">Le 14 juillet 2017</span></h4>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                             </div>
                         </div>-->

                        <!-- <ul class="nav-profil nav-profil-tabs nav nav-tabs tabs2">
                             <li class="active"><a data-toggle="tab" class="tab-a-style-2" href="#com-page-1">1</a></li>
                             <li class=""><a data-toggle="tab" class="tab-a-style-2" href="#com-page-2">2</a></li>
                             <li class=""><a data-toggle="tab" class="tab-a-style-2" href="com-page-3">3</a></li>
                             <li class=""><a data-toggle="tab" class="tab-a-style-2" href="com-page-4">4</a></li>
                             <li class=""><a data-toggle="tab" class="tab-a-style-2" href="com-page-5">5</a></li>
                         </ul>-->
                    </div>
                    <div id="menu3" class="tab-pane fade">
                        <h5 class="border-bottom"><img class="img-fluid" src="img/esatus/picto-agenda.png"
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
                                        class="img-fluid" src="img/esatus/picto-agenda-blanc.png"
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
                    <img class="img-fluid" src="img/esatus/picto-tel.png" style="width:95px; margin-top:-20px;" alt="">

                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">BY TELEPHONE</font></font>
                    </p>

                    <p style="padding-bottom:1rem;color:#ff00ff;"><font style="vertical-align: inherit;"><font
                                style="vertical-align: inherit;"><?= number_format($service->cost_per_call,2); ?>  € / min</font></font></p>
                    <!--<a data-service-id="<?/*= $service->id; */?>" data-charge-id="" data-call-id="" id="disconnect_button"
                       class="btn btn-primary btn-large btn-block hidden disconnect_button" href="javascript:void(0)">Connectiopn à appeler</a>-->
                    <a class="bleu-over btn btn-large btn-primary call_button h-modal" href="javascript:void(0)" title="Start the call" alt="" data-toggle='modal' data-target='adviser_detail'
                       >  <i class="fa fa-phone" aria-hidden="true"></i><font
                            style="vertical-align: inherit;"><font style="vertical-align: inherit;"> LAUNCH THE
                                CALL</font></font></a>
                    <div class="modal fade form-modal" id="adviser_detail" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <button type="button" class="close"
                                            data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">
                                        Information de paiement
                                    </h4>
                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <span class="payment-errors"></span>
                                    <form action="#" method="POST" class="payment-info" id="payment-form_<?php echo $k; ?>">
                                        <input type="hidden" class="sender-number" name="sender-number" value="<?= (!empty($service->phone))?$service->phone:'' ?>">
                                        <input type="hidden" name="price" value="<?= number_format($service->cost_per_minute, 2); ?>">
                                        <input type="hidden" name="service_id" value="<?= $service->id; ?>">
                                        <div class='form-row'>
                                            <div class='col-xs-12 form-group card'>
                                                <label class='control-label'>Numéro de carte</label>
                                                <input autocomplete='off' name="card_number" class='form-control card-number required' size='20' type='text' data-stripe="number" >
                                            </div>
                                        </div>
                                        <div class='form-row'>
                                            <div class='col-xs-4 form-group cvc required'>
                                                <label class='control-label'>CVV</label>
                                                <input autocomplete='off' name="cvv" class='form-control card-cvc required' placeholder='ex. 311' maxlength="3" size='4' type='text' data-stripe="cvc">
                                            </div>
                                            <div class='col-xs-4 form-group expiration required'>
                                                <label class='control-label'>Expiration</label>
                                                <input class='form-control card-expiry-month required' name="exp_month"  placeholder='MM' size='2' maxlength="2" type='text' data-stripe="exp_month">
                                            </div>
                                            <div class='col-xs-4 form-group expiration required'>
                                                <label class='control-label'> </label>
                                                <input class='form-control card-expiry-year required' name="exp_year"  placeholder='YYYY' size='4' type='text' data-stripe="exp_year">
                                            </div>
                                        </div>
                                        <div class='form-row'>
                                            <div class='col-xs-4 form-group'>
                                                <button type="button" class="btn btn-default submit-payment btn-custom-class"
                                                        value="">Payer »</button>
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
                </div>
                <div class="visio-contact quicksand">
                    <img class="img-fluid" src="img/esatus/picto-cam.png" style="width:95px; margin-top:-20px;" alt="">

                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">BY
                                VISIO</font></font></p>

                    <p style="padding-bottom:1rem;color:#ff00ff;"><font style="vertical-align: inherit;"><font
                                style="vertical-align: inherit;"><?= number_format($service->cost_per_call,2); ?>  € / min</font></font></p>
                    <a class="bord-grey-over" href="#" title="Start the video" alt=""><img class="img-fluid"
                                                                                           src="img/esatus/cam-icon.png"
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

        <div class="col-md-3">
            <a href="http://www.esatus.fr/index.php/experts/voyance/medium-voyant/david-val--1" alt=""
               title="Consult this expert" class="exp-a-profil">
                <img class="card-img-top img-fluid" src="img/esatus/expert01-home.png" alt="" style="">
                <h4 class="card-title" style="text-align:center;"><font style="vertical-align: inherit;"><font
                            style="vertical-align: inherit;">David Val</font></font></h4>

                <div class="note">
                    <p class=""><font style="vertical-align: inherit;"><font
                                style="vertical-align: inherit;">Note </font></font><i class="fa fa-star"
                                                                                       aria-hidden="true"></i><span
                            style="color:#fff;padding:0 10px;"><font style="vertical-align: inherit;"><font
                                    style="vertical-align: inherit;">8</font></font></span><font
                            style="vertical-align: inherit;"><font style="vertical-align: inherit;"> /10</font></font>
                    </p>
                </div>
            </a>
        </div>


        <div class="col-md-3">
            <a href="http://www.esatus.fr/index.php/experts/voyance/medium-voyant/adelaid-435" alt=""
               title="Consult this expert" class="exp-a-profil">
                <img class="card-img-top img-fluid" src="img/esatus/expert02-home.png" alt="">
                <h4 class="card-title" style="text-align:center;"><font style="vertical-align: inherit;"><font
                            style="vertical-align: inherit;">Adelaid</font></font></h4>

                <div class="note">
                    <p class=""><font style="vertical-align: inherit;"><font
                                style="vertical-align: inherit;">Note </font></font><i class="fa fa-star"
                                                                                       aria-hidden="true"></i><span
                            style="color:#fff;padding:0 10px;"><font style="vertical-align: inherit;"><font
                                    style="vertical-align: inherit;">9</font></font></span><font
                            style="vertical-align: inherit;"><font style="vertical-align: inherit;"> /10</font></font>
                    </p>
                </div>
            </a>
        </div>


        <div class="col-md-3">
            <a href="http://www.esatus.fr/index.php/experts/voyance/medium-voyant/olivia-meduim-426" alt=""
               title="Consult this expert" class="exp-a-profil">
                <img class="card-img-top img-fluid" src="img/esatus/expert03-home.png" alt="">
                <h4 class="card-title" style="text-align:center;"><font style="vertical-align: inherit;"><font
                            style="vertical-align: inherit;">Olivia</font></font></h4>

                <div class="note">
                    <p class=""><font style="vertical-align: inherit;"><font
                                style="vertical-align: inherit;">Note </font></font><i class="fa fa-star"
                                                                                       aria-hidden="true"></i><span
                            style="color:#fff;padding:0 10px;"><font style="vertical-align: inherit;"><font
                                    style="vertical-align: inherit;">9</font></font></span><font
                            style="vertical-align: inherit;"><font style="vertical-align: inherit;"> /10</font></font>
                    </p>
                </div>
            </a>
        </div>


        <div class="col-md-3">
            <a href="http://www.esatus.fr/index.php/appelvideo/Pseudonyme/-id expert" alt="" title="Consult this expert"
               class="exp-a-profil">
                <img class="card-img-top img-fluid" src="img/esatus/expert03.png" alt="">
                <h4 class="card-title" style="text-align:center;"><font style="vertical-align: inherit;"><font
                            style="vertical-align: inherit;">Marc Davon</font></font></h4>

                <div class="note">
                    <p class=""><font style="vertical-align: inherit;"><font
                                style="vertical-align: inherit;">Note </font></font><i class="fa fa-star"
                                                                                       aria-hidden="true"></i><span
                            style="color:#fff;padding:0 10px;"><font style="vertical-align: inherit;"><font
                                    style="vertical-align: inherit;">8</font></font></span><font
                            style="vertical-align: inherit;"><font style="vertical-align: inherit;"> /10</font></font>
                    </p>
                </div>
            </a>
        </div>


    </div>

</div>
<style>
    .modal {
        position: fixed;
        top: 10% !important;
        left: 50%;
        z-index: 1050;
        width: 560px;
        margin-left: -280px;
        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        border-radius: 6px;
        -webkit-box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);
        -moz-box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);
        box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);
        -webkit-background-clip: padding-box;
        -moz-background-clip: padding-box;
        background-clip: padding-box;
        outline: none;
    }
    .form-control {
        display: block;
        width: 100%;
        height: 34px !important;
        padding: 6px 12px !important;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    }
    label {
        display: inline-block !important;
        max-width: 100% !important;
        margin-bottom: 5px !important;
        font-weight: 700 !important;
    }
    .card{
        border: none !important;
    }
    .form-group{
        margin-bottom:0px !important; ;
    }
    .payment-info .error{color:red !important;}
    .modal-open .modal{overflow-y: hidden !important;}
</style>