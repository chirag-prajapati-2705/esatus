<?php
session_start();
if ($_SESSION['source']=='') {
    
    if($_GET['utm_medium']!='') {

        switch ($_GET['utm_medium']) {
            case 'cpc':
                $_SESSION['source'] = 'Google adwords';
                break;
            case 'fb':
                $_SESSION['source'] = 'Facebook Ads';
                break;
            case 'facebook':
                $_SESSION['source'] = 'Facebook Ads';
                break;
            case 'adroll':
                $_SESSION['source'] = 'Landing page Adroll';
                break;
            case 'weedoit':
                $_SESSION['source'] = 'Landing page Weedoit';
                break;
            case 'mail':
                $_SESSION['source'] = 'Mailing';
                break;
        }
        
    } else {
        if($_SERVER['HTTP_REFERER']!='') {
            $_SESSION['source'] = $_SERVER['HTTP_REFERER'];
        } else {
            $_SESSION['source'] = 'Direct';
        }
    }
}

?>
<div class="container">
    <?= $this->Session->flash(); ?>
    <div class="row row-form" style="padding-top: 100px;">
        <div class="login-form span4 offset4" style="background-color: rgba(141, 141, 141, 0.5);border-bottom: none">
            <form action="<?= Router::url('profiles2/signin2'); ?>" method="post">
                <div class="form-group">
                    <?=
                    $this->Form->input(array(
                        'value' => 'test', 'type' => 'hidden', 'name' => 'affiliation', 'label' => '', 'addClass' => 'login-field-icon', 'options' => array()
                    ));
                    ?>
                </div>
                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'pseudo', 'label' => '', 'addClass' => 'login-field-icon', 'options' => array('placeholder' => 'Choisissez un pseudo', 'class' => 'login-field')
                    ));
                    ?>
                </div>
                <div class="control-group">
                     <?php if ($email): ?>
                         <?=
                         $this->Form->input(array(
                             'type' => 'text', 'name' => 'email', 'label' => '', 'addClass' => 'login-field-icon', 'options' => array('value' => $email, 'class' => 'login-field')
                         ));
                         ?>
                     <?php else: ?>
                         <?=
                         $this->Form->input(array(
                             'type' => 'text', 'name' => 'email', 'label' => '', 'addClass' => 'login-field-icon', 'options' => array('placeholder' => 'Votre adresse email', 'class' => 'login-field')
                         ));
                         ?>
                     <?php endif; ?>
                </div>
                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'password', 'name' => 'password', 'label' => '', 'addClass' => 'login-field-icon', 'options' => array('placeholder' => 'Choisissez un mot de passe', 'class' => 'login-field')
                    ));
                    ?>
                </div>
                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'phone', 'label' => '', 'addClass' => 'login-field-icon', 'options' => array('placeholder' => 'Votre n° de téléphone', 'class' => 'login-field')
                    ));
                    ?>
                </div>
                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'hidden', 'name' => 'jj', 'label' => '', 'addClass' => 'login-field-icon', 'options' => array('placeholder' => 'JJ', 'class' => 'login-field', 'style' => 'width:90px', 'value' => '01')
                    ));
                    ?>
                    <?=
                    $this->Form->input(array(
                        'type' => 'hidden', 'name' => 'mm', 'label' => '', 'addClass' => 'login-field-icon', 'options' => array('placeholder' => 'MM', 'class' => 'login-field', 'style' => 'width:90px', 'value' => '01')
                    ));
                    ?>
                    <?=
                    $this->Form->input(array(
                        'type' => 'hidden',  'name' => 'aa', 'label' => '', 'addClass' => 'login-field-icon', 'options' => array('placeholder' => 'AAAA', 'class' => 'login-field', 'style' => 'width:103px', 'value' => '1971')
                    ));
                    ?>
                </div>
                <div class="well text-center">
                    <h4>25 Euros offert <br/>Sur votre première consultation.</h4>
                </div>
                <input type="submit" class="btn btn-primary btn-large btn-block" value="C'est parti !">
            </form>

        </div>
    </div>
</div>
<div id="footer">
    <ul style="float: left;">
        <li><a href="http://www.esatus.fr/contactez-nous">Publicité</a></li>
        <li><a href="http://www.esatus.fr/mentions-legales">Entreprise</a></li>
        <li><a href="http://www.esatus.fr/mentions-legales">A propos</a></li>
    </ul>
    <ul style="float: right;">
        <li><a href="http://www.esatus.fr/conditions-g%C3%A9n%C3%A9rales-d-utilisation">Confidentialité</a></li>
        <li><a href="http://www.esatus.fr/conditions-g%C3%A9n%C3%A9rales-d-utilisation">Conditions</a></li>
        <li><a href="http://www.esatus.fr/creer-un-compte">Paramètres</a></li>
    </ul>
    <p style="padding-left: 100px;float: left;">Les cookies assurent le bon fonctionnement de nos services.En utilisant ces derniers, vous acceptez l'utilisation des cookies. En savoir plus</p>
</div>
<style>
    body{

        -webkit-background-size: cover; /* pour Chrome et Safari */
        -moz-background-size: cover; /* pour Firefox */
        -o-background-size: cover; /* pour Opera */
        background-size: cover; /* version standardisée */
        background: url(/bin/images/esatus-landing.jpg) top center no-repeat;

    }
    .breadcrumb{
        display: none;
    }
    h1.demo-logo{
        text-shadow: 2px 2px 0 rgba(0,0,0,0.5);
    }
    h1.demo-logo small{
        display: block;
        color: #555;
        text-shadow: none;
    }
    .login-form{
        margin-left: 63px;
    }
    .container {
        width: 1349px;
    }
    .login-form:before{
        display: none;
    }
    .login-form .well{
        background-color: #5DADE2; 
    }
    .login-form .well *{
        color: white;
    }
    video#bgvid {
        position: fixed; top: 0px; left: 0;
        min-width: 100%;
        width: auto; height: 822px; z-index: -100;
        background: url(/bin/videos/esatus-inscription-background.jpg) top center no-repeat;
        background-size: cover;
    }
    video{display: block;} /* For IE8 */
    #footer {
        height: 80px;
        background: rgba(242, 242, 242, 1);
        margin-top: 165px;
    }
    #footer ul {
        list-style-type: none;
        margin: 0;
        padding-top: 10px;
        padding-left: 100px;
    }
    #footer ul li {float: left; padding-right:25px;}
    #footer ul li a{color:#766a5c;}
    #footer ul li a:hover{text-decoration: underline}
    #footer p {
        margin: 0 0 0px;
        padding-top: 15px;
        line-height: 22px;
        letter-spacing: 1px;
    }
</style>