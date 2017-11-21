<div class="container masterhead">
  <div class="demo-headline">
    <h1 class="demo-logo">
      Categories - <?= $Category->title; ?>
      <small>Modifier la sous catégories</small>
    </h1>
  </div>
</div>

<div class="container">
    <div class="row row-form">
      	<div class="login-form span8 offset4">
            <form action="<?= Router::url('admin/admins/catedit/id:' . $Category->id); ?>" method="post">
                <div class="control-group">
                    <?=
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'title', 'label' => 'Titre', 'addClass' => 'text', 'options' => array('placeholder' => 'Titre de la catégorie', 'class' => 'login-field', 'value' => $Category->title)
                    ));
            
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'title_layout', 'label' => 'Meta title', 'addClass' => 'text', 'options' => array('placeholder' => 'Meta title', 'class' => 'login-field', 'value' => $Category->title_layout)
                    ));
                    
                    $this->Form->input(array(
                        'type' => 'text', 'name' => 'description', 'label' => 'Meta description', 'addClass' => 'text', 'options' => array('placeholder' => 'Meta description', 'class' => 'login-field', 'value' => $Category->description)
                    ));
                    
                    $this->Form->input(array(
                        'type' => 'text', 'name'=>'h1','label'=>'H1','addClass'=>'text','options'=>array('placeholder' => 'H1', 'class'=>'login-field', 'value'=> $Category->h1)
                    ));
                    
                    $this->Form->textarea(array(
                        'name'=>'text','label'=>'Text','addClass'=>'text','options'=>array('class'=>'login-field','rows'=>8,'value'=> $Category->text)
                    ));
                    
                    $this->Form->textarea(array(
                        'name'=>'text_bottom','label'=>'Text bas','addClass'=>'text','options'=>array('class'=>'login-field','rows'=>8,'value'=> $Category->text_bottom)
                    ));
                    ?>
                </div>
                <input type="submit" class="btn btn-primary btn-large btn-block" value="Modifier">
            </form>
      	</div>
    </div>
</div>