<style>
    .hidden{display: none;}
    .modal-body .form-horizontal .col-sm-2,
    .modal-body .form-horizontal .col-sm-10 {width: 100%}

    .form-modal {
        margin-left: 100px !important;
        width: 50%;
        left: 23% !important;
        z-index: 999;
    }
    .modal-body .form-horizontal .control-label {text-align: left;}
    .modal-body .form-horizontal .col-sm-offset-2 {margin-left: 15px;}
    .payment-info .form-control{height: 43px !important;}
    .payment-info .form-group{margin-bottom: 0px !important;}
    .btn-custom-class:hover{background-color: #36a9e1}
    .modal-backdrop{background-color: #fff;}
    .payment-errors{color:red;}
    .payment-info .error{color:#ff0d0d}
    .disconnect-error {
        margin-bottom: 10px;
        padding: 7px;
        border-radius: 5px;
    }

</style>
<?php /* Start: Code Added by Chirag:06/09 */
$public_key=(IS_TEST)?'pk_test_UUPu7WV8bDjh2tmsH1Bfqo17':'pk_live_b7q1kdeSkhsyMpvTjwpOpbmu';
?>
<div class="container masterhead">
    <div class="demo-headline">
        <h1 class="demo-logo"><?= $h1; ?></h1>
        <h2><?= $titre_for_layout ?></h2>
        <p id="phraseCategorie"><strong><?= $titre_strong ?></strong><br><?= $text_for_layout ?></p>
        <br>
        <h2><?= $titre_h2 ?></h2>
        <small style="margin-bottom: 20px; display: block;"><?= ($services) ? 'Ajustez le tri des experts :' : 'Aucun expert dans cette catégorie.'; ?></small>
        <div class="search-filters row">
            <form class="col-md-6 text-right" action="<?= $_SERVER['SCRIPT_URI']; ?>" method="post">
                <select name="sort" class="width-170">
                    <option value="callCount"<?php if ($this->Session->read('sortBy') == 'callCount') echo ' selected="selected"'; ?>>Les plus consultés</option>
                    <option value="rateCount"<?php if ($this->Session->read('sortBy') == 'rateCount') echo ' selected="selected"'; ?>>Les mieux notés</option>
                    <option value="id"<?php if ($this->Session->read('sortBy') == 'id') echo ' selected="selected"'; ?>>Les nouveaux</option>
                </select>
            </form>
            <span class="layout-switch col-md-6 text-left">
                <a class="btn btn-info btn-large" title="Affichage en liste" href="#list"><i class="icon-list"></i></a>
                <a class="btn btn-info btn-large active" title="Affichage en grille" href="#grid"><i class="icon-th"></i></a>
            </span>
        </div>
    </div>
</div>
<div class="container list">
    <div class="calling-messages hidden"></div>
    <script type="text/javascript">
        var servicesid = new Array();
    </script>
    <?php
    foreach ($services as $k => $v): ?><?php $v = current($v);
        ?>
        <div class="row demo-tiles">
            <div class="col-md-5 service">
                <img class="rounded" src="<?= IMAGE; ?>services/<?= $v->img; ?>" width="100" height="100">
                <div class="left">
                    <span class="title"><?= ($v->username == '') ? $v->user->first_name . ' ' . $v->user->last_name : utf8_decode($v->username); ?>
                        <br><small><?= $v->title; ?> (<?= $v->calls; ?>)</small></span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="rating no-margin-top">
                    <h4>Note</h4>
                    <p class="up blue"><?= str_replace('.00', '', $v->rating); ?></p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="rating no-margin-top">
                    <h4>Prix</h4>
                    <p class="up"><?= number_format($v->cost_per_minute, 2); ?> €<sub> / min</sub></p>
                </div>
            </div>
            <div class="col-md-3">
                <a class="btn btn-info btn-large btn-block" href="<?= Router::url('services/view/cat:' . $v->category . '/subcat:' . $v->subcategory . '/' . $v->url); ?>">Voir sa fiche</a>
           <?php $attribute=(!empty($_SESSION['user']->id))? "data-toggle='modal' data-target='myModalHorizontal_$k'":'';
           ?>
                <a style="display:<?= ($v->available == 1) ? '' : 'none' ?>" data-service-id="<?= $v->id; ?>" data-charge-id=""  data-call-id="" id="disconnect_button_<?php echo $k; ?>"
                   class="btn btn-primary btn-large btn-block call_button  hidden disconnect_button call_button_ok_<?= $v->id ?>" href="javascript:void(0)">Connectiopn à appeler</a>
                <a style="display:<?= ($v->available == 1) ? '' : 'none' ?>" id="call_button_<?php echo $k; ?>"
                 <?php  echo $attribute;?>
                   class="btn btn-primary btn-large btn-block call_button h-modal call_button_ok_<?= $v->id ?>" href="<?= Router::url('calls/call/' . $v->url); ?>">Appeler</a>
                <?php /* Start: Code Added by Chirag:06/09 */ ?>
                <div class="modal fade form-modal" id="myModalHorizontal_<?php echo $k; ?>" tabindex="-1" role="dialog"
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
                                    <input type="hidden" class="sender-number" name="sender-number" value="<?= (!empty($v->phone))?$v->phone:'' ?>">
                                    <input type="hidden" name="price" value="<?= number_format($v->cost_per_minute, 2); ?>">
                                    <input type="hidden" name="service_id" value="<?= $v->id; ?>">
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
                                            <input type="submit" class="btn btn-default submit-payment btn-custom-class"
                                                   value="Payer »">
                                        </div>
                                        <div class='col-xs-4 form-group'>
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
                <?php /* Start: Code Added by Chirag:06/09 */ ?>
                <span style="display:<?= ($v->available == 2) ? '' : 'none' ?>" class="btn btn-danger btn-large btn-block call_button call_button_occupe_<?= $v->id ?>">En consultation</span>
                <span style="display:<?= ($v->available == 0) ? '' : 'none' ?>" class="btn btn-large btn-block disabled call_button call_button_indisponible_<?= $v->id ?>">Indisponible</span>
                <a style="display:<?= ($v->available == 1) ? '' : 'none' ?>" class="btn btn-primary btn-large btn-block call_button call_button_ok_<?= $v->id ?>" href="<?= Router::url('calls/call/' . $v->url); ?>">Appel video</a>
            </div>
        </div>
        <script type="text/javascript">
            servicesid["<?= $v->id ?>"] = "<?= $v->id ?>";
        </script>
    <?php endforeach; ?>
    <script type="text/javascript">
        $(function() {
            var url = '<?php echo URL; ?>';
            global_nre = setInterval(function() {
           /*     $.ajax({
                    type: "POST",
                    url: "/services/occupe_view_all",
                    data: {servicesid: servicesid},
                    success: function(s_html) {
                        var message = JSON.parse(s_html);
                        $(".call_button").css("display", "none");

                        for (status in message)
                        {
                            if (message[status] == 1)
                            {
                                $(".call_button_ok_" + status).css("display", "");
                            }
                            else {
                                if (message[status] == 0)
                                {
                                    $(".call_button_indisponible_" + status).css("display", "");
                                }
                                else
                                {
                                    $(".call_button_occupe_" + status).css("display", "");
                                }
                            }
                        }
                    },
                    error: function(e_html) {
                        e_message = $.trim(e_html);
                        console.log("error" + e_message);
                    }, });*/
            }, 2000);
            setInterval(function () {
                check_calling_status();
            }, 5000);

            function check_calling_status() {
                $(".disconnect_button").each(function (index) {
                    if (!$(this).hasClass('hidden')) {
                        var $this = $(this);
                        var call_id = $(this).attr('data-call-id');
                        $.ajax({
                            type: "POST",
                            url: url + "/index.php/services/get_calling_status",
                            data: {'call_id': call_id},
                            success: function (response) {
                                var response = $.parseJSON(response);
                                if (typeof response != 'undefined' && response.success) {
                                    $this.addClass('hidden');
                                    $this.next().removeClass('hidden').text('Appeler');
                                }
                            },
                            error: function (e_html) {
                            }
                        });
                    }
                });
            }
        });

    </script>
</div>
<div class="container grid" >
    <div class="row" style="float: left; max-width:960px; width: 100%; !important; margin: 0 auto;clear: both;">
        <?php foreach ($services as $k => $v): ?><?php $v = current($v); ?>
            <div class="col-md-6">
                <div class="expert expert-grid span3 text-center" style="word-wrap:break-word; height:168px; border:1px solid #d8d8d8;-moz-border-radius:7px;-webkit-border-radius:7px;border-radius:13px;">
                    <div style="float:left;" >
                        <a href="<?= Router::url('services/view/cat:' . $v->category . '/subcat:' . $v->subcategory . '/' . $v->url); ?>"><img class="rounded" style="margin-bottom:10px;" src="<?= IMAGE; ?>services/<?= $v->img; ?>" alt="" /></a>
                    </div>
                    <div style="float:rigth;" >
                        <span class="title"><?= ($v->username == '') ? $v->user->first_name . ' ' . $v->user->last_name : utf8_decode($v->username); ?></span>
                        <?php if ($v->promoBienvenue): ?>
                            <span class="labelpromo"><?= $v->promoBienvenue; ?></span>
                        <?php else: ?>
                            <span class="label"><?= number_format($v->cost_per_minute, 2); ?> €/min - <?= number_format($v->cost_per_call, 2); ?> €/Décroche</span>
                        <?php endif; ?>
                        <h6 style="color:#aaa;margin-top:0;font-size:0.85em;height:40px;word-wrap:break-word;"><?= $v->title; ?>
                        </h6>
                        <div style="margin-bottom:0.5em;column-gap : 3rem">
                            <small>
                                <span class="label"><?= str_replace('.00', '', $v->rating); ?></span>
                                <span class="label"><?= $v->callCount; ?><i class="icon-phone"></i></span>
                                <?php if ($v->promo): ?>
                                    <span class="labelpromo"><?= $v->promo; ?></span>
                                <?php else: ?>
                                    <span class="label"><?= number_format($v->cost_per_minute, 2); ?> €/min</span>
                                <?php endif; ?>
                            </small>
                        </div>
                        <a class="btn-style2 btn btn-info tiny" href="<?= Router::url('services/view/cat:' . $v->category . '/subcat:' . $v->subcategory . '/' . $v->url); ?>">Voir sa fiche</a>
                        <a style="display:<?= ($v->available == 1) ? '' : 'none' ?>" class="btn-style2 btn btn-primary tiny call_button call_button_ok_<?= $v->id ?>" href="<?= Router::url('calls/videoCall/' . $v->url); ?>">Appel video</a>
                        <span style="display:<?= ($v->available == 2) ? '' : 'none' ?>" class="btn-style2 btn btn-danger tiny call_button call_button_occupe_<?= $v->id ?>">En consultation</span>
                        <span style="display:<?= ($v->available == 0) ? '' : 'none' ?>" class="btn-style2 btn tiny disabled call_button call_button_indisponible_<?= $v->id ?>">Indisponible</span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?= $this->HTML->js('jquery.totemticker'); ?>
    <?= $this->HTML->js('jquery-scrolltofixed-min'); ?>
    <?= $this->HTML->js('jquery-scrolltofixed'); ?>
    <?= $this->HTML->js('jquery.scroll-vertical'); ?>
    <?= $this->HTML->css('css.scroll-vertical'); ?>

    <div>
        <?php $slug = $category->title; ?>
        <div class="content">
            <?php $slug = $category->title; ?>
            <ul id="summary">
                <li class="title">Derniers avis clients</li>
                <ul id="vertical-ticker" class="contents">
                    <?php
                    $this->loadModel('Rating');
                    $reviews = $this->Rating->findBy(array('order' => 'id DESC'));
                    //var_dump($reviews);
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

                        <?php foreach ($reviews as $k => $v): ?><?php $v = current($v); ?>

                            <?php if ($slug == $v->category->title): ?>
                                <li >
                                    <span class="label label_default review_rating"><?= $v->rate; ?>/10</span>
                                    <?php
                                    $date = explode("-", $v->date);
                                    switch ($date[1]) {
                                        case 01: $mois = "Janvier";
                                            break;
                                        case 02: $mois = "Fevrier";
                                            break;
                                        case 03: $mois = "March";
                                            break;
                                        case 04: $mois = "Avril";
                                            break;
                                        case 05: $mois = "Mai";
                                            break;
                                        case 06: $mois = "Juin";
                                            break;
                                        case 07: $mois = "Juillet";
                                            break;
                                        case 08: $mois = "Aout";
                                            break;
                                        case 09: $mois = "Septembre";
                                            break;
                                        case 10: $mois = "Octobre";
                                            break;
                                        case 11: $mois = "Novembre";
                                            break;
                                        case 12: $mois = "Decembre";
                                            break;
                                    }
                                    ?>
                                    Le <?php echo $date[2], " ";
                                    echo $mois, " ";
                                    echo $date[0]; ?> : <?= $v->user->first_name; ?> a consulté <a href="<?= Router::url('services/view/cat:' . $v->category->slug . '/subcat:' . $v->subcategory->slug . '/slug:' . clean($v->username) . '/id:' . $v->service->id); ?>"><?= $v->username; ?>, <?= $v->service->title; ?></a> : <?= $v->comment; ?>
                                </li>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>
                </ul>

            </ul>
        </div>
    </div>

    <style type="text/css">
        footer {
            background: none;
            font-size: 15px;
            padding: 0;
            margin-top: 60px;
            position: static !important;
            top: 0px !important;
        }

        .expert-grid {
            width: 95%;
        }
    </style>

    <!--Added by andru 20150520-->
    <div id="id_ecrire"> </div>
    <?php /* Start: Code Added by Chirag:06/09 */ ?>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <?= $this->HTML->js('jquery.validate.min'); ?>
    <?= $this->HTML->js('jquery.blockUI'); ?>
    <script type="text/javascript" src="//media.twiliocdn.com/sdk/js/client/v1.3/twilio.min.js"></script>
    <script type="text/javascript">
        Stripe.setPublishableKey('<?php echo $public_key; ?>');
        $(function () {
            var url='<?php echo URL; ?>';
            var $modal_section=$(".form-modal");
            $(document).on('click','.h-modal',function(e){
                var modal_id = $(this).data('target');
                $('#' + modal_id).modal('show');
                var form_id = $('#' + modal_id).find(".payment-info").attr('id');
                var $form = $('#' + form_id);
            });
             $(document).on('click','.disconnect_button',function(e){
                 var $this=$(this);
                 var call_id = $(this).data('call-id');
                 var charge_id = $(this).data('charge-id');
                 var service_id = $(this).data('service-id');
                 $.ajax({
                     type: "POST",
                     url: url + "/index.php/calls/disconnect",
                     data: {'call_id': call_id, 'charge_id': charge_id, 'service_id': service_id},
                     success: function (response) {
                         var response = $.parseJSON(response);
                         if (typeof response != 'undefined' && response.success) {
                             $this.addClass('hidden');
                             $this.next().removeClass('hidden').text('Appeler');
                         }
                     },
                     error: function (e_html) {
                     }
                 });
            });

            $modal_section.on('click', '.submit-payment', function (e) {
               var form_id=$(this).parents(".payment-info").attr('id');
                var $form = $('#' + form_id);
                if($form.valid()){
                    Stripe.card.createToken($form, stripeResponseHandler);
                    e.preventDefault();
                }
                e.stopPropagation();
            })
            function stripeResponseHandler(status, response) {
                if ($(".form-modal").is(':visible')) {
                    //set_token();
                    var modal_container_id=$('.form-modal[style*="block"]').prev().attr('id');
                    var form_id = $('.form-modal[style*="block"]').find('.payment-info').attr('id');
                    var $form = $('#' + form_id);
                    if (response.error) {
                        $("#"+form_id).prev().html(response.error.message);
                        $form.find('.submit-payment').prop('disabled', false); // Re-enable submission
                    } else {
                        var token = response.id;
                        $form.append($('<input type="hidden" name="stripeToken">').val(token));
                        var form_data=$form.serialize();
                        set_payment(form_data,modal_container_id);
                    }
                    return false;
                }};

            function set_payment(form_data,modal_container_id){
                var form_id = $('.form-modal[style*="block"]').find('.payment-info').attr('id');
                $.ajax({
                    type: "POST",
                    url: url+"/index.php/calls/payment",
                    data: form_data,
                    beforeSend: function () {
                        $.blockUI({message: "S'il vous plaît, attendez", css: {height: '37px', padding: '6px'}});
                    },
                    success: function(response) {
                        var response= $.parseJSON(response);
                        if (typeof response != 'undefined' && response.charge_id != "" && response.call_id != "") {
                            $("#" + modal_container_id).addClass('hidden');
                            $("#" + modal_container_id).prev().attr('data-charge-id', response.charge_id);
                            $("#" + modal_container_id).prev().attr('data-call-id', response.call_id);
                            $("#" + modal_container_id).prev().removeClass('hidden');
                            $(".form-modal").modal('hide');
                            $(".calling-messages").removeClass('hidden').addClass("alert alert-success").html(response.message);
                        } else {
                            $(".form-modal").modal('hide');
                            $("#" + form_id).prev().html("quelque chose s'est mal passé");
                            $(".calling-messages").removeClass('hidden').addClass("alert alert-danger").html(response.message);
                        }
                        $.unblockUI();
                    },
                    error: function (response) {
                        $.unblockUI();
                        $("#" + form_id).prev().html("quelque chose s'est mal passé");
                        $(".calling-messages").removeClass('hidden').addClass("alert alert-danger").html("something Went Wrong!");
                    }
                });
            }
        });
    </script>
    <?php /* Start: Code Added by Chirag:06/09 */ ?>
