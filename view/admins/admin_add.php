<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">
      Categories - <?= $category->title; ?>
      <small>Créer une nouvelle sous catégories</small>
    </h1>
  </div>
</div>

<div class="container">
    <div class="row row-form">
      	<div class="login-form span4 offset4">
      		<form action="<?= Router::url('admin/admins/add/id:'.$category->id); ?>" method="post">
      			<div class="control-group">
	            	<?= $this->Form->input(array(
						'type'=>'text','name'=>'title','label'=>'Titre','addClass'=>'text','options'=>array('placeholder'=>'Titre de la catégorie','class'=>'login-field')
		            )); ?>
	            </div>
            	<input type="submit" class="btn btn-primary btn-large btn-block" value="Créer">
      		</form>
      	</div>
    </div>
</div>