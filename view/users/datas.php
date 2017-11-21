<div class="container masterhead">
    <div class="demo-headline">
        <h1 class="demo-logo">Vos informations<br><small>Modifiez vos informations personnelles ici.</small></h1>
    </div>
</div>
<div class="container">
    <?= $this->Session->flash(); ?>
    <div class="row row-form">
        <div class="login-form span4 offset4 center">
            <form action="<?= Router::url('users/datas'); ?>" method="post">
                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'pseudo', 'label' => 'Pseudo', 'addClass' => 'text', 'options' => array('placeholder' => 'Votre Pseudo', 'class' => 'login-field', 'value' => $user->pseudo)
                    ));
                    ?>
                </div>
                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'last_name', 'label' => 'Nom', 'addClass' => 'text', 'options' => array('placeholder' => 'Votre nom', 'class' => 'login-field', 'value' => $user->last_name)
                    ));
                    ?>
                </div>
                <div class="control-group">
<?=
$this->Form->input(array(
    'type' => 'text', 'name' => 'first_name', 'label' => 'Prénom', 'addClass' => 'text', 'options' => array('placeholder' => 'Votre prénom', 'class' => 'login-field', 'value' => $user->first_name)
));
?>
                </div>
                <div class="control-group">
                    <label class="text" for="year">Année de naissance :</label>
                    <select class="login-field" name="year">
<?php foreach ($years as $year): ?>
                            <option value="<?= $year; ?>"<?php if ($year == $y): ?> selected="selected"<?php endif; ?>><?= $year; ?></option> 
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="control-group">
                    <label class="text" for="month">Mois de naissance :</label>
                    <select class="login-field" name="month">
<?php foreach ($months as $key => $value): ?>
                            <option value="<?= $key; ?>"<?php if ($key == $m): ?> selected="selected"<?php endif; ?>><?= $value; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="control-group">
                    <label class="text" for="day">Jour de naissance :</label>
                    <select class="login-field" name="day">
                    <?php foreach ($days as $day): ?>
                            <option value="<?= ($day < 10) ? '0' . $day : $day; ?>"<?php if ($day == $d): ?> selected="selected"<?php endif; ?>><?= ($day < 10) ? '0' . $day : $day; ?></option> 
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="control-group">
<?=
$this->Form->input(array(
    'type' => 'text', 'name' => 'phone', 'label' => 'Numéro', 'addClass' => 'text', 'options' => array('placeholder' => '0123456789', 'class' => 'login-field', 'value' => $user->phone)
));
?>
                </div>
                <input type="submit" class="btn btn-primary btn-large btn-block" value="Valider">
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