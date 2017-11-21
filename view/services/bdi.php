<div class="container masterhead">
	<div class="demo-headline">
		<h1 class="demo-logo"><img class="rounded" src="<?= IMAGE; ?>services/<?= $service->img; ?>" alt="<?= $service->title; ?>"><br>Votre RIB<small>Indiquez nous vos coordonnées bancaires afin de recevoir les virements de vos gains.</small></h1>
	</div>
</div>
<div class="container">
	<?= $this->Session->flash(); ?>
    <div class="row row-form">
      	<div class="login-form span4 offset4">
      		<form action="<?= Router::url('services/bdi/id:'.$service->id); ?>" method="post">
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

    			<input type="submit" class="btn btn-primary btn-large btn-block" value="Enregistrer">
      		</form>
      		<a class="login-link" href="<?= Router::url('pages/contact'); ?>">Pas de RIB ?</a>
                
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