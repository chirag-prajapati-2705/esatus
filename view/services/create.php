<div class="container masterhead">
    <div class="demo-headline">
        <h1 class="demo-logo">Créer un service<br><small>Rien de plus simple ! Renseignez les champs ci-dessous pour créer votre service</small></h1>
    </div>
</div>
<div class="container">
    <?= $this->Session->flash(); ?>
    <div class="row row-form">
        <div class="login-form span4 offset4 center">
            <form action="<?= Router::url('services/create'); ?>" method="post" enctype="multipart/form-data">

                <h2>Image du service</h2>
                <div class="control-group">
                    <label class="text" for="photo">Photo :</label>
                    <input type="file" class="login-field" name="photo" name="id" placeholder="Photo du service">
                </div>

                <h2>Type du service</h2>
                <div class="control-group">
                    <label class="text" for="category_id">Catégorie :</label>
                    <select class="login-field" style="float: none;" name="category_id"> 
                        <?php foreach ($categories as $k => $v): ?><?php $v = current($v); ?>
                            <option value="<?= $v->id; ?>"><?= $v->title; ?></option> 
                        <?php endforeach; ?>
                    </select>
                </div>
                <div id="dynamic" class="control-group">
                    <label class="text" for="subcategory">Sous catégorie :</label>
                    <select class="login-field" name="subcategory_id"> 
                        <?php foreach ($subcategories as $k => $v): ?><?php $v = current($v); ?>
                            <option value="<?= $v->id; ?>"><?= $v->title; ?></option> 
                        <?php endforeach; ?>
                    </select>
                </div>

                <h2>Description du service</h2>
                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'title', 'label' => 'Titre', 'addClass' => 'text', 'options' => array('placeholder' => 'Titre du service', 'class' => 'login-field')
                    ));
                    ?>
                </div>
                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'username', 'label' => 'Pseudonyme', 'addClass' => 'text', 'options' => array('placeholder' => 'Pseudonyme (non obligatoire)', 'class' => 'login-field')
                    ));
                    ?>
                </div>
                <div class="control-group">
                    <?=
                    $this->Form->textarea(array(
                        'name' => 'description', 'label' => 'Description', 'addClass' => 'text', 'options' => array('placeholder' => 'Votre description', 'class' => 'login-field', 'rows' => 3)
                    ));
                    ?>
                </div>
                <div class="control-group">
                    <?=
                    $this->Form->textarea(array(
                        'name' => 'presentation', 'label' => 'Présentation', 'addClass' => 'text', 'options' => array('placeholder' => 'Votre présentation', 'class' => 'login-field', 'rows' => 8)
                    ));
                    ?>
                </div>
                <div class="control-group">
                    <?=
                    $this->Form->textarea(array(
                        'name' => 'reference', 'label' => 'Références', 'addClass' => 'text', 'options' => array('placeholder' => 'Vos références', 'class' => 'login-field', 'rows' => 8)
                    ));
                    ?>
                </div>

                <h2>Prix du service</h2>
                <div class="control-group">
<?=
$this->Form->input(array(
    'type' => 'text', 'name' => 'cost_per_call', 'label' => 'Tarif / Appel', 'addClass' => 'text', 'options' => array('placeholder' => 'Coût par appel', 'class' => 'login-field')
));
?>
                </div>
                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'cost_per_minute', 'label' => 'Tarif / Minute', 'addClass' => 'text', 'options' => array('placeholder' => 'Coût par minute', 'class' => 'login-field')
                    ));
                    ?>
                </div> 

                <h2>Informations générales</h2> 
                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'corporate_name', 'label' => 'Raison sociale', 'addClass' => 'text', 'options' => array('placeholder' => 'Votre raison social', 'class' => 'login-field')
                    ));
                    ?>
                </div>
                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'duns', 'label' => 'SIRET', 'addClass' => 'text', 'options' => array('placeholder' => 'Votre SIRET', 'class' => 'login-field')
                    ));
                    ?>
                </div> 
                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'street_address', 'label' => 'Adresse', 'addClass' => 'text', 'options' => array('placeholder' => 'Votre adresse', 'class' => 'login-field')
                    ));
                    ?>
                </div>
                <div class="control-group">
<?=
$this->Form->input(array(
    'type' => 'text', 'name' => 'city', 'label' => 'Ville', 'addClass' => 'text', 'options' => array('placeholder' => 'Votre ville', 'class' => 'login-field')
));
?>
                </div> 
                <div class="control-group">
<?=
$this->Form->input(array(
    'type' => 'text', 'name' => 'zipcode', 'label' => 'Code postal', 'addClass' => 'text', 'options' => array('placeholder' => 'Votre code postal', 'class' => 'login-field')
));
?>
                </div>

                <h2>Téléphone</h2>
                <div class="control-group">
<?=
$this->Form->input(array(
    'type' => 'text', 'name' => 'phone', 'label' => 'Numéro', 'addClass' => 'text', 'options' => array('placeholder' => '0123456789', 'class' => 'login-field')
));
?>
                </div>

                <input type="submit" class="btn btn-primary btn-large btn-block" value="Créer le service">
            </form>
        </div>
    </div>
</div>

<style type="text/css">
    .center {
        margin: 0 auto;
        max-width: 300px;
        width: 100%;
        float: none;
    }

    .container {
        width: 1000px;
    }

    .row {
        margin-left: 0px;
    }
</style>