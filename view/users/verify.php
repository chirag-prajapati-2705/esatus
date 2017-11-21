<!-- Google Code for Campagne Pi2R Voyance Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 991320576;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "t2NKCPyXlWQQgLTZ2AM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/991320576/?label=t2NKCPyXlWQQgLTZ2AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<?= $this->HTML->css('jquery.fancybox'); ?>
<?= $this->HTML->js('jquery.fancybox.pack'); ?>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');

fbq('init', '1651010671789743');
fbq('track', "PageView");
fbq('track', 'Lead');
</script>
<noscript>
<img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1651010671789743&ev=PageView&noscript=1" />
</noscript>
<!-- End Facebook Pixel Code -->

<div class="container masterhead">
    <div class="demo-headline">
        <h1 class="demo-logo">Ma carte bleue<br></h1>
    </div>
    <small style="display: block; text-align: center;">Sécurisé par &nbsp;<img style="vertical-align:middle;" src="<?= IMAGE ?>icones/paybox-100.jpg" alt="Paybox" /> et <img style="vertical-align:middle;" src="<?= IMAGE ?>icones/Credit-Agricole-32.jpg" alt="Credit Agricole" /></small><br><br>
</div>
<div class="container">
    <?php if ($carte == 'non'): ?>

        <script type="text/javascript">
        $(document).ready(function() {
            $.fancybox("#inline");
        });
        </script>
        <div id="inline" style="display:none;width:500px;">
            Cher membre votre carte bleue ne semble pas valide.<br>
            Un refus de votre banque vient de nous être signalés <br>
            Motif : <p style="color: #f10000;"><?= $this->Session->flash(); ?></p><br><br>
            Vous pouvez enregistrer <a href="">une autre carte</a> ou <a href="https://www.esatus.fr/espace-client/ma-rib">votre RIB</a> pour consulter nos experts.<br>
            Une question appeler notre service client au 0986233633.<br>
            Votre service membres Esatus.	
        </div>
    <?php else: ?>
    <?= $this->Session->flash(); ?>
    <?php endif; ?>
    <div class="row row-form">
        <div class="login-form span4" style="float: left;margin-left: 150px; */">
            <form action="<?= Router::url('users/verify'); ?>" method="post">
                <div style="height: 50px">
                    <span><strong>Numéro de carte :</strong></span><br>
                    <input type="text" class="login-field" placeholder="1111222233334444" name="numero" id="numero">
                </div>
                <br><br>
                <div style="height: 50px">
                    <span><strong>Date de fin de validité :</strong></span><br>
                    <select name="month"> 
                        <?php foreach ($months as $key => $value): ?>
                            <option value="<?= $key; ?>"><?= $key; ?></option> 
                        <?php endforeach; ?>
                    </select> 
                    <select name="year"> 
                        <?php foreach ($years as $year): ?>
                            <option value="<?= $year; ?>"><?= $year; ?></option> 
                        <?php endforeach; ?>
                    </select>
                </div>
                <br><br>
                <div style="height: 50px">
                    
                    <span><strong>Cryptogramme visuel :</strong></span><br>
                    <input type="text" class="login-field" placeholder="123" name="crypto" id="crypto">
                </div>
                <br><br>
                <input type="submit" class="btn btn-primary btn-large btn-block" value="Valider">
            </form>
            <!--<a class="login-link" href="<?= Router::url('pages/contact'); ?>">Pas de carte bleue ?</a>-->
            <!--updated by andru-->
            <a class="login-link" href="<?= Router::url('creer-un-compte/ma-rib'); ?>">Pas de carte bleue ?</a>
        </div>
        <div class="col-md-6 m20" style="float: right;">
            <p style="color: #857d7b;text-align: center;">Aucune somme ne sera débitée à l’avance</p>
            <p style="color: #000000;text-align: center;">Paiement unique en cas de dépassement de l’offre en cours.</p>
            <br>
            <p style="color: #f89134;font-weight: bold;text-align: center;font-size: 22px;">25 € de consultations offerts <br>sur votre 1ere appel.</p>
            <br>
            <p style="color: #000000;text-align: center;">0€ de coût additionnel sur la mise en relation avec l’expert de votre choix.</p>
            <p style="color: #4884dc;font-weight: bold;font-size: 22px;text-align: center;">Exclusivité Esatus</p>
            <p style="color: #000000;text-align: center;text-decoration: underline;">Vous ne souhaitez pas enregistrer votre carte bleue</p>
            <p style="color: #000000;text-align: center;">Autre moyen de paiement <a class="login-link" href="<?= Router::url('users/verify_rib'); ?>" style="color: #000; font-weight: bold; text-decoration: underline;
">Cliquer ici</a></p>
        </div>
        
    </div>
</div>
