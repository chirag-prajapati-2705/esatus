<div class="container masterhead">
	<div class="demo-headline">
		<h1 class="demo-logo">Vos appels<br><small>
		<?php if ($calls): ?>
		Retrouvez ici l'historique de vos appels
		<?php else: ?>
		Aucun appel pour le moment.
		<?php endif; ?>
		</small></h1>
	</div>
</div>
<?php if ($calls): ?>
<div class="container"> 
    <div class="row">
      	<div class="span12">
            <table class="table table-bordered">
              	<thead>
                	<tr>
		              	<th>Expert</th>
		              	<th>Durée</th>
		              	<th>Date</th>
		              	<th>Note</th>
		              	<th>Coût</th>
                	</tr>
              	</thead>
              	<tbody>
              		<?php foreach ($calls as $k=>$v): ?><?php $v = current($v); ?>
                	<tr>
                		<td class="white"><a href="<?= $v->url; ?>" target="_blank"><?= $v->expert; ?></a></td>
                		<td class="white"><?= $v->duration; ?></td>
        						<td class="white"><?= $v->date; ?></td>
        						<td class="white"><?= $v->rating; ?></td>
        						<td class="white"><?= number_format($v->cost,2); ?> €</td>
                	</tr>
                	<?php endforeach; ?>
              </tbody>
            </table>
      	</div>
    </div>
</div>
<?php endif; ?>