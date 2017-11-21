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
<div class="container masterhead">
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
 <?php if($service->validated == 1) : ?>
  <!--<div id="log"></div>-->
  <div class="row">
      <div class="span3 text-center">
        <img class="rounded" style="margin-bottom:10px;" src="<?= IMAGE; ?>services/<?= $service->img; ?>" alt="<?= $service->title; ?>">

        <!-- <br/><small><?= $service->average; ?></small> -->
        <?php
        if ($service->available == 1): ?>
          <a data-service-id="<?= $service->id; ?>" data-charge-id="" data-call-id="" id="disconnect_button"
             class="btn btn-primary btn-large btn-block hidden disconnect_button" href="javascript:void(0)">Connectiopn à appeler</a>
        <a href="javascript:void(0)"
           data-toggle='modal' data-target='adviser_detail'
           class="btn btn-large btn-primary call_button h-modal">Appeler maintenant</a>
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

        <?php elseif ($service->available == 2): ?>
        <span class="btn btn-danger btn-large">Occupé</span>
        <?php else: ?>
        <span class="btn btn-large disabled">Indisponible</span>
        <?php endif; ?>
      </div>
      <div class="span9" style="text-align:left;">
        <h1 style="margin:0;"><?= ($service->username == '') ? $user->first_name.' '.$user->last_name:utf8_decode($service->username); ?></h1>
        <h6 style="color:#aaa;margin-top:0;font-size:0.85em;"><?= $service->title; ?></h6>
        <p style="line-height:1.4em;"><?= $service->description; ?></p>
      </div>
    </div>
</div>

<div class="container infos">
  <div class="row">
    <div class="span3">
      <div class="rating">
        <h4>Appels</h4>
        <p class="up"><?= $service->count; ?></p>
      </div>
    </div>
    <div class="span3">
      <div class="rating">
        <h4>Note</h4>
        <p class="up"><?= str_replace('.00','',$service->average); ?> / 10</p>
      </div>
    </div>
    <div class="span3">
      <div class="rating">
        <h4>Tarif / Appel</h4>
        <p class="up"><?= number_format($service->cost_per_call,2); ?> €</p>
      </div>
    </div>
    <div class="span3">
      <?php if ($service->promo): ?>
         <div class="iconepromo">
            <p class="up" style="margin-top: 10px;"><strong><?= $service->promo ?></strong><br><br><?= number_format($service->cost_per_minute,2); ?> €/ Minute<br></p>
        </div>
          <?php else: ?>
          <div class="rating">
        <h4>Tarif / minute</h4>
        <p class="up"><?= number_format($service->cost_per_minute,2); ?> €</p>
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
      <?php if (count($reviews) == 0): ?>
      <h2>Pas encore d'avis</h2>
      <?php else: ?>
      <h2>Les avis <sup>(<?= count($reviews); ?>)<sup></h2>
      <?php $i = 0; foreach ($reviews as $k=>$v): ?><?php $v = current($v); ?>
      <div class="row comment <?= ($i%2 == 0) ? 'even':'odd'; ?>">
        <div class="span2">
          <div class="rating">
            <h4>Note</h4>
            <p class="orange up-rating"><?= $v->rate; ?></p>
            <span class="hash">&nbsp;</span>
            <p class="down">10</p>
          </div>
        </div>
        <div class="span7">
          <h3><?= $v->name; ?></h3>
          <blockquote>
            <p><?= $v->comment ?></p>
          </blockquote>
        </div>
        <div class="span2 offset1">
          <time>Le <?= prettyDate($v->date); ?></time>
        </div>
      </div>
      <?php $i++; ?>
      <?php endforeach; ?>
      <?php endif; ?>
    </div>
    <div>
      <div class="row">
        <div class="span12">
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
              <?php for ($i=0; $i<24; $i++): ?>
              <tr>
                <td class="blue"><?= str_pad($i,2,'0',STR_PAD_LEFT); ?>:00</td>
                <?php foreach ($service->availabilities as $day): ?>
                <?php
                  $slots = explode(';',$day);
                  $cls = false;
                  foreach ($slots as $slot) {
                    $hours = explode(':',$slot);
                    if (isset($hours[1])) {
                      if ($i >= $hours[0] && $i < $hours[1]) {
                        $cls = true;
                      }
                    }
                  }
                ?>
                <td<?= ($cls) ? ' class="green"':''; ?>></td>
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
        <div class="span12">
          <h2>A propos de moi...</h2>
          <p><?= nl2br($service->presentation); ?></p>
        </div>
      </div>
    </div>
    <div>
      <div class="row">
        <div class="span12">
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
