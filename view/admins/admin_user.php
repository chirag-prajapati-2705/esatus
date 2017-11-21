<div class="container masterhead">
    <div class="demo-headline">
        <h1 class="demo-logo"><?= $user->first_name . ' ' . $user->last_name; ?></h1>
    </div>
</div>

<div class="container">
    <?= $this->Session->flash(); ?>
    <div class="row row-form">
        <div class="login-form span4 offset4">
            <form action="<?= Router::url('admin/admins/user/slug:' . $slug . '/id:' . $id); ?>" method="post">
                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'pseudo', 'label' => 'Pseudo', 'addClass' => 'text', 'options' => array('placeholder' => 'Le pseudo', 'class' => 'login-field', 'value' => $user->pseudo)
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
                <hr>
                <span><center><b>Informations Bancaires</b></center></span>
                <hr>
                <div class="control-group">
                        <?=
                        $this->Form->input(array(
                            'type' => 'text', 'name' => 'numero', 'label' => 'Numéro de carte', 'addClass' => 'text', 'options' => array('placeholder' => '1111222233334444', 'class' => 'login-field', 'value' => '')
                        ));
                        ?>
                </div>
                <div class="control-group">
                    <label class="text" for="year">Date de fin de validité :</label>
                    <select class="login-field" name="year" style="width:100px">
                            <option value="2015">2015</option> 
                            <option value="2016">2016</option> 
                            <option value="2017">2017</option> 
                            <option value="2018">2018</option> 
                            <option value="2019">2019</option> 
                            <option value="2020">2020</option> 
                    </select>
                    <select class="login-field" name="month" style="width:70px">
                       <option value="01">01</option> 
                       <option value="02">02</option> 
                       <option value="03">03</option> 
                       <option value="04">04</option> 
                       <option value="05">05</option> 
                       <option value="06">06</option> 
                       <option value="07">07</option> 
                       <option value="08">08</option> 
                       <option value="09">09</option> 
                       <option value="10">10</option> 
                       <option value="11">11</option> 
                       <option value="12">12</option> 
                    </select>
                </div>
                <div class="control-group">
<?=
$this->Form->input(array(
    'type' => 'text', 'name' => 'crypto', 'label' => 'Cryptogramme visuel', 'addClass' => 'text', 'options' => array('placeholder' => '123', 'class' => 'login-field', 'value' => '')
));
?>
                </div>
                <input type="submit" class="btn btn-primary btn-large btn-block" value="Modifier">
            </form>  

        </div>
        <div class="span3">
            <h6>Plus d'infos :</h6>
            Email : <a href="<?= $user->email; ?>"><?= $user->email; ?></a><br/>
            Dépensé : <?= $user->amount; ?><br/>
            Appels émis : <?= $user->count; ?><br/>
            Appels notés : <?= $user->comments; ?><br/>
<?php if (isset($user->lastCall)): ?>
                Dernier appel le : <?= prettyDate($user->lastCall); ?><br/>
<?php endif; ?>
            Impayés : <?= $user->unpaids; ?><br/>
<?php if ($services): ?>
                <h6>Ses service(s) :</h6>
    <?php foreach ($services as $k => $v): ?><?php $v = current($v); ?>
                    <a href="<?= Router::url('admin/admins/service/slug:' . clean($user->last_name . ' ' . $user->first_name) . '/id:' . $v->id); ?>"><?= $v->title; ?></a><br/>
    <?php endforeach ?>
<?php endif; ?>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Durée</th>
                    <th>Commision</th>
                    <th>Statut</th>
                    <th>Paiement</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

<?php foreach ($calls as $k => $v): ?><?php $v = current($v); ?>
                    <tr>
                        <td class="white"><?= $v->service; ?></td>
                        <td class="white"><?= $v->date; ?></td>
                        <td class="white"><?= $v->duration; ?></td>
                        <td class="white"><?= $v->commission; ?> <small>TTC</small></td>
                        <td class="white"><?= $v->status; ?></td>
                        <td class="white"><?= $v->payment; ?></td>
                        <td class="white">
                            <a href="<?= Router::url('admin/admins/switch/id:' . $v->id); ?>" class="btn btn-info">
                                <small>Modifier</small>
                            </a>
                        </td>
                    </tr>
<?php endforeach; ?>
            </tbody>
        </table>
    </div>  
</div>