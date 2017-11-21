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
<div class="container masterhead">
    <div class="demo-headline">
      	<h1 class="demo-logo2"><img src="http://www.esatus.fr/bin/images/rejoindre.png"></h1>
    </div>
</div>
<div class="container">
    <?= $this->Session->flash(); ?>
    <div class="row row-form">
		<div class="login-form span4 offset4">
    		<form action="<?= Router::url('profiles2/signin2'); ?>" method="post">
    			<div class="control-group">
                    <?= $this->Form->input(array(
                        'type'=>'text','name'=>'pseudo','label'=>'','addClass'=>'login-field-icon','options'=>array('placeholder'=>'Choisissez un pseudo','class'=>'login-field')
                    )); ?>
                </div>
                <div class="control-group">
                    <?= $this->Form->input(array(
                        'type'=>'text','name'=>'email','label'=>'','addClass'=>'login-field-icon','options'=>array('placeholder'=>'Votre adresse email','class'=>'login-field')
                    )); ?>
                </div>
                <div class="control-group">
                    <?= $this->Form->input(array(
                        'type'=>'password','name'=>'password','label'=>'','addClass'=>'login-field-icon','options'=>array('placeholder'=>'Choisissez un mot de passe','class'=>'login-field')
                    )); ?>
                </div>
                <div class="control-group">
                    <?= $this->Form->input(array(
                        'type'=>'text','name'=>'phone','label'=>'','addClass'=>'login-field-icon','options'=>array('placeholder'=>'Votre n° de téléphone','class'=>'login-field')
                    )); ?>
                </div>
                <div class="control-group">
                    <?= $this->Form->input(array(
                        'type'=>'text','name'=>'birth_date','label'=>'','addClass'=>'login-field-icon','options'=>array('placeholder'=>'Date de naissance ex: 25-02-1981','class'=>'login-field')
                    )); ?>
                </div>
                <div class="well text-center">
                    <h4>10 minutes offertes !<br/>Sur votre première consultation.</h4>
                </div>
                <input type="submit" class="btn btn-primary btn-large btn-block" value="C'est parti !">
    		</form>
            
      	</div>
    </div>
</div>
<video autoplay loop poster="/bin/videos/esatus-inscription-background.jpg" id="bgvid">
    <source src="/bin/videos/esatus-inscription-background.webm" type="video/webm">
    <source src="/bin/videos/esatus-inscription-background.mp4" type="video/mp4">
</video>
<style>
    body{
        
        background-size: cover;
    }
    .breadcrumb,
    footer #last_reviews{
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
</style>