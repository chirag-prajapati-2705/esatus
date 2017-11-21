<script>
$(function() {
   $('#appeler').click(function(e) { 
   $('#appeler').hide();
    });
});
</script>
<div class="container masterhead">
    <div id="<?php echo $the_session ?>" />
    <div class="demo-headline">
        <h1 class="demo-logo">
            Lancement de l'appel
            <small>
                <?php if (!isset($result)): ?>
                    Vérifiez votre numéro de téléphone avant de lancer l'appel
                <?php else: ?>
                    <?php
                    switch ($result) {
                        // Tout ce passe bien
                        case 200:
                            echo 'Nous vous mettons en relation avec votre expert...';
                            break;
                        // Occupé
                        case 410:
                            echo 'Désolé votre expert est actuellement indisponible. Pourquoi ne pas essayer un autre expert de la même catégorie :';
                            break;
                        case 420:
                            echo 'Désolé votre expert est actuellement indisponible. Pourquoi ne pas essayer un autre expert de la même catégorie :';
                            break;
                        // Pas de réponse
                        case 430:
                            echo 'Désolé votre expert ne répond pas. Pourquoi ne pas essayer un autre expert de la même catégorie :';
                            break;
                        case 440:
                            echo 'Désolé votre expert ne répond pas. Pourquoi ne pas essayer un autre expert de la même catégorie :';
                            break;
                        // Autre erreur...
                        default:
                            echo 'Une erreur est survenue. Pourquoi ne pas essayer un autre expert de la même catégorie :';
                            break;
                    }
                    ?>
                <?php endif; ?>
            </small>
        </h1>
    </div>
