<!-- <div class="container masterhead">
    <div class="demo-headline">
          <h1 class="demo-logo2"></h1>
    </div>
</div> -->
<div class="container">
    <?= $this->Session->flash(); ?>
    <div class="row row-form">
        <div class="login-form bloc-center">
            
    		<form action="<?= Router::url('profiles/signin/affiliation:'.$affiliation); ?>" method="post">
                <div class="form-group">
                    <?=
                    $this->Form->input(array('type' => 'hidden', 'name' => 'affiliation', 'label' => '', 'addClass' => 'login-field-icon', 'options' => array('value' => $affiliation)));
                    ?>
                </div>
                <div class="form-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'pseudo', 'label' => '', 'addClass' => 'login-field-icon', 'options' => array('placeholder' => 'Choisissez un pseudo', 'class' => 'form-control login-field')
                    ));
                    ?>
                </div>
                <div class="form-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'email', 'label' => '', 'addClass' => 'login-field-icon', 'options' => array('placeholder' => 'Votre adresse email', 'class' => 'form-control login-field')
                    ));
                    ?>
                </div>
                <div class="form-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'password', 'name' => 'password', 'label' => '', 'addClass' => 'login-field-icon', 'options' => array('placeholder' => 'Choisissez un mot de passe', 'class' => 'form-control login-field')
                    ));
                    ?>
                </div>
                <div class="form-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'phone', 'label' => '', 'addClass' => 'login-field-icon', 'options' => array('placeholder' => 'Votre n° de téléphone', 'class' => 'form-control login-field')
                    ));
                    ?>
                </div>
                <div class="form-group daten">
                    <div class="row">
                        <div class="col-sm-4">
                            <?=
                                $this->Form->input(array(
                                    'type' => 'text', 'name' => 'jj', 'label' => '', 'addClass' => 'login-field-icon', 'options' => array('placeholder' => 'JJ', 'class' => 'form-control login-field pull-left-sm')
                                ));
                            ?>
                        </div>
                        <div class="col-sm-4">
                            <?=
                                $this->Form->input(array(
                                    'type' => 'text', 'name' => 'mm', 'label' => '', 'addClass' => 'login-field-icon', 'options' => array('placeholder' => 'MM', 'class' => 'form-control login-field')
                                ));
                            ?>
                        </div>
                        <div class="col-sm-4">
                            <?=
                                $this->Form->input(array(
                                    'type' => 'text', 'name' => 'aa', 'label' => '', 'addClass' => 'login-field-icon', 'options' => array('placeholder' => 'AAAA', 'class' => 'form-control login-field pull-right-sm')
                                ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="well text-center">
                    <h4>25 euros offert <br/>Sur votre première consultation.</h4>
                </div>
                <input type="submit" class="btn btn-primary btn-large btn-block" value="C'est parti !">
            </form>
            
      	</div>
    </div>
</div>
<!--
<video autoplay loop poster="/bin/videos/esatus-inscription-background.jpg" id="bgvid">
    <source src="/bin/videos/esatus-inscription-background.webm" type="video/webm">
    <source src="/bin/videos/esatus-inscription-background.mp4" type="video/mp4">
</video>
-->
<style>
    h1.demo-logo{
        text-shadow: 2px 2px 0 rgba(0,0,0,0.5);
    }
    h1.demo-logo small{
        display: block;
        color: #555;
        text-shadow: none;
    }
        .login-form .well{
            background-color: #5DADE2; 
        }
            .login-form .well *{
                color: white;
            }
    video#bgvid {
        position: fixed; top: 60px; left: 0;
        min-width: 100%;
        width: 800px; height: 757px; z-index: -100;
        background: url(/bin/images/background.jpg) top center no-repeat;
        background-size: cover;

    }
    video{display: block;} /* For IE8 */
</style>