<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">
      Categories - <?= $subcategory->title; ?>
      <small>Modifier la sous catégories</small>
    </h1>
  </div>
</div>

<div class="container">
    <div class="row row-form">
      	<div class="login-form span4 offset4">
      		<form action="<?= Router::url('admin/admins/edit/id:'.$subcategory->id); ?>" method="post">
      			<div class="control-group">
	            	<?= $this->Form->input(array(
						'type'=>'text','name'=>'title','label'=>'Titre','addClass'=>'text','options'=>array('placeholder'=>'Titre de la catégorie','class'=>'login-field','value'=>$subcategory->title)
		            )); ?>
	            </div>
            	<input type="submit" class="btn btn-primary btn-large btn-block" value="Modifier">
      		</form>
      	</div>
    </div>
</div>