<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">
      <?= $service->title; ?><br/>
      <small>service proposé par <a href="<?= Router::url('admin/admins/user/slug:'.$user->slug.'/id:'.$user->id); ?>"><?= $user->first_name.' '.$user->last_name.' ('.$service->username.')'; ?></a></small>
    </h1>
  </div>
</div>
<div class="container">
  <?= $this->Session->flash(); ?>
  <div class="row row-form">
    <div class="login-form span4 offset4">
      <form action="<?= Router::url('admin/admins/service/slug:'.$slug.'/id:'.$id); ?>" method="post" enctype="multipart/form-data">
        <h2>Image du service</h2>
        <div class="text-center">
          <img class="rounded" src="<?= IMAGE; ?>services/<?= $service->img; ?>" />
        </div>
        <div class="control-group">
          <label class="text" for="photo">Photo :</label>
          <input type="file" class="login-field" name="photo" name="id" placeholder="Photo du service">
        </div>

        <h2>Type du service</h2>
        <div class="control-group">
          <label class="text" for="category_id">Catégorie :</label>
          <select class="login-field" name="category_id"> 
            <?php foreach ($categories as $k=>$v): ?><?php $v = current($v); ?>
            <option value="<?= $v->id; ?>"<?php if ($v->id == $service->category_id): ?> selected="selected"<?php endif; ?>><?= $v->title; ?></option> 
            <?php endforeach; ?>
          </select>
        </div>
        <div id="dynamic" class="control-group">
          <label class="text" for="subcategory">Sous catégorie :</label>
          <select class="login-field" name="subcategory_id"> 
            <?php foreach ($subcategories as $k=>$v): ?><?php $v = current($v); ?>
            <option value="<?= $v->id; ?>"<?php if ($v->id == $service->subcategory_id): ?> selected="selected"<?php endif; ?>><?= $v->title; ?></option> 
            <?php endforeach; ?>
          </select>
        </div>

        <h2>Description du service</h2>
        <div class="control-group">
          <?= $this->Form->input(array(
            'type'=>'text','name'=>'title','label'=>'Titre','addClass'=>'text','options'=>array('placeholder'=>'Titre du service','class'=>'login-field','value'=>$service->title)
          )); ?>
        </div>
        <div class="control-group">
          <?= $this->Form->input(array(
            'type'=>'text','name'=>'username','label'=>'Pseudonyme','addClass'=>'text','options'=>array('placeholder'=>'Pseudonyme (non obligatoire)','class'=>'login-field','value'=>$service->username)
          )); ?>
        </div>
        <div class="control-group">
            <?= $this->Form->textarea(array(
              'name'=>'description','label'=>'Description','addClass'=>'text','options'=>array('placeholder'=>'Votre description','class'=>'login-field','rows'=>3,'value'=>$service->description)
          )); ?>
        </div>
        <div class="control-group">
            <?= $this->Form->textarea(array(
              'name'=>'presentation','label'=>'Présentation','addClass'=>'text','options'=>array('placeholder'=>'Votre présentation','class'=>'login-field','rows'=>8,'value'=>$service->presentation)
          )); ?>
        </div>
        <div class="control-group">
            <?= $this->Form->textarea(array(
              'name'=>'reference','label'=>'Références','addClass'=>'text','options'=>array('placeholder'=>'Vos références','class'=>'login-field','rows'=>8,'value'=>$service->reference)
          )); ?>
        </div>

        <h2>Prix du service</h2>
        <div class="control-group">
          <?= $this->Form->input(array(
            'type'=>'text','name'=>'cost_per_call','label'=>'Tarif / Appel','addClass'=>'text','options'=>array('placeholder'=>'Coût par appel','class'=>'login-field','value'=>$service->cost_per_call)
          )); ?>
        </div>
        <div class="control-group">
          <?= $this->Form->input(array(
            'type'=>'text','name'=>'cost_per_minute','label'=>'Tarif / Minute','addClass'=>'text','options'=>array('placeholder'=>'Coût par minute','class'=>'login-field','value'=>$service->cost_per_minute)
          )); ?>
        </div> 

        <h2>Informations générales</h2> 
        <div class="control-group">
            <?= $this->Form->input(array(
              'type'=>'text','name'=>'corporate_name','label'=>'Raison sociale','addClass'=>'text','options'=>array('placeholder'=>'Votre raison social','class'=>'login-field','value'=>$service->corporate_name)
          )); ?>
        </div>
        <div class="control-group">
            <?= $this->Form->input(array(
              'type'=>'text','name'=>'duns','label'=>'SIRET','addClass'=>'text','options'=>array('placeholder'=>'Votre SIRET','class'=>'login-field','value'=>$service->duns)
          )); ?>
        </div> 
        <div class="control-group">
            <?= $this->Form->input(array(
              'type'=>'text','name'=>'street_address','label'=>'Adresse','addClass'=>'text','options'=>array('placeholder'=>'Votre adresse','class'=>'login-field','value'=>$service->street_address)
          )); ?>
        </div>
        <div class="control-group">
            <?= $this->Form->input(array(
              'type'=>'text','name'=>'city','label'=>'Ville','addClass'=>'text','options'=>array('placeholder'=>'Votre ville','class'=>'login-field','value'=>$service->city)
          )); ?>
        </div> 
        <div class="control-group">
            <?= $this->Form->input(array(
              'type'=>'text','name'=>'zipcode','label'=>'Code postal','addClass'=>'text','options'=>array('placeholder'=>'Votre code postal','class'=>'login-field','value'=>$service->zipcode)
          )); ?>
        </div>

        <h2>Téléphone</h2>
        <div class="control-group">
            <?= $this->Form->input(array(
              'type'=>'text','name'=>'phone','label'=>'Numéro','addClass'=>'text','options'=>array('placeholder'=>'0123456789','class'=>'login-field','value'=>$service->phone)
          )); ?>
        </div>
        <div class="control-group">
          <?= $this->Form->input(array(
            'type'=>'text','name'=>'pourcentage','label'=>'%','addClass'=>'text','options'=>array('placeholder'=>'%','class'=>'login-field','value'=>$service->pourcentage)
          )); ?>
        </div>
        <div class="control-group">
          Slide :
          <select class="login-field" name="slide"> 
            <option value="1" <?php if ($service->slide == 1): ?> selected="selected"<?php endif; ?>>Oui</option> 
            <option value="0" <?php if ($service->slide == 0): ?> selected="selected"<?php endif; ?>>Non</option>
          </select>
        </div>
        <input type="submit" name="service" class="btn btn-primary btn-large btn-block" value="Modifier">
      </form>
    </div>
    <?php if ($services): ?>
    <div class="span3">
      <h6>Ses Autre(s) service(s) :</h6>
      <?php foreach ($services as $k=>$v): ?><?php $v = current($v); ?>
      <a href="<?= Router::url('admin/admins/service/slug:'.$v->slug.'/id:'.$v->id); ?>"><?= $v->title; ?></a><br/>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
  <div class="row row-form">
    <div class="login-form span4 offset4">
      <form action="<?= Router::url('admin/admins/service/slug:'.$slug.'/id:'.$id); ?>" method="post">
        <div class="control-group">
            <?= $this->Form->input(array(
              'type'=>'text','name'=>'banque','label'=>'Code banque','addClass'=>'text','options'=>array('placeholder'=>'Banque','class'=>'login-field','value'=>$rib->banque)
            )); ?>
        </div>
        <div class="control-group">
          <?= $this->Form->input(array(
            'type'=>'text','name'=>'guichet','label'=>'Guichet','addClass'=>'text','options'=>array('placeholder'=>'Guichet','class'=>'login-field','value'=>$rib->guichet)
          )); ?>
        </div>
        <div class="control-group">
          <?= $this->Form->input(array(
            'type'=>'text','name'=>'compte','label'=>'N° de compte','addClass'=>'text','options'=>array('placeholder'=>'N° de compte','class'=>'login-field','value'=>$rib->compte)
          )); ?>
        </div>
        <div class="control-group">
          <?= $this->Form->input(array(
            'type'=>'text','name'=>'cle','label'=>'Clé','addClass'=>'text','options'=>array('placeholder'=>'Clé','class'=>'login-field','value'=>$rib->cle)
          )); ?>
        </div>

        <div class="control-group">
          <?= $this->Form->input(array(
            'type'=>'text','name'=>'domiciliation','label'=>'Domiciliation','addClass'=>'text','options'=>array('placeholder'=>'Domiciliation','class'=>'login-field','value'=>$rib->domiciliation)
          )); ?>
        </div>

        <div class="control-group">
          <?= $this->Form->input(array(
            'type'=>'text','name'=>'iban','label'=>'IBAN','addClass'=>'text','options'=>array('placeholder'=>'IBAN','class'=>'login-field','value'=>$rib->iban)
          )); ?>
        </div>

        <div class="control-group">
          <?= $this->Form->input(array(
            'type'=>'text','name'=>'bic','label'=>'BIC','addClass'=>'text','options'=>array('placeholder'=>'BIC','class'=>'login-field','value'=>$rib->bic)
          )); ?>
        </div>
        
        <input type="submit" name="bdi" class="btn btn-primary btn-large btn-block" value="Modifier">
      </form>
    </div>
    <table class="table table-bordered">
        <thead>
          <tr>
            <th>Client</th>
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
          <?php foreach ($calls as $k=>$v): ?><?php $v = current($v); ?>
          <tr>
              <td class="white"><a href="<?= Router::url('admin/admins/user/slug:'.$v->slug.'/id:'.$v->user_id); ?>"><?= $v->user; ?></a></td>
            <td class="white"><?= $v->service; ?></td>
            <td class="white"><?= $v->date; ?></td>
            <td class="white"><?= $v->duration; ?></td>
            <td class="white"><?= $v->commission; ?> <small>TTC</small></td>
            <td class="white"><?= $v->status; ?></td>
            <td class="white"><?= $v->payment; ?></td>
            <td class="white">
              <a href="<?= Router::url('admin/admins/switch/id:'.$v->id); ?>" class="btn btn-info">
                <small>Modifier</small>
              </a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
  </div>
</div>