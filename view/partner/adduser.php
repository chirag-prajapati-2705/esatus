<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">
      Clients
      <small>Ajouter client</small>
    </h1>

  </div>
</div>

<div class="container">
    <div class="row row-form">
      	<div class="login-form span4 offset4">
      		<form action="" method="post">
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
                <div class="form-group">
                        <select style="width: 80px;" name="jj">
                            <option value="">Jour</option>
                            <?php for ($j = 1; $j <= 31; $j++): ?>
                                <option value="<?php echo $j ?>"><?php echo $j ?></option>
                            <?php endfor; ?>
                        </select>
                        <select style="width: 80px;" name="mm">
                            <option value="">Mois</option>
                            <?php for ($m = 1; $m <= 12; $m++): ?>
                                <option value="<?php echo $m ?>"><?php echo $m ?></option>
                            <?php endfor; ?>
                        </select>
                        <select name="aa">
                            <option value="">Année</option>
                           <?php for ($a = 1916; $a <= 2016; $a++): ?>
                                <option value="<?php echo $a ?>"><?php echo $a ?></option>
                            <?php endfor; ?>
                        </select>
                </div>
                <input type="submit" class="btn btn-primary btn-large btn-block" value="C'est parti !">
            </form>
      	</div>
    </div>
</div>