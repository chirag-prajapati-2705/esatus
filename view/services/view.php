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
                    <a class="bleu-over" href="#" title="Start the call" alt=""><i class="fa fa-phone"
                                                                                   aria-hidden="true"></i><font
                            style="vertical-align: inherit;"><font style="vertical-align: inherit;"> LAUNCH THE
                                CALL</font></font></a>
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