<select name="to">
	<?php debug($value); ?>
	<?php for ($i=$value; $i<24; $i++): ?>
	<option value="<?= $i; ?>"><?= str_pad($i,2,'0',STR_PAD_LEFT); ?>:00</option>
	<?php endfor; ?>
</select>