</div>
<div class="container">
    <?= $this->Session->flash(); ?>
    <?php if (!isset($result)): ?>
        <!-- S'affiche si l'appel n'a pas été lancé -->
        <div class="row row-form">
            <div class="login-form bloc-center">
                <form action="<?= Router::url($url); ?>" method="post">
                    <?php if (!$this->Session->isLogged()): ?>
                        <div class="control-group">
                            <?=
                            $this->Form->input(array(
                                'type' => 'text', 'name' => 'email', 'label' => '', 'addClass' => 'login-field-icon fui-mail-24', 'options' => array('placeholder' => 'Votre adresse email', 'class' => 'login-field')
                            ));
                            ?>
                        </div>
                        <div class="control-group">
                            <?=
                            $this->Form->input(array(
                                'type' => 'password', 'name' => 'password', 'label' => '', 'addClass' => 'login-field-icon fui-lock-24', 'options' => array('placeholder' => 'Votre mot de passe', 'class' => 'login-field')
                            ));
                            ?>
                        </div>
                        <input type="submit" class="btn btn-primary btn-large btn-block" value="Se connecter">
                    <?php else: ?>
                        <div class="control-group">
                            <?=
                            $this->Form->input(array(
                                'type' => 'text', 'name' => 'phone', 'label' => 'Votre numéro de téléphone', 'addClass' => 'text', 'options' => array('placeholder' => 'Votre numéro de téléphone', 'class' => 'login-field', 'value' => $me->phone)
                            ));
                            ?>
                        </div>
                        <input id="appeler" type="submit" id="call_button" class="btn btn-primary btn-large btn-block" value="Lancer l'appel">
                      
                    <?php endif; ?>
                </form>
                <?php if (!$this->Session->isLogged()): ?>
                    <hr>
                    <a class="btn btn-info btn-large btn-block" href="<?= Router::url('profiles/signin'); ?>" style="margin-left: 0px;">Créer un compte</a>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <!-- S'affiche si l'appel a été lancé -->

        <?php if ($result == 200): ?>

            <script>
                $(function() {
                    var launch_compt = 0;
                    var ring_compt = 0;
                    $.ajax({
                        type: "POST",
                        url: "/calls/check_end",
                        data: {oldsession: "<?php echo $the_session ?>", serviceid: "<?php echo $service_id ?>", meid: "<?php echo $me_id ?>"},
                        success: function(html, status) {
                        },
                        error: function(error_html) {
                        },
                    });

                    global_nre = setInterval(function() {
                        launch_compt++;
                        if (launch_compt == 10)
                        {
                            //alert('test');
                            clearInterval(global_nre);
                            more_experts();
                            //alert(1);
                            $.ajax({
                                                type: "POST",
                                                url: "/availabilities/ajax_empty2",
                                                data: {serviceid: "<?php echo $service_id ?>"},
                                                success: function(html) {
                                                    //alert(html);
                                                },
                                                error: function(html) {
                                                    //alert(html);
                                                }
                                            });

                                            //setting new availabilities (andru)
                                            $.ajax({
                                                type: "POST",
                                                url: "/availabilities/ajax_indisponible",
                                                data: {serviceid: "<?php echo $service_id ?>"},
                                                success: function(html) {
                                                    //alert(html);
                                                },
                                                error: function(html) {
                                                    //alert(html);
                                                },
                                            });
                        }

                        $.ajax({
                            type: "POST",
                            url: "/calls/check_launch",
                            data: {oldsession: "<?php echo $the_session ?>", serviceid: "<?php echo $service_id ?>", meid: "<?php echo $me_id ?>"},
                            success: function(html, status) {
                                var response = $.trim(html);
                                //response = "RINGING";
                                //alert(response);
                                if (response == "RINGING")
                                {
                                    clearInterval(global_nre);
                                    $("#call_progression_status").html("Le téléphone de votre expert sonne! Attendez quelque seconde pour repondre ");

                                    ringing_nre = setInterval(function() {
                                        ring_compt++;
                                        if (ring_compt == 10)
                                        {
                                            clearInterval(ringing_nre);
                                            more_experts();
                                            //alert(2);
                                            //appel non repondu 
                                            //more_experts();
                                            $.ajax({
                                                type: "POST",
                                                url: "/availabilities/ajax_empty2",
                                                data: {serviceid: "<?php echo $service_id ?>"},
                                                success: function(html) {
                                                    //alert(html);
                                                },
                                                error: function(html) {
                                                    //alert(html);
                                                }
                                            });

                                            //setting new availabilities (andru)
                                            $.ajax({
                                                type: "POST",
                                                url: "/availabilities/ajax_indisponible",
                                                data: {serviceid: "<?php echo $service_id ?>"},
                                                success: function(html) {
                                                    //alert(html);
                                                },
                                                error: function(html) {
                                                    //alert(html);
                                                },
                                            });
                                        }

                                        $.ajax({
                                            type: "POST",
                                            url: "/calls/check_ring",
                                            data: {oldsession: "<?php echo $the_session ?>", serviceid: "<?php echo $service_id ?>", meid: "<?php echo $me_id ?>"},
                                            success: function(ring_html, ring_status) {
                                               
                                                var ring_response = $.trim(ring_html);
                                                $.ajax({
                                                    type: "POST",
                                                    url: "/availabilities/ajax_statut",
                                                    data: {serviceid: "<?php echo $service_id ?>", statut: 2},
                                                    success: function(html) {
                                                        //alert(html);
                                                    },
                                                    error: function(html) {
                                                        //alert(html);
                                                    },
                                                });
                                                if (ring_response == "ANSWERED")
                                                {
                                                    clearInterval(ringing_nre);
                                                    $("#call_progression_status").html("Votre expert a repondu, vous allez être connecté dans un instant!");

                                                    //check_call
                                                    call_nre = setInterval(function() {
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "/calls/check_call",
                                                            data: {oldsession: "<?php echo $the_session ?>", serviceid: "<?php echo $service_id ?>", meid: "<?php echo $me_id ?>"},
                                                            success: function(call_html, call_status) {
                                                                var call_response = $.trim(call_html);
                                                                //alert(call_response);
                                                                if (call_response == "CALLENDED")
                                                                {
                                                                    $("#call_progression_status").html("Appel terminé");
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "/availabilities/ajax_statut",
                                                                        data: {serviceid: "<?php echo $service_id ?>", statut: 1},
                                                                        success: function(html) {
                                                                            //alert(html);
                                                                        },
                                                                        error: function(html) {
                                                                            //alert(html);
                                                                        },
                                                                    });
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "/calls/flashmessage",
                                                                        success: function(ht) {
                                                                            ht_trim = $.trim(ht);
                                                                            //alert(ht_trim);
                                                                            if (ht_trim == "ABORT")
                                                                                window.location.replace("/noter/<?php echo $the_session ?>");
                                                                            else
                                                                                //$("#call_payment_status").html(ht);
                                                                                window.location.replace("/noter/<?php echo $the_session ?>");
                                                                        }
                                                                    });

                                                                    clearInterval(call_nre);
                                                                    window.location.replace("/noter/<?php echo $the_session ?>");
                                                                    clearInterval(call_nre);
                                                                }
                                                            },
                                                        });
                                                    }, 3000);

                                                    //clearInterval(ringing_nre);
                                                }
                                            }, });
                                    }, 3000);

                                    //clearInterval(global_nre);
                                }

                                //if(response == "HANGUP")
                                //{
                                //more_experts();
                                //}
                                // if(response == "EMPTY")
                                // {
                                //   //sonner libre
                                //   //$("#call_progression_status").html("Un erreur est survenu (empty response)");
                                //   more_experts();
                                // }
                            },
                            error: function(result, status, error) {
                                $("#call_progression_status").html("Un erreur est survenu");
                            },
                        });
                    }, 3000);
                });
            </script>

            <div class="row">
                <div class="span3 text-center service-target">
                    <img class="rounded" style="margin-bottom:10px;" src="<?= IMAGE; ?>services/<?= $service->img; ?>" alt="">
                    <h1 style="margin:0;"><?= ($service->username == '') ? $user->first_name . ' ' . $user->last_name : utf8_decode($service->username); ?></h1>
                    <h6 style="color:#aaa;margin-top:0;font-size:0.85em;"><?= $service->title; ?></h6>
                    <div style="margin-bottom:0.5em;">
                        <small>
                            <span class="label"><?= str_replace('.00', '', $service->average); ?> / 10</span> 
                            <span class="label"><?= $service->count; ?><i class="icon-phone"></i></span>
                            <span class="label"><?= number_format($service->cost_per_minute, 2); ?> €/min</span>
                        </small>
                    </div>
                </div>
                <div class="call-status-box call-status-0 span9 text-center">
                    <h2>
                        <div class="icon-phone flash-infinite" style="font-size:3em;"></div>
                        <br/>
                        <br/>
                        <span id="call_progression_status">Contact de l'expert en cours ...</span>
                        <br><br>
                        <span id="call_payment_status"></span>
                    </h2>
                </div>

                <div id="more" class="call-status-box call-status-1 span9 text-center" style="display : none;"  >
                    <h2>Votre expert ne semble pas répondre ?</h2>
                    <h4>Essayez un autre expert de sa catégorie :</h4>
                    <?php foreach ($services as $k => $v): ?><?php $v = current($v); ?>
                        <div class="related-service">
                            <img class="rounded" style="margin-bottom:10px;" src="<?= IMAGE; ?>services/<?= $v->img; ?>" alt="" />
                            <h1 style="margin:0;font-size:1.4em;"><?= ($v->username == '') ? $v->user->first_name . ' ' . $v->user->last_name : utf8_decode($v->username); ?></h1>
                            <h6 style="color:#aaa;margin-top:0;font-size:0.85em;"><?= $v->title; ?></h6>
                            <div style="margin-bottom:0.5em;">
                                <small>
                                    <span class="label"><?= str_replace('.00', '', $v->rating); ?></span> 
                                    <span class="label"><?= $v->calls; ?><i class="icon-phone"></i></span>
                                    <span class="label"><?= number_format($v->cost_per_minute, 2); ?> €/min</span>
                                </small>
                            </div>
                            <a class="btn btn-info" href="<?= Router::url('services/view/cat:' . $v->category . '/subcat:' . $v->subcategory . '/' . $v->url); ?>">Voir sa fiche</a>
                            <a id="appeler" class="btn btn-primary" href="<?= Router::url('calls/call/' . $v->url); ?>">Appeler</a>
                        </div>              		
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="row offset1"> 
                <div class="row">
                    <?php foreach ($services as $k => $v): ?><?php $v = current($v); ?>
                        <div class="span3 text-center">
                            <img class="rounded" style="margin-bottom:10px;" src="<?= IMAGE; ?>services/<?= $v->img; ?>" alt="" />
                            <h1 style="margin:0;font-size:1.4em;"><?= ($v->username == '') ? $v->user->first_name . ' ' . $v->user->last_name : utf8_decode($v->username); ?></h1>
                            <h6 style="color:#aaa;margin-top:0;font-size:0.85em;"><?= $v->title; ?></h6>
                            <div style="margin-bottom:0.5em;">
                                <small>
                                    <span class="label"><?= str_replace('.00', '', $v->rating); ?></span> 
                                    <span class="label"><?= $v->calls; ?><i class="icon-phone"></i></span>
                                    <span class="label"><?= number_format($v->cost_per_minute, 2); ?> €/min</span>
                                </small>
                            </div>
                            <a class="btn btn-info" href="<?= Router::url('services/view/cat:' . $v->category . '/subcat:' . $v->subcategory . '/' . $v->url); ?>">Voir sa fiche</a>
                            <a class="btn btn-primary" href="<?= Router::url('calls/call/' . $v->url); ?>">Appeler</a>
                        </div>              		
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="row text-center">
                <a style="display:block;margin-top:3em;" href="<?= Router::url('categories/category/slug:' . $category->slug); ?>">Voir tous les experts dans cette catégorie</a>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
