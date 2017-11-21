<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">
      Modifier la campagne
    </h1>
  </div>
</div>

<div class="container">
    <div class="row row-form">
      	<div class="login-form span4 offset4">
      		<form action="<?= Router::url('admin/admins/admin_editPromo/id:'.$campagne->Campagne->id); ?>" method="post">

                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'libelle', 'label' => 'Libelle', 'addClass' => 'text', 'options' => array('placeholder' => 'Libelle', 'class' => 'login-field', 'value' => $campagne->Campagne->libelle)
                    ));
                    ?>
                </div>
                <div class="control-group">
                    <label class="text" for="affecter">Type :</label>
                    <select class="login-field" name="type">
                        <option value="Pourcentage" <?php if($campagne->Campagne->type == 'Pourcentage'): ?> selected="selected" <?php endif; ?> >Pourcentage</option> 
                        <option value="Minutes" <?php if($campagne->Campagne->type == 'Minutes'): ?> selected="selected" <?php endif; ?> >Minutes</option> 
                        <option value="Somme" <?php if($campagne->Campagne->type == 'Somme'): ?> selected="selected" <?php endif; ?> >Somme</option> 
                    </select>
                </div>
                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'valeur', 'label' => 'Valeur', 'addClass' => 'text', 'options' => array('placeholder' => 'Valeur', 'class' => 'login-field', 'value' => $campagne->Campagne->valeur)
                    ));
                    ?>
                </div>
                
                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'date_debut', 'label' => 'Date de début', 'addClass' => 'text', 'options' => array('placeholder' => 'Date de début', 'class' => 'login-field', 'id' => 'dpd1', 'value' => $campagne->Campagne->date_debut)
                    ));
                    ?>
                </div>
                    
                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'date_fin', 'label' => 'Date de fin', 'addClass' => 'text', 'options' => array('placeholder' => 'Date de fin', 'class' => 'login-field', 'value' => $campagne->Campagne->date_fin)
                    ));
                    ?>
                </div>
                <input type="submit" class="btn btn-primary btn-large btn-block" value="Modifier">
            </form>
      	</div>
    </div>
</div>