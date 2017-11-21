<select class="login-field" name="subcategory_id"> 
	<?php foreach ($subcategories as $k=>$v): ?><?php $v = current($v); ?>
   	<option value="<?= $v->id; ?>"><?= $v->title; ?></option> 
   	<?php endforeach; ?>
</select>