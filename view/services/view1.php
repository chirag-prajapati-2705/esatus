
<script type="text/javascript">
    /*
     var auto_refresh = setInterval(
     function ()
     {
     $('#load_donnees').load('#').fadeIn("slow");
     }, 3000); // rafraichis toutes les 10000 millisecondes
     */
</script>
<script>
    glbal_nre = setInterval(function() {
        $.ajax({
            type: "POST",
            url: "/services/occupe_view_all",
            data: {servicesid: {"<?php echo $service->id; ?>": "<?php echo $service->id; ?>"}},
            success: function(html) {
                response = JSON.parse(html);
                
                $(".call_button").css("display", "none");
                if (response["<?php echo $service->id; ?>"] == 2)
                {
                    $("#call_button_occupe").css("display", "");
                }
                if (response["<?php echo $service->id; ?>"] == 1)
                {
                    $("#call_button_ok").css("display", "");
                }
                if (response["<?php echo $service->id; ?>"] == 0)
                {
                    $("#call_button_indispo").css("display", "");
                }
            }
        })

    }, 2000);
</script>
<div class="container masterhead">
    <?php if ($service->validated == 1) : ?>

        <div class="row">
            <div class="col-md-2 text-center">
                <img class="rounded" style="margin-bottom:10px;" src="<?= IMAGE; ?>services/<?= $service->img; ?>" alt="<?= $service->title; ?>">
                <!-- <br/><small></small> -->

                <a id="call_button_ok" href="<?= Router::url('calls/call/' . $service->url); ?>" style="display:none" class="btn btn-large btn-primary call_button">Appeler maintenant</a>
                <span id="call_button_occupe" class="btn btn-danger btn-large call_button" style="display:none">Occupé</span>
                <span id="call_button_indispo" class="btn btn-large disabled call_button" style="display:none">Indisponible</span>
            </div>
            <div class="col-md-10" style="text-align:left;">
                <h1 style="margin:0;"><?= ($service->username == '') ? $user->first_name . ' ' . $user->last_name : utf8_decode($service->username); ?></h1>
                <h2 style="color: #aaa;margin-top: 5px;font-size: 18px;padding-bottom: 5px;"><?= $service->title; ?></h2>
                <p style="line-height:1.4em;"><?= $service->description; ?></p>
            </div>
            <div class="col-md-12" style="text-align:left;">
                <h1>Appelez <?= ($service->username == '') ? $user->first_name . ' ' . $user->last_name : utf8_decode($service->username); ?> <span style="color:#ff9600" >01 78 76 64 88</span></h1>
            </div>
        </div>
    </div>

    <div class="container infos">
        <div class="row">
            <div class="col-md-3">
                <div class="rating">
                    <h4>Appels</h4>
                    <p class="up"><?= $service->count; ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="rating">
                    <h4>Note</h4>
                    <p class="up"><?= str_replace('.00', '', $service->average); ?> / 10</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="rating">
                    <h4>Tarif / Décroche</h4>
                    <p class="up"><?= number_format($service->cost_per_call, 2); ?> €</p>
                </div>
            </div>
            <div class="col-md-3">
                <?php if ($service->promoBienvenue): ?>
                    <div class="iconepromo">
                        <p class="up" style="margin-top: 10px;"><strong><?= $service->promoBienvenue ?></strong><br><br><?= number_format($service->cost_per_minute, 2); ?> €/ Minute<br></p>
                    </div>
                <?php else: ?>
                    <div class="rating">
                        <h4>Tarif / minute</h4>
                        <p class="up"><?= number_format($service->cost_per_minute, 2); ?> €</p>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <div class="container">
        <ul class="four-items">
            <li class="active">Avis</li>
            <li>Agenda</li>
            <li>Présentation</li>
            <li>Références</li>
        </ul>
        <div class="four-contents">
            <div class="active">
                <div class="row">
                    <div class="col-md-12">
                        <?php if (count($reviews) == 0): ?>
                            <h2>Pas encore d'avis</h2>
                        <?php else: ?>
                            <h2>Les avis <sup>(<?= count($reviews); ?>)<sup></h2>
                                        <?php $i = 0;
                                        foreach ($reviews as $k => $v): ?><?php $v = current($v); ?>
                                            <div class="row comment <?= ($i % 2 == 0) ? 'even' : 'odd'; ?>">
                                                <div class="col-md-2">
                                                    <div class="rating">
                                                        <h4>Note</h4>
                                                        <p class="orange up-rating"><?= $v->rate; ?></p>
                                                        <span class="hash">&nbsp;</span>
                                                        <p class="down">10</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <h3><?= $v->name; ?></h3>
                                                    <blockquote>
                                                        <p><?= $v->comment ?></p>
                                                    </blockquote>
                                                </div> 
                                                <div class="col-md-2">
                                                    <time>Le <?= prettyDate($v->date); ?></time>
                                                </div>
                                            </div>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
    <?php endif; ?>
                                    </div>
                                    </div>
                                    </div>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h2>Mes disponibilités</h2>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Heures</th>
                                                            <th>Lundi</th>
                                                            <th>Mardi</th>
                                                            <th>Mercredi</th>
                                                            <th>Jeudi</th>
                                                            <th>Vendredi</th>
                                                            <th>Samedi</th>
                                                            <th>Dimanche</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
    <?php for ($i = 0; $i < 24; $i++): ?>
                                                            <tr>
                                                                <td class="blue"><?= str_pad($i, 2, '0', STR_PAD_LEFT); ?>:00</td>
                                                                <?php foreach ($service->availabilities as $day): ?>
                                                                    <?php
                                                                    $slots = explode(';', $day);
                                                                    $cls = false;
                                                                    foreach ($slots as $slot) {
                                                                        $hours = explode(':', $slot);
                                                                        if (isset($hours[1])) {
                                                                            if ($i >= $hours[0] && $i < $hours[1]) {
                                                                                $cls = true;
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <td<?= ($cls) ? ' class="green"' : ''; ?>></td>
                                                            <?php endforeach; ?>
                                                            </tr>
    <?php endfor; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h2>A propos de moi...</h2>
                                                <p><?= nl2br($service->presentation); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h2>Mes références</h2>
                                                <p><?= nl2br($service->reference); ?></p>
                                            </div>
                                        </div>
                                    </div>          
                                    </div>

<?php else : ?>

                                    <div class="row">
                                        <div class="text-center">
                                            <h1>Cet expert n'est plus disponible sur esatus.fr.</h1>
                                            <a class="btn btn-primary text-center" href="http://esatus.fr">Retourner à l'accueil</a>
                                        </div>
                                    </div>

<?php endif; ?>

                                </div>
