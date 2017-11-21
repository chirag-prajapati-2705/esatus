<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo"><?= $user->first_name.' '.$user->last_name; ?></h1>
  </div>
</div>

<div class="container">
  <?= $this->Session->flash(); ?>
  <div class="row row-form">
    <div class="login-form span4 offset4">
      <form action="<?= Router::url('admin/admins/user/slug:'.$slug.'/id:'.$id); ?>" method="post">
        <div class="control-group">
          <?= $this->Form->input(array(
            'type'=>'text','name'=>'last_name','label'=>'Nom','addClass'=>'text','options'=>array('placeholder'=>'Votre nom','class'=>'login-field','value'=>$user->last_name)
          )); ?>
        </div>
        <div class="control-group">
          <?= $this->Form->input(array(
            'type'=>'text','name'=>'first_name','label'=>'Prénom','addClass'=>'text','options'=>array('placeholder'=>'Votre prénom','class'=>'login-field','value'=>$user->first_name)
          )); ?>
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
            <option value="<?= ($day < 10) ? '0'.$day:$day; ?>"<?php if ($day == $d): ?> selected="selected"<?php endif; ?>><?= ($day < 10) ? '0'.$day:$day; ?></option> 
            <?php endforeach; ?>
          </select>
        </div>
        
        <div class="control-group">
          <?= $this->Form->input(array(
            'type'=>'text','name'=>'phone','label'=>'Numéro','addClass'=>'text','options'=>array('placeholder'=>'0123456789','class'=>'login-field','value'=>$user->phone)
          )); ?>
        </div>
        <div class="control-group">
          <label class="text" for="affecter">Affecter à :</label>
          <select class="login-field" name="affecter">
            <?php foreach ($AllServices as $j=>$m): ?><?php $m = current($m); ?>
                <option value="<?= $m->id ?>" selected="selected"><?= $m->user ?></option> 
            <?php endforeach ?>
          </select>
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
      <?php foreach ($services as $k=>$v): ?><?php $v = current($v); ?>
      <a href="<?= Router::url('admin/admins/service/slug:'.clean($user->last_name.' '.$user->first_name).'/id:'.$v->id); ?>"><?= $v->title; ?></a><br/>
      <?php endforeach ?>
      <?php endif; ?>
    </div>
  </div>  
</div>