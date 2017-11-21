
<div class="container masterhead">
    <div class="demo-headline">
        <h1 class="demo-logo">Votre RIB<br></h1>
    </div>
    <small style="display: block; text-cvbcvbvcbalign: center;">S&eacute;curis&eacute; par &nbsp;<img style="vertical-align:middle;" src="<?= IMAGE ?>icones/Credit-Agricole-32.jpg" alt="Credit Agricole" /></small><br><br>
</div>

<div class="container">
    <?= $this->Session->flash(); ?>
    <div class="row row-form">
        <div class="login-form span4 form-width">
            <form action="<?= Router::url('users/verify_rib'); ?>" method="post">
                <div class="control-group">
                    <label class="text" for="numero">Nom de votre banque :</label>
                    <input type="text" class="login-field" placeholder="Soci&eacute;t&eacute; g&eacute;n&eacute;rale" name="banque" id="banque" value="<?= $rib->banque ?>">
                </div>
                <div class="control-group">
                    <label class="text" for="iban">Iban :</label>
                    <input type="text" class="login-field" placeholder="FR00 0000 0000 0000 0000 0000 000" name="iban" id="iban" value="<?= $rib->iban ?>">
                </div>
                <div class="control-group">
                    <label class="text" for="iban">BIC :</label>
                    <input type="text" class="login-field" placeholder="" name="bic" id="bic" value="<?= $rib->bic ?>">
                </div>
                <div class="control-group">
                    <label class="text" for="">Date de pr&Eacute;l&egrave;vement souhait&eacute; :</label>
                    <select class="login-field" name="prelevement"> 
                        <?php foreach ($days as $key): ?>
                            <option value="<?= $key; ?>"<?php if ($key == $rib->prelevement): ?> selected="selected"<?php endif; ?>><?= $key; ?></option> 
                        <?php endforeach; ?>
                    </select> 
                    <!-- <select class="login-field" name="year"> 
                        <?php foreach ($years as $year): ?>
                            <option value="<?= $year; ?>"><?= $year; ?></option> 
                        <?php endforeach; ?>
                    </select> -->
                </div>
                <!-- <div class="control-group">
                    <label class="text" for="crypto">Cryptogramme visuel :</label>
                    <input type="text" class="login-field" placeholder="123" name="crypto" id="crypto">
                </div> -->
                <div class="control-group contrat">
                  <p><input type="checkbox" id="contract_accept">&nbsp;&nbsp;Apr&egrave;s activation du  service par 4U consulting   j&apos;autorise la soci&eacute;t&eacute; SARL 4u Consulting, propri&eacute;taire du site www.Esatus.fr &agrave; d&eacute;biter mon compte bancaire d&eacute;sign&eacute; ci-dessous des consultations effectu&eacute;es sur ce site de mise en relation entre Expert et Particulier et/ou Professionnel.</p>
                  <p>Les montants d&eacute;bit&eacute;s sur mon compte ci-dessous seront r&eacute;alis&eacute;s uniquement suite &agrave; mes consultations et calcul&eacute;s par rapport au temps pass&eacute; en ligne avec l&apos;expert consult&eacute; et de sa tarification en vigueur affich&eacute;e sur la fiche profil.</p>
                  <p>L&apos;historique d&eacute;taill&eacute; de mes appels pourra &ecirc;tre suivi sur mon compte client accessible avec mes identifiant et mot de passe.</p>
                </div>
                <input type="submit" disabled="disabled" class="btn btn-large btn-block disabled" id="btn-validate" value="Enregistrer">
            </form>
            <a class="login-link" href="#">Pas de RIB ?</a>
            <a class="login-link" href="<?= Router::url('users/eraseRib'); ?>">Supprimer RIB</a>
        </div>
        <!--<spsn class="span7">
            <p style="color: #FF9D01;">Un d&eacute;bit sera uniquement r&eacute;alis&eacute; en cas de d&eacute;passement de l'offre Actuel.</p>
            <p>Offre valable uniquement sur votre premier appel.</p>
            <br>
            <p>Pour toutes questions appeler votre service client au 0982323527 num&eacute;ro non surtax&eacute;.</p>
            <br>
            <p>Votre num&eacute;ro de carte bleu sera crypter et prot&eacute;ger par Paybox et Cr&eacute;dit Agricole.</p>
            <p>Les symboles indiquent que votre transaction est securis&eacute;e, vous pouvez remplir votre formulaire en toute confiance <img style="vertical-align:middle;" src="<?= IMAGE ?>icones/paiement-securise.jpg" alt="" />. </p>
            <p>Aucune information bancaire n'est conserv&eacute;e dans nos propres serveur et site internet.</p>
            <small>S&eacute;curis&eacute; par &nbsp;<img style="vertical-align:middle;" <img style="vertical-align:middle;" src="<?= IMAGE ?>icones/Credit-Agricole-32.jpg" alt="Credit Agricole" /></small>
        </spsn>-->
        <spsn class="col-md-12 m20">
          <p>Pour l&apos;activation de ce service notre &eacute;quipe v&eacute;rifira vos informations rib, une fois cela fait vous pourrez contacter vos experts.</p>
          <p>Vous b&eacute;n&eacute;ficiez pour votre premier appel de 25 euros de consultations gratuites.</p>
          <p>Pour toutes questions ou activation rapide appelez votre service client au 0982323527 num&eacute;ro non surtax&eacute;.</p>
          <p>Votre num&eacute;ro rib sera crypter et prot&eacute;ger par Paybox et Cr&eacute;dit Agricole.</p>
          <p>Les symboles indiquent que votre transaction est s&eacute;curis&eacute;e, vous pouvez remplir votre formulaire en toute confiance</p>
          <p>Aucune information bancaire n'est conserv&eacute;e dans nos propres serveur et site internet.</p>
        </spsn>

        <style type="text/css">
          .contrat
          {
            font-size: 0.7em;
          }
          .form-width {
            max-width: 360px;
            width: 100%;
          }
        </style>

        <script type="text/javascript">
          $("#contract_accept").click(function(){
            if($("#contract_accept").is(':checked'))
            {
              $("#btn-validate").removeClass("disabled");
              $("#btn-validate").addClass("btn-primary");
              $("#btn-validate").removeAttr('disabled');
            }
            else
            {
              $("#btn-validate").removeClass("btn-primary");
              $("#btn-validate").addClass("disabled");
              $("#btn-validate").attr('disabled','disabled');
            }
          });
        </script>
        
    </div>
</div>
