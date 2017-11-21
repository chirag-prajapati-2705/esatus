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
      	<div class="login-form span8 offset4">
            <form action="<?= Router::url('admin/admins/edit/id:' . $subcategory->id); ?>" method="post">
                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'title', 'label' => 'Titre', 'addClass' => 'text', 'options' => array('placeholder' => 'Titre de la catégorie', 'class' => 'login-field', 'value' => $subcategory->title)
                    ));
            
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'title_layout', 'label' => 'Meta title', 'addClass' => 'text', 'options' => array('placeholder' => 'Meta title', 'class' => 'login-field', 'value' => $subcategory->title_layout)
                    ));
                    
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'description', 'label' => 'Meta description', 'addClass' => 'text', 'options' => array('placeholder' => 'Meta description', 'class' => 'login-field', 'value' => $subcategory->description)
                    ));
                    
                    $this->Form->input(array(
                        'type' => 'text', 'name'=>'h1','label'=>'H1','addClass'=>'text','options'=>array('placeholder' => 'H1', 'class'=>'login-field', 'value'=>$subcategory->h1)
                    ));
                    
                    $this->Form->textarea(array(
                        'name'=>'text','label'=>'Text','addClass'=>'text','options'=>array('class'=>'login-field','rows'=>8,'value'=>$subcategory->text)
                    ));
                    ?>
                </div>
                <input type="submit" class="btn btn-primary btn-large btn-block" value="Modifier">
            </form>
      	</div>
    </div>
</div>