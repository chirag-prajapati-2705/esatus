<div class="container masterhead" style="width: 100%;padding: 0;">
    <div class="demo-headline">
        <img src="https://www.esatus.fr/bin/images/logo.png">
        <h1 class="demo-logo" style="font-size: 24px">Inscrivez-vous sur Esatus,<br> c'est gratuit</h1>
        <p>25€ offert pour toute nouvelle inscription</p>
    </div>
</div>
<div class="container" style="width: 100%;">
    <?= $this->Session->flash(); ?>
    <div class="row row-form text-center" style="margin:10px;">
        <div class="login-form" style="margin:0px;padding: 10px;">
            <form action="<?= Router::url('profiles/signin'); ?>" method="post" style="margin:0;padding: 10px;"> 
                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'pseudo', 'label' => '', 'addClass' => 'login-field-icon', 'options' => array('placeholder' => 'Choisissez un pseudo', 'class' => 'login-field', 'style'=>'width:100%;padding:0;')
                    ));
                    ?>
               
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'email', 'label' => '', 'addClass' => 'login-field-icon', 'options' => array('placeholder' => 'Votre adresse email', 'class' => 'login-field', 'style'=>'width:100%;padding:0;')
                    ));
                    ?>
               
                    <?=
                    $this->Form->input(array(
                        'type' => 'password', 'name' => 'password', 'label' => '', 'addClass' => 'login-field-icon', 'options' => array('placeholder' => 'Choisissez un mot de passe', 'class' => 'login-field', 'style'=>'width:100%;padding:0;')
                    ));
                    ?>
                
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'phone', 'label' => '', 'addClass' => 'login-field-icon', 'options' => array('placeholder' => 'Votre n° de téléphone', 'class' => 'login-field', 'style'=>'width:100%;padding:0;')
                    ));
                    ?>
               
<?=
$this->Form->input(array(
    'type' => 'hidden', 'name' => 'birth_date', 'label' => '', 'addClass' => 'login-field-icon', 'options' => array('placeholder' => 'Date de naissance ex: 25-02-1981', 'class' => 'login-field', 'value' => '25-02-1981')
));
?>
                </div>
                <div style="text-align: center" >
                    <span style="font-weight: bold;font-size: 10px;" >En cliquant sur Inscription, vous acceptez nos Conditions et indiquez que vous avez lu notre Politique d’utilisation des données, y compris notre Utilisation des cookies.<br><br></span>
                </div>
                <input type="submit" class="btn btn-primary btn-large btn-block" value="S'inscrire">
            </form>
            <a class="login-link" href="<?= Router::url('profiles/login'); ?>">Déjà inscrit ? Connectez-vous !</a>
        </div>
    </div>
</div>