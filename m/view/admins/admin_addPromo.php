<div class="container masterhead">
    <div class="demo-headline">
        <h1 class="demo-logo">
            Campagne
            <small>Créer une nouvelle campagne</small>
        </h1>
    </div>
</div>

<div class="container">
    <div class="row row-form">
        <div class="login-form span4 offset4">
            <form action="<?= Router::url('admin/admins/addPromo'); ?>" method="post">
                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'libelle', 'label' => 'Libelle', 'addClass' => 'text', 'options' => array('placeholder' => 'Libelle', 'class' => 'login-field')
                    ));
                    ?>
                </div>
                <div class="control-group">
                    <label class="text" for="affecter">Type :</label>
                    <select class="login-field" name="type">
                        <option value="" selected="selected">Type</option> 
                        <option value="Pourcentage" >Pourcentage</option> 
                        <option value="Minutes" >Minutes</option> 
                        <option value="Somme" >Somme</option> 
                    </select>
                </div>
                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'valeur', 'label' => 'Valeur', 'addClass' => 'text', 'options' => array('placeholder' => 'Valeur', 'class' => 'login-field')
                    ));
                    ?>
                </div>
                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'valeur', 'label' => 'Valeur', 'addClass' => 'text', 'options' => array('placeholder' => 'Valeur', 'class' => 'login-field')
                    ));
                    ?>
                </div>
                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'date_debut', 'label' => 'Date de début', 'addClass' => 'text', 'options' => array('placeholder' => 'Date de début', 'class' => 'login-field', 'id' => 'dpd1')
                    ));
                    ?>
                </div>
                    
                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'date_fin', 'label' => 'Date de fin', 'addClass' => 'text', 'options' => array('placeholder' => 'Date de fin', 'class' => 'login-field')
                    ));
                    ?>
                </div>
                <input type="submit" class="btn btn-primary btn-large btn-block" value="Créer">
            </form>
        </div>
    </div>
</div>